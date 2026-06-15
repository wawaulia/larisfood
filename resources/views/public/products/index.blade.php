@extends('layouts.public')

@section('content')

<section class="container py-5">
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Daftar Produk</h2>
        <p class="text-muted mb-0">
            Pilih produk snack favoritmu dan pesan melalui WhatsApp.
        </p>
    </div>

    <div class="row g-4">
        @forelse ($products as $product)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">

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
                        <span class="badge bg-success mb-2">
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