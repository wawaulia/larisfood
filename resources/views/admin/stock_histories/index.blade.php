@extends('layouts.admin')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-1">Riwayat Stok</h2>
    <p class="text-muted mb-0">
        Lihat semua perubahan stok produk Laris Food.
    </p>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">

        <form method="GET" action="{{ route('admin.stock_histories.index') }}">
            <div class="row g-3">

                <div class="col-md-5">
                    <label class="form-label">Filter Produk</label>
                    <select name="product_id" class="form-select">
                        <option value="">Semua Produk</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}"
                                {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Filter Tipe</label>
                    <select name="type" class="form-select">
                        <option value="">Semua Tipe</option>
                        <option value="masuk" {{ request('type') == 'masuk' ? 'selected' : '' }}>Masuk</option>
                        <option value="keluar" {{ request('type') == 'keluar' ? 'selected' : '' }}>Keluar</option>
                        <option value="penyesuaian" {{ request('type') == 'penyesuaian' ? 'selected' : '' }}>Penyesuaian</option>
                        <option value="return" {{ request('type') == 'return' ? 'selected' : '' }}>Return</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary">
                        Filter
                    </button>

                    <a href="{{ route('admin.stock_histories.index') }}" class="btn btn-secondary">
                        Reset
                    </a>
                </div>

            </div>
        </form>

    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Tipe</th>
                        <th>Qty</th>
                        <th>Stok Sebelum</th>
                        <th>Stok Sesudah</th>
                        <th>Admin</th>
                        <th>Catatan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($stockHistories as $history)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $history->created_at->format('d-m-Y H:i') }}
                            </td>

                            <td>
                                {{ $history->product->name ?? '-' }}
                            </td>

                            <td>
                                @if ($history->type === 'masuk')
                                    <span class="badge bg-success">Masuk</span>
                                @elseif ($history->type === 'keluar')
                                    <span class="badge bg-danger">Keluar</span>
                                @elseif ($history->type === 'penyesuaian')
                                    <span class="badge bg-warning text-dark">Penyesuaian</span>
                                @else
                                    <span class="badge bg-info text-dark">Return</span>
                                @endif
                            </td>

                            <td>{{ $history->qty }}</td>

                            <td>{{ $history->stock_before }}</td>

                            <td>{{ $history->stock_after }}</td>

                            <td>
                                {{ $history->user->name ?? '-' }}
                            </td>

                            <td>
                                {{ $history->note ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">
                                Belum ada riwayat stok.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection