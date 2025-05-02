@extends('layouts.app')

@section('content')
    <h2>Edit Data Pasien</h2>

    <form action="{{ route('patients.update', $patient->id) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $patient->nama) }}" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Umur (tahun)</label>
                <input type="number" name="umur" value="{{ old('umur', $patient->umur) }}" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Berat Badan (kg)</label>
                <input type="number" name="berat_badan" value="{{ old('berat_badan', $patient->berat_badan) }}" step="0.01" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Tinggi Badan (cm)</label>
                <input type="number" name="tinggi_badan" value="{{ old('tinggi_badan', $patient->tinggi_badan) }}" step="0.01" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" {{ $patient->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $patient->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Suhu Tubuh (°C)</label>
                <input type="number" name="suhu_tubuh" value="{{ old('suhu_tubuh', $patient->suhu_tubuh) }}" step="0.1" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Intake (ml)</label>
                <input type="number" name="intake" value="{{ old('intake', $patient->intake) }}" step="0.01" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Output (ml)</label>
                <input type="number" name="output" value="{{ old('output', $patient->output) }}" step="0.01" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Luka Bakar (% TBSA)</label>
                <input type="number" name="persentase_luka_bakar" value="{{ old('persentase_luka_bakar', $patient->persentase_luka_bakar) }}" step="0.01" class="form-control">
            </div>

            <div class="col-md-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="iwl_anak" value="1"
                        {{ str_contains($patient->hasil_perhitungan, 'IWL (Anak)') ? 'checked' : '' }}>
                    <label class="form-check-label">Hitung IWL untuk anak</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="iwl_koreksi" value="1"
                        {{ str_contains($patient->hasil_perhitungan, 'IWL setelah koreksi suhu') ? 'checked' : '' }}>
                    <label class="form-check-label">Koreksi IWL dengan kenaikan suhu tubuh</label>
                </div>
            </div>

            <div class="col-12 mt-3">
                <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                <a href="{{ route('patients.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </div>
    </form>
@endsection