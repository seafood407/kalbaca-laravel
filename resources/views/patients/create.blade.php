@extends('layouts.app')

@section('content')
    <h2>Tambah Data Pasien</h2>

    <form action="{{ route('patients.store') }}" method="POST" class="row g-3 bg-white p-4 rounded shadow-sm">
        @csrf

        <div class="col-md-6">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">Umur (tahun)</label>
            <input type="number" name="umur" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">Berat Badan (kg)</label>
            <input type="number" name="berat_badan" step="0.01" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Tinggi Badan (cm)</label>
            <input type="number" name="tinggi_badan" step="0.01" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">Suhu Tubuh (°C)</label>
            <input type="number" name="suhu_tubuh" step="0.1" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Intake (ml)</label>
            <input type="number" name="intake" step="0.01" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Output (ml)</label>
            <input type="number" name="output" step="0.01" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Luka Bakar (% TBSA)</label>
            <input type="number" name="persentase_luka_bakar" step="0.01" class="form-control">
        </div>

        <div class="col-md-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="iwl_anak" value="1">
                <label class="form-check-label">Hitung IWL untuk anak</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="iwl_koreksi" value="1">
                <label class="form-check-label">Koreksi IWL dengan kenaikan suhu tubuh</label>
            </div>
        </div>

        <div class="col-12">
            <button class="btn btn-success" type="submit">Simpan</button>
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
