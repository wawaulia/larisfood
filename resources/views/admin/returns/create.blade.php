@extends('layouts.admin')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-1">Tambah Return Barang</h2>
    <p class="text-muted mb-0">Catat barang yang dikembalikan customer.</p>
</div>

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.returns.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Pilih Invoice</label>
                <select name="sale_id" class="form-select @error('sale_id') is-invalid @enderror">
                    <option value="">-- Pilih Invoice --</option>

                    @foreach ($sales as $sale)
                        <option value="{{ $sale->id }}" {{ old('sale_id') == $sale->id ? 'selected' : '' }}>
                            {{ $sale->invoice_number }}
                            - {{ $sale->customer_name }}
                            - Rp {{ number_format($sale->total_amount, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>

                @error('sale_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <small class="text-muted">
                    Pilih invoice dari transaksi yang barangnya ingin direturn.
                </small>
            </div>

            <div class="mb-3">
                <label class="form-label">Pilih Produk dari Invoice</label>
                <select name="sale_item_id" class="form-select @error('sale_item_id') is-invalid @enderror">
                    <option value="">-- Pilih Produk --</option>

                    @foreach ($sales as $sale)
                        @foreach ($sale->items as $item)
                            <option value="{{ $item->id }}" {{ old('sale_item_id') == $item->id ? 'selected' : '' }}>
                                {{ $sale->invoice_number }}
                                - {{ $item->product_name }}
                                - Qty Beli: {{ $item->qty }}
                            </option>
                        @endforeach
                    @endforeach
                </select>

                @error('sale_item_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <small class="text-muted">
                    Untuk versi sederhana, pastikan produk yang dipilih sesuai dengan invoice.
                </small>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Return</label>
                <input type="date"
                       name="return_date"
                       class="form-control @error('return_date') is-invalid @enderror"
                       value="{{ old('return_date', date('Y-m-d')) }}">

                @error('return_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah Return</label>
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
                <label class="form-label">Barang Kembali ke Stok?</label>
                <select name="back_to_stock" class="form-select">
                    <option value="0" {{ old('back_to_stock') == '0' ? 'selected' : '' }}>
                        Tidak, barang rusak/tidak layak jual
                    </option>
                    <option value="1" {{ old('back_to_stock') == '1' ? 'selected' : '' }}>
                        Ya, barang masih layak jual
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Alasan Return</label>
                <textarea name="reason"
                          class="form-control"
                          rows="3"
                          placeholder="Contoh: Produk rusak / salah kirim / customer batal">{{ old('reason') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Simpan Return
                </button>

                <a href="{{ route('admin.returns.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>

    </div>
</div>

@endsection