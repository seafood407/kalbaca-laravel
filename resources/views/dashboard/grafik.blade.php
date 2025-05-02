@extends('layouts.app')

@section('content')
    <h2>Grafik Data Cairan Pasien</h2>

    <div class="mb-5">
        <h4>Grafik Balance Cairan</h4>
        <canvas id="balanceChart"></canvas>
    </div>

    <div class="mb-5">
        <h4>Grafik IWL per Pasien</h4>
        <canvas id="iwlChart"></canvas>
    </div>

    @if (count($lukaData) > 0)
    <div class="mb-5">
        <h4>Grafik Pasien dengan Luka Bakar</h4>
        <canvas id="lukaChart"></canvas>
    </div>
    @endif

    <a href="{{ url('/') }}" class="btn btn-secondary mt-3">← Kembali ke Dashboard</a>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const balanceChart = new Chart(document.getElementById('balanceChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Balance Cairan (ml)',
                    data: {!! json_encode($balanceData) !!},
                    backgroundColor: 'rgba(56, 142, 60, 0.7)',
                    borderColor: 'rgba(56, 142, 60, 1)',
                    borderWidth: 1
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });

        const iwlChart = new Chart(document.getElementById('iwlChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'IWL (ml)',
                    data: {!! json_encode($iwlData) !!},
                    backgroundColor: 'rgba(33, 150, 243, 0.7)',
                    borderColor: 'rgba(33, 150, 243, 1)',
                    borderWidth: 1
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });

        @if (count($lukaData) > 0)
        const lukaChart = new Chart(document.getElementById('lukaChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($lukaLabels) !!},
                datasets: [{
                    label: '% Luka Bakar',
                    data: {!! json_encode($lukaData) !!},
                    backgroundColor: 'rgba(244, 67, 54, 0.7)',
                    borderColor: 'rgba(244, 67, 54, 1)',
                    borderWidth: 1
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });
        @endif
    </script>
@endsection
