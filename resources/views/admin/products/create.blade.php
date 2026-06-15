@extends('layouts.admin')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-1">Tambah Produk</h2>
    <p class="text-muted mb-0">Tambahkan produk snack baru.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           placeholder="Contoh: Keripik Singkong">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi Produk</label>
                <textarea name="description"
                          class="form-control"
                          rows="4"
                          placeholder="Contoh: Snack renyah dan gurih">{{ old('description') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Harga Modal</label>
                    <input type="number"
                           name="cost_price"
                           class="form-control @error('cost_price') is-invalid @enderror"
                           value="{{ old('cost_price', 0) }}">

                    @error('cost_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Harga Jual</label>
                    <input type="number"
                           name="selling_price"
                           class="form-control @error('selling_price') is-invalid @enderror"
                           value="{{ old('selling_price', 0) }}">

                    @error('selling_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Stok Awal</label>
                    <input type="number"
                           name="stock"
                           class="form-control @error('stock') is-invalid @enderror"
                           value="{{ old('stock', 0) }}">

                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Produk</label>
                <input type="file"
                       name="image"
                       class="form-control @error('image') is-invalid @enderror">

                <small class="text-muted">
                    Format: jpg, jpeg, png. Maksimal 2MB.
                </small>

                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Status Produk</label>
                <select name="status" class="form-select">
                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Simpan Produk
                </button>

                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </form>

    </div>
</div>

@endsection