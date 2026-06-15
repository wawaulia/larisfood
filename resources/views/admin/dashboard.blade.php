@extends('layouts.admin')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold">Dashboard Admin</h2>
    <p class="text-muted">
        Selamat datang, {{ Auth::user()->name }}. Ini adalah halaman admin Laris Food.
    </p>
</div>

<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Produk</h6>
                <h3 class="fw-bold">{{ $totalProducts }}</h3>
                <p class="mb-0 text-muted">Total produk snack</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Stok</h6>
                <h3 class="fw-bold">{{ $totalStock }}</h3>
                <p class="mb-0 text-muted">Total stok tersedia</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Transaksi</h6>
                <h3 class="fw-bold">{{ $totalSales }}</h3>
                <p class="mb-0 text-muted">Transaksi penjualan</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Return</h6>
                <h3 class="fw-bold">{{ $totalReturns }}</h3>
                <p class="mb-0 text-muted">Barang return</p>
            </div>
        </div>
    </div>

</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Menu Admin</h5>
    </div>

    <div class="card-body">
        <div class="row g-3">

            <div class="col-md-4">
                <div class="border rounded p-3 h-100">
                    <h5>Kelola Produk</h5>
                    <p class="text-muted">
                        Tambah, edit, hapus produk, isi harga modal, harga jual, foto, dan stok.
                    </p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-sm">Buka Produk</a>
                </div>
            </div>

            <div class="col-md-4">
    <div class="border rounded p-3 h-100">
        <h5>Riwayat Stok</h5>
        <p class="text-muted">
            Lihat riwayat stok masuk, keluar, penyesuaian, dan return.
        </p>
        <a href="{{ route('admin.stock_histories.index') }}" class="btn btn-info btn-sm">
            Buka Stok
        </a>
    </div>
</div>

            <div class="col-md-4">
                <div class="border rounded p-3 h-100">
                    <h5>Input Transaksi</h5>
                    <p class="text-muted">
                        Catat penjualan dari WhatsApp dan sistem akan membuat invoice.
                    </p>
                    <a href="{{ route('admin.sales.index') }}" class="btn btn-success btn-sm">Buka Transaksi</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="border rounded p-3 h-100">
                    <h5>Return Barang</h5>
                    <p class="text-muted">
                        Catat barang yang dikembalikan oleh customer.
                    </p>
                    <a href="{{ route('admin.returns.index') }}" class="btn btn-warning btn-sm">Buka Return</a>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection