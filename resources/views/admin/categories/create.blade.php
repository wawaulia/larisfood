@extends('layouts.admin')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-1">Tambah Kategori</h2>
    <p class="text-muted mb-0">Tambahkan kategori produk snack.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       placeholder="Contoh: Keripik">

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description"
                          class="form-control"
                          rows="4"
                          placeholder="Contoh: Produk snack jenis keripik">{{ old('description') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </form>

    </div>
</div>

@endsection