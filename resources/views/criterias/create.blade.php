@extends('layouts.app')

@section('title', 'Edit Criteria')

@section('content')

    <h1>Tambah Criteria</h1>
    <form action="{{ route('criterias.store') }}" method="POST">
        @csrf
        <label for="name" class="form-label"> Criteria</label>
        <input type="text" class="form-control" id= "name" name="name">
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection