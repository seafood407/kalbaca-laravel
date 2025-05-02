<?php

namespace App\Http\Controllers;

use App\Models\Patient;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPasien = Patient::count();

        $rataIntake = Patient::avg('intake');
        $rataOutput = Patient::avg('output');

        $balanceList = Patient::all()->map(function ($p) {
            $hasil = json_decode($p->hasil_perhitungan, true);
            return $hasil['Balance Cairan'] ?? 0;
        });

        $rataBalance = round($balanceList->avg(), 2);

        return view('dashboard.index', compact(
            'totalPasien', 'rataIntake', 'rataOutput', 'rataBalance'
        ));
    }

    public function grafik()
    {
        $patients = Patient::all();

        $labels = $patients->pluck('nama');

        // Grafik Balance Cairan
        $balanceData = $patients->map(function ($p) {
            $hasil = json_decode($p->hasil_perhitungan, true);
            return $hasil['Balance Cairan'] ?? 0;
        });

        // Grafik IWL
        $iwlData = $patients->map(function ($p) {
            $hasil = json_decode($p->hasil_perhitungan, true);
            foreach ($hasil as $key => $value) {
                if (str_contains($key, 'IWL') && !str_contains($key, 'jam') && !str_contains($key, 'koreksi')) {
                    return $value;
                }
            }
            return 0;
        });

        // Grafik Luka Bakar
        $lukaLabels = $patients->filter(fn($p) => $p->persentase_luka_bakar > 0)->pluck('nama');
        $lukaData = $patients->filter(fn($p) => $p->persentase_luka_bakar > 0)->pluck('persentase_luka_bakar');

        return view('dashboard.grafik', compact('labels', 'balanceData', 'iwlData', 'lukaLabels', 'lukaData'));
    }

}

