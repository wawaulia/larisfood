<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laris Food</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    :root {
        --snack-orange: #e85d04;
        --snack-orange-dark: #c2410c;
        --snack-orange-soft: #fff3e6;
    }

    .text-success {
        color: var(--snack-orange) !important;
    }

    .bg-success {
        background-color: var(--snack-orange) !important;
    }

    .btn-success {
        background-color: var(--snack-orange) !important;
        border-color: var(--snack-orange) !important;
    }

    .btn-success:hover {
        background-color: var(--snack-orange-dark) !important;
        border-color: var(--snack-orange-dark) !important;
    }

    .btn-outline-success {
        color: var(--snack-orange) !important;
        border-color: var(--snack-orange) !important;
    }

    .btn-outline-success:hover {
        color: #fff !important;
        background-color: var(--snack-orange) !important;
        border-color: var(--snack-orange) !important;
    }

    .bg-success-subtle {
        background-color: var(--snack-orange-soft) !important;
    }

    .badge.text-success {
        color: var(--snack-orange) !important;
    }
</style>
</head>

<body style="background-color: #f8faf9;">

<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container py-2">
        <a class="navbar-brand fw-bold text-success fs-3" href="{{ route('home') }}">
            Laris Food
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPublic">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarPublic">
            <ul class="navbar-nav ms-4 me-auto mb-2 mb-lg-0 gap-lg-3">
                <li class="nav-item">
                    <a class="nav-link fw-semibold {{ request()->routeIs('home') ? 'text-success' : '' }}"
                       href="{{ route('home') }}">
                        Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold {{ request()->routeIs('public.products.*') ? 'text-success' : '' }}"
                       href="{{ route('public.products.index') }}">
                        Produk
                    </a>
                </li>
            </ul>

           <div class="d-flex gap-2">
    @guest
        <a href="{{ route('login') }}" class="btn btn-outline-success px-4">
            Login
        </a>

        <a href="{{ route('register') }}" class="btn btn-success px-4">
            Register
        </a>
    @endguest

    @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-danger px-4">
                Logout
            </button>
        </form>
    @endauth
</div>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer class="bg-white border-top mt-5">
    <div class="container py-4">
        <div class="row align-items-center">

            <div class="col-md-6">
                <h5 class="fw-bold text-success mb-1">Laris Food</h5>
                <p class="text-muted mb-2">
                    Katalog makanan ringan dengan pemesanan melalui WhatsApp.
                </p>

                <div class="d-flex gap-2">
                    <a href="https://www.instagram.com/larisfood.fnb"
                       target="_blank"
                       class="btn btn-outline-success btn-sm">
                        Instagram
                    </a>

                    <a href="https://www.tiktok.com/@larisfood.fnb"
                       target="_blank"
                       class="btn btn-outline-success btn-sm">
                        TikTok
                    </a>
                </div>
            </div>

            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <small class="text-muted">
                    &copy; {{ date('Y') }} Laris Food. Semua hak dilindungi.
                </small>
            </div>

        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>