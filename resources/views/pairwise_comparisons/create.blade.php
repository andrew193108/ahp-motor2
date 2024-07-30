@extends('layouts.app')

@section('title', 'Perbandingan Berpasangan Antar Kriteria')

@section('content')
    <h1>Perbandingan Berpasangan Antar Kriteria</h1>
    <form action="{{ route('pairwise_comparisons.store') }}" method="POST">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kriteria 1</th>
                    <th>Perbandingan</th>
                    <th>Kriteria 2</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comparisons as $comparison)
                <tr>
                    <td>{{ $comparison['criteria1']->name }}</td>
                    <td>
                        <select name="comparisons[{{ $comparison['criteria1']->id }}][{{ $comparison['criteria2']->id }}]" class="form-control">
                            @foreach($comparisonScale as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>{{ $comparison['criteria2']->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Simpan Perbandingan</button>
    </form>
@endsection
