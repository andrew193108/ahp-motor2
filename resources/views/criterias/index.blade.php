@extends('layouts.app')

@section('title', 'List Criteria')

@section('content')
    <h1>List of Criteria</h1>
    <a href="{{ route('criterias.create') }}" class="btn btn-primary">Add New Criteria</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($criterias as $criteria)
            <tr>
                <td>{{ $criteria->id }}</td>
                <td>{{ $criteria->name }}</td>
                <td>
                    <a href="{{ route('criterias.edit', $criteria->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('criterias.destroy', $criteria->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
