<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pasien</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        td, th { padding: 8px; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <h2>Laporan Keseimbangan Cairan</h2>

    <table>
        <tr><th>Nama</th><td>{{ $patient->nama }}</td></tr>
        <tr><th>Umur</th><td>{{ $patient->umur }} tahun</td></tr>
        <tr><th>Jenis Kelamin</th><td>{{ $patient->jenis_kelamin }}</td></tr>
        <tr><th>Berat Badan</th><td>{{ $patient->berat_badan }} kg</td></tr>
        <tr><th>Tinggi Badan</th><td>{{ $patient->tinggi_badan ?? '-' }} cm</td></tr>
        <tr><th>Suhu Tubuh</th><td>{{ $patient->suhu_tubuh ?? '-' }} °C</td></tr>
        <tr><th>Intake</th><td>{{ $patient->intake ?? '-' }} ml</td></tr>
        <tr><th>Output</th><td>{{ $patient->output ?? '-' }} ml</td></tr>
        <tr><th>Luka Bakar</th><td>{{ $patient->persentase_luka_bakar ?? '-' }} %</td></tr>
    </table>

    <h4>Hasil Perhitungan:</h4>
    <table>
        <thead>
            <tr><th>Parameter</th><th>Nilai</th></tr>
        </thead>
        <tbody>
            @foreach ($hasil as $judul => $nilai)
                <tr>
                    <td>{{ $judul }}</td>
                    <td>{{ number_format($nilai, 2) }} ml</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
