@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Detail Return</h2>
        <p class="text-muted mb-0">{{ $return->return_number }}</p>
    </div>

    <a href="{{ route('admin.returns.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <div class="row mb-4">
            <div class="col-md-6">
                <h5 class="fw-bold">Informasi Return</h5>
                <p class="mb-1">No Return: {{ $return->return_number }}</p>
                <p class="mb-1">Tanggal: {{ $return->return_date->format('d-m-Y') }}</p>
                <p class="mb-1">Customer: {{ $return->customer_name ?? '-' }}</p>
                <p class="mb-1">Admin: {{ $return->user->name ?? '-' }}</p>
            </div>

            <div class="col-md-6">
                <h5 class="fw-bold">Informasi Invoice</h5>
                <p class="mb-1">Invoice: {{ $return->sale->invoice_number ?? '-' }}</p>
                <p class="mb-1">
                    Total Return:
                    <strong>Rp {{ number_format($return->total_return, 0, ',', '.') }}</strong>
                </p>
                <p class="mb-1">Alasan: {{ $return->reason ?? '-' }}</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Qty Return</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        <th>Kembali ke Stok</th>
                        <th>Alasan</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($return->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Rp {{ number_format($item->selling_price, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            <td>
                                @if ($item->back_to_stock)
                                    <span class="badge bg-success">Ya</span>
                                @else
                                    <span class="badge bg-danger">Tidak</span>
                                @endif
                            </td>
                            <td>{{ $item->reason ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection