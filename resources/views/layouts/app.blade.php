<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Dashboard</a>
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
            <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link" style="display: inline; cursor: pointer;">Logout</button>
                            </form>
                        </li>
                    @endguest
                </ul>
        </div>
    </nav>
    <div class="container mt-4">
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            <strong>Error:</strong> {{ session('error') }}
        </div>

    @endif
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            <strong>Success:</strong> {{ session('success') }}
        </div>

    @endif

        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
