<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Laris Food</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #c2410c;">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ route('owner.dashboard') }}">
            Owner Laris Food
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarOwner">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarOwner">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('owner.dashboard') }}">
                        Dashboard
                    </a>
                </li>

            </ul>

            <div class="d-flex align-items-center text-white me-3">
                {{ Auth::user()->name }}
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
<a href="#" class="btn btn-outline-light btn-sm" 
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Logout
</a>
        </div>
    </div>
</nav>

<main class="container py-4">
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>