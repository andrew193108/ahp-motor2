@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="jumbotron">
        <h1 class="display-4">Selamat Datang di Sistem Pendukung Keputusan x</h1>
        <p class="lead">Ini adalah sistem pendukung keputusan untuk pemilihan sepeda motor menggunakan metode AHP.</p>
        <hr class="my-4">
        <p>Anda dapat mengelola alternatif, kriteria, dan melihat hasil ranking dari menu di atas.</p>
        <a class="btn btn-primary btn-lg" href="{{ route('alternatives.index') }}" role="button">Lihat Alternatif</a>
        <a class="btn btn-secondary btn-lg" href="{{ route('criterias.index') }}" role="button">Lihat Kriteria</a>
    </div>
@endsection
