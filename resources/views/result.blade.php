@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Hasil Ranking Alternatif</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Ranking</th>
                <th>Nama Motor</th>
                <th>Skor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($finalScores as $index => $result)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $result['alternative']->nama_motor }}</td>
        <td>{{ $result['score'] }}</td>
    </tr>
@endforeach
        </tbody>
    </table>
</div>
@endsection
