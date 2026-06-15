@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Data Produk</h2>
        <p class="text-muted mb-0">Kelola produk snack Laris Food.</p>
    </div>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        Tambah Produk
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="12%">Foto</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Modal</th>
                        <th>Jual</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th width="18%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="img-thumbnail"
                                         width="80">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>

                            <td>
                                <strong>{{ $product->name }}</strong>
                                <br>
                                <small class="text-muted">
                                    {{ Str::limit($product->description, 50) }}
                                </small>
                            </td>

                            <td>{{ $product->category->name ?? '-' }}</td>

                            <td>Rp {{ number_format($product->cost_price, 0, ',', '.') }}</td>

                            <td>Rp {{ number_format($product->selling_price, 0, ',', '.') }}</td>

                            <td>
                                @if ($product->stock <= 0)
                                    <span class="badge bg-danger">Habis</span>
                                @else
                                    <span class="badge bg-success">{{ $product->stock }}</span>
                                @endif
                            </td>

                            <td>
                                @if ($product->status === 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('admin.products.destroy', $product->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">
                                Belum ada produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection