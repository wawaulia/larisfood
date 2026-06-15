@extends('layouts.public')

@section('content')

<section class="py-5" style="background: linear-gradient(135deg, #fff3e6 0%, #ffffff 65%);">
    <div class="container py-5">
        <div class="row align-items-center g-5">

            <div class="col-lg-6">
                <span class="badge bg-success-subtle text-success px-3 py-2 mb-3">
                    Snack enak, praktis, dan siap dipesan
                </span>

                <h1 class="display-4 fw-bold mb-3">
                    Camilan favorit untuk setiap suasana
                </h1>

                <p class="lead text-muted mb-4">
                    Temukan berbagai makanan ringan pilihan di Laris Food.
                    Lihat produk, cek stok, lalu pesan langsung melalui WhatsApp.
                </p>

                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('public.products.index') }}" class="btn btn-success btn-lg px-4">
                        Lihat Produk
                    </a>

                    <a href="#produk-terbaru" class="btn btn-outline-success btn-lg px-4">
                        Produk Terbaru
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                 style="width: 52px; height: 52px;">
                                WA
                            </div>

                            <div>
                                <h4 class="fw-bold mb-1">Pesan via WhatsApp</h4>
                                <p class="text-muted mb-0">Mudah, cepat, dan langsung terhubung admin.</p>
                            </div>
                        </div>

                        <div class="border rounded-4 p-3 mb-3 bg-light">
                            <strong>1. Pilih produk</strong>
                            <p class="text-muted mb-0">Buka daftar produk dan lihat detail snack yang kamu mau.</p>
                        </div>

                        <div class="border rounded-4 p-3 mb-3 bg-light">
                            <strong>2. Cek stok</strong>
                            <p class="text-muted mb-0">Stok produk akan tampil langsung di halaman website.</p>
                        </div>

                        <div class="border rounded-4 p-3 bg-light">
                            <strong>3. Klik WhatsApp</strong>
                            <p class="text-muted mb-0">Pesan otomatis akan terbuka dan tinggal dikirim ke admin.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="produk-terbaru" class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Produk Terbaru</h2>
            <p class="text-muted mb-0">Snack pilihan dari Laris Food.</p>
        </div>

        <a href="{{ route('public.products.index') }}" class="btn btn-outline-success">
            Semua Produk
        </a>
    </div>

    <div class="row g-4">
        @forelse ($products as $product)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">

                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="card-img-top"
                             style="height: 220px; object-fit: cover;"
                             alt="{{ $product->name }}">
                    @else
                        <div class="bg-secondary-subtle d-flex align-items-center justify-content-center"
                             style="height: 220px;">
                            <span class="text-muted">Tidak ada foto</span>
                        </div>
                    @endif

                    <div class="card-body">
                        <span class="badge bg-success-subtle text-success mb-2">
                            {{ $product->category->name ?? 'Tanpa Kategori' }}
                        </span>

                        <h5 class="card-title fw-bold">{{ $product->name }}</h5>

                        <p class="card-text text-muted">
                            {{ Str::limit($product->description, 80) }}
                        </p>

                        <h5 class="text-success fw-bold">
                            Rp {{ number_format($product->selling_price, 0, ',', '.') }}
                        </h5>

                        <p class="mb-3">
                            Stok:
                            @if ($product->stock > 0)
                                <span class="badge bg-success">{{ $product->stock }}</span>
                            @else
                                <span class="badge bg-danger">Habis</span>
                            @endif
                        </p>

                        <a href="{{ route('public.products.show', $product->id) }}"
                           class="btn btn-outline-success w-100">
                            Detail Produk
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Belum ada produk aktif.
                </div>
            </div>
        @endforelse
    </div>
</section>

@endsection