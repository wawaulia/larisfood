@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Invoice</h2>
        <p class="text-muted mb-0">{{ $sale->invoice_number }}</p>
    </div>

    <div class="d-flex gap-2">
        <button onclick="window.print()" class="btn btn-success">
            Print Invoice
        </button>

        <a href="{{ route('admin.sales.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm" id="invoice-area">
    <div class="card-body p-4">

        <div class="d-flex justify-content-between border-bottom pb-3 mb-4">
            <div>
                <h3 class="fw-bold text-success mb-1">LARIS FOOD</h3>
                <p class="mb-0 text-muted">Invoice Penjualan</p>
            </div>

            <div class="text-end">
                <h5 class="fw-bold">{{ $sale->invoice_number }}</h5>
                <p class="mb-0">Tanggal: {{ $sale->sale_date->format('d-m-Y') }}</p>
                <p class="mb-0">
                    Status:
                    <strong>{{ ucfirst($sale->status) }}</strong>
                </p>
            </div>
        </div>

        <div class="mb-4">
            <h6 class="fw-bold">Customer</h6>
            <p class="mb-1">Nama: {{ $sale->customer_name }}</p>
            <p class="mb-0">No HP: {{ $sale->customer_phone ?? '-' }}</p>
        </div>

        <div class="table-responsive mb-4">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th width="15%">Qty</th>
                        <th width="20%">Harga</th>
                        <th width="20%">Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($sale->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Rp {{ number_format($item->selling_price, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total</th>
                        <th>Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="border rounded p-3 bg-light">
            <p class="mb-1"><strong>Catatan:</strong></p>
            <p class="mb-0">{{ $sale->note ?? '-' }}</p>
        </div>

    </div>
</div>

@endsection