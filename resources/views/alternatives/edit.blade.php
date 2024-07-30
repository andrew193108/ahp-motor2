<!DOCTYPE html>
<html>
<head>
    <title>Edit Alternatives</title>
</head>
<body>
    <h1>Edit Alternatives</h1>
    <form action="{{ route('alternatives.update', $alternative->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Name:</label>
        <input type="text" name="name" value="{{ $alternative->name }}">
        <button type="submit">Update</button>
    </form>
</body>
</html>