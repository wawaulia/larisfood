@extends('layouts.admin')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-1">Ubah Status Pesanan</h2>
    <p class="text-muted mb-0">{{ $sale->invoice_number }}</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.sales.update_status', $sale->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Customer</label>
                <input type="text" class="form-control" value="{{ $sale->customer_name }}" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Total</label>
                <input type="text"
                       class="form-control"
                       value="Rp {{ number_format($sale->total_amount, 0, ',', '.') }}"
                       disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Status Pesanan</label>
                <select name="status" class="form-select">
                    <option value="diproses" {{ $sale->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="dikemas" {{ $sale->status == 'dikemas' ? 'selected' : '' }}>Dikemas</option>
                    <option value="dikirim" {{ $sale->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="selesai" {{ $sale->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan" {{ $sale->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    <option value="return" {{ $sale->status == 'return' ? 'selected' : '' }}>Return</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Update Status
                </button>

                <a href="{{ route('admin.sales.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>

    </div>
</div>

@endsection