@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Alternatif</h1>
    <a href="{{ route('alternatives.create') }}" class="btn btn-primary mb-3">Tambah Alternatif</a>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama Motor</th>
                <th>Harga Motor</th>
                <th>Konsumsi BBM</th>
                <th>Biaya Maintenance</th>
                <th>Dimensi Motor</th>
                <th>Kapasitas Mesin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alternatives as $alternative)
                <tr>
                    <td>{{ $alternative->nama_motor }}</td>
                    <td>{{ $alternative->harga_motor }}</td>
                    <td>{{ $alternative->konsumsi_bbm }}</td>
                    <td>{{ $alternative->biaya_maintenance }}</td>
                    <td>{{ $alternative->dimensi_motor }}</td>
                    <td>{{ $alternative->kapasitas_mesin }}</td>
                    <td>
                        <a href="{{ route('alternatives.edit', $alternative->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
