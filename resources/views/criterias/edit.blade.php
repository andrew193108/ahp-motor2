@extends('layouts.app')

@section('title', 'Edit Criteria')

@section('content')
    <h1>Edit Criteria</h1>
    <form action="{{ route('criterias.update', $criteria->id) }}" method="POST">
        @csrf
        @method('PUT')     
    <div class="mb-3">
    <label for="name" class="form-label">Edit Criteria</label>
    <input type="text" class="form-control" id= "name" name="name" value="{{ $criteria->name }}">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection