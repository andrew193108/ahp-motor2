<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Tambahkan CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('home') }}">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('alternatives.index') }}">Alternative</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('criterias.index') }}">Criteria</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pairwise_comparisons.create') }}">Perbandingan Criteria</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('alternative_comparisons.create') }}">Perbandingan Alternatif</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ahp.calculate') }}">Hasil Ranking</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        @if(session('error'))
        <div class="alert alert-danger" role="alert">
            <strong>Error:</strong> {{ session('error') }}
        </div>
        
        @endif
        @yield('content')
    </div>

    <!-- Tambahkan JS Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
