@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($alternative) ? 'Edit Alternatif' : 'Tambah Alternatif' }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($alternative) ? route('alternatives.update', $alternative->id) : route('alternatives.store') }}" method="POST">
        @csrf
        @if(isset($alternative))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="nama_motor">Nama Motor</label>
            <input type="text" class="form-control" id="nama_motor" name="nama_motor" value="{{ isset($alternative) ? $alternative->nama_motor : '' }}" required>
        </div>

        <div class="form-group">
            <label for="harga_motor">Harga Motor</label>
            <input type="number" step="500000" class="form-control" id="harga_motor" name="harga_motor" value="{{ isset($alternative) ? $alternative->harga_motor : '' }}" required>
        </div>

        <div class="form-group">
            <label for="konsumsi_bbm">Konsumsi BBM (liter/km)</label>
            <input type="text" class="form-control" id="konsumsi_bbm" name="konsumsi_bbm" value="{{ isset($alternative) ? $alternative->konsumsi_bbm : '' }}" required>
        </div>

        <div class="form-group">
            <label for="biaya_maintenance">Biaya Maintenance</label>
            <input type="number" step="50000" class="form-control" id="biaya_maintenance" name="biaya_maintenance" value="{{ isset($alternative) ? $alternative->biaya_maintenance : '' }}" required>
        </div>

        <div class="form-group">
            <label for="dimensi_motor">Dimensi Motor</label>
            <input type="text" class="form-control" id="dimensi_motor" name="dimensi_motor" value="{{ isset($alternative) ? $alternative->dimensi_motor : '' }}" required>
        </div>

        <div class="form-group">
            <label for="kapasitas_mesin">Kapasitas Mesin (cc)</label>
            <input type="number" class="form-control" id="kapasitas_mesin" name="kapasitas_mesin" value="{{ isset($alternative) ? $alternative->kapasitas_mesin : '' }}" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($alternative) ? 'Update' : 'Tambah' }}</button>
    </form>
</div>
@endsection
