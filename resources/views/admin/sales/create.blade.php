@extends('layouts.admin')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-1">Tambah Transaksi</h2>
    <p class="text-muted mb-0">Input transaksi dari pesanan customer via WhatsApp.</p>
</div>

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.sales.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Customer</label>
                    <input type="text"
                           name="customer_name"
                           class="form-control @error('customer_name') is-invalid @enderror"
                           value="{{ old('customer_name') }}"
                           placeholder="Contoh: Rina">

                    @error('customer_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">No HP Customer</label>
                    <input type="text"
                           name="customer_phone"
                           class="form-control"
                           value="{{ old('customer_phone') }}"
                           placeholder="Contoh: 081234567890">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Penjualan</label>
                <input type="date"
                       name="sale_date"
                       class="form-control @error('sale_date') is-invalid @enderror"
                       value="{{ old('sale_date', date('Y-m-d')) }}">

                @error('sale_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Produk</label>
                <select name="product_id" class="form-select @error('product_id') is-invalid @enderror">
                    <option value="">-- Pilih Produk --</option>

                    @foreach ($products as $product)
                        <option value="{{ $product->id }}"
                            {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                            - Stok: {{ $product->stock }}
                            - Rp {{ number_format($product->selling_price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>

                @error('product_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah Beli</label>
                <input type="number"
                       name="qty"
                       class="form-control @error('qty') is-invalid @enderror"
                       value="{{ old('qty', 1) }}"
                       min="1">

                @error('qty')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Catatan</label>
                <textarea name="note"
                          class="form-control"
                          rows="3"
                          placeholder="Contoh: Pesanan dari WhatsApp">{{ old('note') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Simpan Transaksi
                </button>

                <a href="{{ route('admin.sales.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>

    </div>
</div>

@endsection