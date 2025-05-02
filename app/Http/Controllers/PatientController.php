<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(('patients.create'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'umur' => 'required|integer',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'nullable|numeric',
            'jenis_kelamin' => 'required',
            'suhu_tubuh' => 'nullable|numeric',
            'intake' => 'nullable|numeric',
            'output' => 'nullable|numeric',
            'persentase_luka_bakar' => 'nullable|numeric',
            'iwl_anak' => 'nullable',
            'iwl_koreksi' => 'nullable',
        ]);

        $validated['iwl_anak'] = $request->has('iwl_anak');
        $validated['iwl_koreksi'] = $request->has('iwl_koreksi');


        // Lakukan perhitungan balance cairan
        $hasil = $this->hitungBalance($validated);

        // Simpan ke database
        $patient = new Patient($validated);
        $patient->hasil_perhitungan = json_encode($hasil);
        $patient->save();

        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil disimpan.');

    }

    public function hitungBalance($data)
    {
        $berat = $data['berat_badan'];
        $umur = $data['umur'];
        $suhu = $data['suhu_tubuh'] ?? 37;
        $intake = $data['intake'] ?? 0;
        $output = $data['output'] ?? 0;
        $luka = $data['persentase_luka_bakar'] ?? 0;

        $hasil = [];

        // ===== Kebutuhan Cairan (TBW) dengan rumus Watson =====
        if (!empty($data['tinggi_badan']) && !empty($data['jenis_kelamin'])) {
            $tinggi = $data['tinggi_badan'];

            if ($data['jenis_kelamin'] === 'Laki-laki') {
                $tbw = 2.447 - (0.09145 * $umur) + (0.1074 * $tinggi) + (0.3362 * $berat);
            } else {
                $tbw = -2.097 + (0.1069 * $tinggi) + (0.2466 * $berat);
            }

            $hasil['Kebutuhan Cairan (TBW)'] = round($tbw, 2);
        }
       // ===== IWL untuk anak =====
        if (!empty($data['iwl_anak'])) {
            // Rumus IWL anak = (30 - umur) x BB
            $iwl = max((30 - $umur), 0) * $berat;
            $hasil['IWL (Anak)'] = round($iwl, 2);
        } else {
        // ===== IWL untuk dewasa =====
            $iwl = 15 * $berat;
            $hasil['IWL (Dewasa)'] = round($iwl, 2);
        }

        // ===== Koreksi IWL karena demam =====
        if (!empty($data['iwl_koreksi']) && $suhu > 37) {
            $kenaikan = $suhu - 37;
            $iwl_koreksi = (0.1 * $intake * $kenaikan);
            $iwl += $iwl_koreksi;
            $hasil['IWL setelah koreksi suhu'] = round($iwl, 2);
        }

        // ===== IWL per jam selama 24 jam =====
        $iwl_per_jam = $iwl / 24;
        $hasil['IWL per jam ( 24 jam)'] = round($iwl_per_jam, 2);


        // Kebutuhan Cairan Luka Bakar (kalau ada)
        if ($luka > 0) {
            $parkland = 4 * $berat * $luka; // 4mL x kgBB x %TBSA
            $hasil['Parkland Formula (Total)'] = round($parkland, 2);

            $tahap1 = 0.5 * $parkland; // 8 jam pertama
            $tahap2 = 0.25 * $parkland; // 8 jam kedua
            $tahap3 = 0.25 * $parkland; // 8 jam ketiga

            $hasil['Tahap 1 (8 Jam Pertama)'] = round($tahap1, 2);
            $hasil['Tahap 2 (8 Jam Kedua)'] = round($tahap2, 2);
            $hasil['Tahap 3 (8 Jam Ketiga)'] = round($tahap3, 2);
        }

        // Balance Cairan
        $balance = $intake - ($output + $iwl);
        $hasil['Balance Cairan'] = round($balance, 2);

        return $hasil;

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        $hasil = json_decode($patient->hasil_perhitungan, true);

        return view('patients.show', compact('patient', 'hasil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'umur' => 'required|integer',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'nullable|numeric',
            'jenis_kelamin' => 'required',
            'suhu_tubuh' => 'nullable|numeric',
            'intake' => 'nullable|numeric',
            'output' => 'nullable|numeric',
            'persentase_luka_bakar' => 'nullable|numeric',
        ]);
        
        $validated['iwl_anak'] = $request->has('iwl_anak');
        $validated['iwl_koreksi'] = $request->has('iwl_koreksi');
        
        $patient = Patient::findOrFail($id);
        $hasil = $this->hitungBalance($validated);
    
        $patient->update(array_merge($validated, [
            'hasil_perhitungan' => json_encode($hasil),
        ]));
    
        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
    $patient->delete();

    return redirect()->route('patients.index')->with('success', 'Data pasien berhasil dihapus.');
    }

    public function exportPDF($id)
    {
        $patient = Patient::findOrFail($id);
        $hasil = json_decode($patient->hasil_perhitungan, true);

        $pdf = Pdf::loadView('patients.pdf', compact('patient', 'hasil'));
        return $pdf->download('Laporan-Pasien-' . $patient->nama . '.pdf');
    }
}
