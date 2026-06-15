@extends('layouts.owner')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-1">Dashboard Owner</h2>
    <p class="text-muted mb-0">
        Laporan penjualan, laba rugi, return barang, dan produk terlaris.
    </p>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('owner.dashboard') }}">
            <div class="row g-3 align-items-end">

                <div class="col-md-4">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date"
                           name="start_date"
                           class="form-control"
                           value="{{ $startDate }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date"
                           name="end_date"
                           class="form-control"
                           value="{{ $endDate }}">
                </div>

                <div class="col-md-4 d-flex gap-2">
                    <div class="col-md-4 d-flex gap-2">
    <button type="submit" class="btn btn-success">
        Filter
    </button>

    <a href="{{ route('owner.dashboard') }}" class="btn btn-secondary">
        Reset
    </a>

    <a href="{{ route('owner.reports.export', [
        'start_date' => request('start_date'),
        'end_date' => request('end_date')
    ]) }}" class="btn btn-danger">
        Export PDF
    </a>
</div>
                </div>

            </div>
        </form>
    </div>
</div>

<div class="row g-3 mb-4">

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Omzet</h6>
                <h3 class="fw-bold text-success">
                    Rp {{ number_format($totalOmzet, 0, ',', '.') }}
                </h3>
                <p class="mb-0 text-muted">Total penjualan kotor</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Modal</h6>
                <h3 class="fw-bold">
                    Rp {{ number_format($totalCost, 0, ',', '.') }}
                </h3>
                <p class="mb-0 text-muted">Modal barang terjual</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Laba Kotor</h6>
                <h3 class="fw-bold text-primary">
                    Rp {{ number_format($grossProfit, 0, ',', '.') }}
                </h3>
                <p class="mb-0 text-muted">Omzet dikurangi modal</p>
            </div>
        </div>
    </div>

</div>

<div class="row g-3 mb-4">

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Return</h6>
                <h3 class="fw-bold text-danger">
                    Rp {{ number_format($totalReturn, 0, ',', '.') }}
                </h3>
                <p class="mb-0 text-muted">Nilai barang return</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Laba Bersih Sederhana</h6>
                <h3 class="fw-bold text-success">
                    Rp {{ number_format($netProfit, 0, ',', '.') }}
                </h3>
                <p class="mb-0 text-muted">Laba kotor dikurangi return</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Jumlah Transaksi</h6>
                <h3 class="fw-bold">
                    {{ $totalTransactions }}
                </h3>
                <p class="mb-0 text-muted">Total invoice penjualan</p>
            </div>
        </div>
    </div>

</div>

<div class="row g-4">

    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0">Produk Terlaris</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Produk</th>
                                <th>Qty Terjual</th>
                                <th>Total Penjualan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($bestSellingProducts as $product)
                                <tr>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->total_qty }}</td>
                                    <td>
                                        Rp {{ number_format($product->total_sales, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        Belum ada data produk terjual.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0">Transaksi Terbaru</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Invoice</th>
                                <th>Customer</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($latestSales as $sale)
                                <tr>
                                    <td>{{ $sale->invoice_number }}</td>
                                    <td>{{ $sale->customer_name }}</td>
                                    <td>
                                        Rp {{ number_format($sale->total_amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        Belum ada transaksi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection