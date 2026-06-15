<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Laris Food</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #c2410c;">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
            Laris Food Admin
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarAdmin">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}">Kategori</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.products.index') }}">Produk</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.stock_histories.index') }}">Stok</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.sales.index') }}">Transaksi</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.returns.index') }}">Return</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Laporan</a>
                </li>

            </ul>

            <div class="d-flex align-items-center text-white me-3">
                {{ Auth::user()->name }}
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<main class="container py-4">
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>