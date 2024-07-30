@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Perbandingan Alternatif</h1>

    <form action="{{ route('alternative_comparison.store') }}" method="POST">
        @csrf
        @foreach ($criterias as $criteria)
            <h3>{{ $criteria->name }}</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Alternatif 1</th>
                        <th>Perbandingan</th>
                        <th>Alternatif 2</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comparisons[$criteria->id] as $comparison)
                        <tr>
                            <td>{{ $comparison['alternative1']->nama_motor }}</td>
                            <td>
                                <input type="hidden" name="comparisons[{{ $criteria->id }}][{{ $comparison['alternative1']->id }}_{{ $comparison['alternative2']->id }}][alternatives]" value="{{ $comparison['alternative1']->id }},{{ $comparison['alternative2']->id }}">
                                <select class="form-control" name="comparisons[{{ $criteria->id }}][{{ $comparison['alternative1']->id }}_{{ $comparison['alternative2']->id }}][value]" required>
                                    @foreach ($comparisonScale as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td>{{ $comparison['alternative2']->nama_motor }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach

        <button type="submit" class="btn btn-primary">Simpan Perbandingan</button>
    </form>
</div>
@endsection

