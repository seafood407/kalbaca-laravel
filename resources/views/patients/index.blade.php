@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Pasien</h2>
        <div>
            <a href="{{ url('/') }}" class="btn btn-outline-secondary me-2">← Dashboard</a>
            <a href="{{ route('patients.create') }}" class="btn btn-success">+ Tambah Pasien</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover bg-white">
        <thead class="table-success">
            <tr>
                <th>Nama</th>
                <th>Umur</th>
                <th>BB</th>
                <th>Kelamin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $p)
                <tr>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->umur }}</td>
                    <td>{{ $p->berat_badan }} kg</td>
                    <td>{{ $p->jenis_kelamin }}</td>
                    <td>
                        <a href="{{ route('patients.show', $p->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('patients.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('patients.destroy', $p->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
