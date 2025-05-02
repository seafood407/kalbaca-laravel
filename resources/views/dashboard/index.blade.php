@extends('layouts.app')

@section('content')
    <h2>Dashboard KALBACA</h2>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5>Total Pasien</h5>
                    <p class="fs-4">{{ $totalPasien }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light">
                <div class="card-body">
                    <h5>Rata-rata Intake</h5>
                    <p class="fs-5">{{ number_format($rataIntake, 2) }} ml</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light">
                <div class="card-body">
                    <h5>Rata-rata Output</h5>
                    <p class="fs-5">{{ number_format($rataOutput, 2) }} ml</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light">
                <div class="card-body">
                    <h5>Rata-rata Balance</h5>
                    <p class="fs-5">{{ number_format($rataBalance, 2) }} ml</p>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('grafik') }}" class="btn btn-outline-success mt-3">📊 Lihat Grafik Balance Cairan</a>
@endsection
