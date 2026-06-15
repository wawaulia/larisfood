@extends('layouts.public')

@section('content')

@php
    $ownerPhone = '6281282926848';

    $message = "Halo Laris Food, saya ingin bertanya/memesan produk:%0A%0A"
        . "Nama Produk: " . $product->name . "%0A"
        . "Harga: Rp " . number_format($product->selling_price, 0, ',', '.') . "%0A"
        . "Stok: " . $product->stock . "%0A%0A"
        . "Apakah produk ini masih tersedia?";

    $whatsappUrl = "https://wa.me/" . $ownerPhone . "?text=" . $message;
@endphp

<section class="container py-5">

    <a href="{{ route('public.products.index') }}" class="btn btn-outline-secondary mb-4">
        Kembali ke Produk
    </a>

    <div class="row g-4">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="img-fluid rounded"
                         alt="{{ $product->name }}">
                @else
                    <div class="bg-secondary-subtle d-flex align-items-center justify-content-center rounded"
                         style="height: 350px;">
                        <span class="text-muted">Tidak ada foto</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-md-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">

                    <span class="badge bg-success mb-3">
                        {{ $product->category->name ?? 'Tanpa Kategori' }}
                    </span>

                    <h2 class="fw-bold">{{ $product->name }}</h2>

                    <h3 class="text-success fw-bold mb-3">
                        Rp {{ number_format($product->selling_price, 0, ',', '.') }}
                    </h3>

                    <p>
                        <strong>Stok:</strong>
                        @if ($product->stock > 0)
                            <span class="badge bg-success">{{ $product->stock }}</span>
                        @else
                            <span class="badge bg-danger">Habis</span>
                        @endif
                    </p>

                    <hr>

                    <h5 class="fw-bold">Deskripsi Produk</h5>
                    <p class="text-muted">
                        {{ $product->description ?? 'Belum ada deskripsi.' }}
                    </p>

                    <hr>

                    @if ($product->stock > 0)
                        <a href="{{ $whatsappUrl }}"
                           target="_blank"
                           class="btn btn-success btn-lg w-100">
                            Pesan / Tanya via WhatsApp
                        </a>
                    @else
                        <button class="btn btn-secondary btn-lg w-100" disabled>
                            Stok Habis
                        </button>
                    @endif

                    <small class="d-block text-muted mt-3">
                        Setelah klik tombol, kamu akan diarahkan ke WhatsApp untuk bertanya atau memesan produk.
                    </small>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection