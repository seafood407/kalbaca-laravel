@extends('layouts.app')

@section('content')
    <h2>Detail Pasien</h2>

    <div class="bg-white p-4 rounded shadow-sm mb-4">
        <dl class="row">
            <dt class="col-sm-4">Nama</dt><dd class="col-sm-8">{{ $patient->nama }}</dd>
            <dt class="col-sm-4">Umur</dt><dd class="col-sm-8">{{ $patient->umur }} tahun</dd>
            <dt class="col-sm-4">Berat Badan</dt><dd class="col-sm-8">{{ $patient->berat_badan }} kg</dd>
            <dt class="col-sm-4">Tinggi Badan</dt><dd class="col-sm-8">{{ $patient->tinggi_badan ?? '-' }} cm</dd>
            <dt class="col-sm-4">Jenis Kelamin</dt><dd class="col-sm-8">{{ $patient->jenis_kelamin }}</dd>
            <dt class="col-sm-4">Suhu Tubuh</dt><dd class="col-sm-8">{{ $patient->suhu_tubuh ?? '-' }} °C</dd>
            <dt class="col-sm-4">Intake</dt><dd class="col-sm-8">{{ $patient->intake ?? '-' }} ml</dd>
            <dt class="col-sm-4">Output</dt><dd class="col-sm-8">{{ $patient->output ?? '-' }} ml</dd>
            <dt class="col-sm-4">Luka Bakar</dt><dd class="col-sm-8">{{ $patient->persentase_luka_bakar ?? '-' }} %</dd>
        </dl>
    </div>

    @if (isset($hasil['Kebutuhan Cairan (TBW)']))
        <div class="alert alert-info">
            <strong>Kebutuhan Cairan (TBW):</strong> {{ number_format($hasil['Kebutuhan Cairan (TBW)'], 2) }} liter
        </div>
    @endif

    <h4>Hasil Perhitungan</h4>
    <table class="table table-bordered bg-white">
        <thead class="table-success">
            <tr>
                <th>Parameter</th>
                <th>Nilai (ml)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasil as $judul => $nilai)
                @if ($judul !== 'Kebutuhan Cairan (TBW)')
                    <tr>
                        <td>{{ $judul }}</td>
                        <td>{{ number_format($nilai, 2) }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('patients.pdf', $patient->id) }}" class="btn btn-outline-danger mb-3" target="_blank">📄 Export PDF</a>
    <br><br>
    <a href="{{ route('patients.index') }}" class="btn btn-secondary">← Kembali</a>
    

@endsection
