<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KALBACA</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #F0F0F0;
        }
        .navbar {
            background-color: #A8E6CF;
        }
        .footer {
            background-color: #D0E6F6;
            text-align: center;
            padding: 1rem;
            margin-top: 3rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><strong>KALBACA</strong></a>
        <div>
            <a class="btn btn-outline-success" href="{{ route('patients.index') }}">Data Pasien</a>
        </div>
    </div>
</nav>

<div class="container my-4">
    @yield('content')
</div>

<div class="footer">
    <small>&copy; {{ date('Y') }} KALBACA. Aplikasi Keseimbangan Cairan.</small>
</div>

<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
