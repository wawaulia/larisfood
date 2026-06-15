@extends('layouts.admin')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-1">Edit Kategori</h2>
    <p class="text-muted mb-0">Ubah data kategori produk snack.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $category->name) }}">

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
                          rows="4">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Update
                </button>

                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </form>

    </div>
</div>

@endsection