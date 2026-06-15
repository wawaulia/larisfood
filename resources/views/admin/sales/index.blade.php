@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Transaksi Penjualan</h2>
        <p class="text-muted mb-0">Data transaksi penjualan dari pesanan WhatsApp.</p>
    </div>

    <a href="{{ route('admin.sales.create') }}" class="btn btn-primary">
        Tambah Transaksi
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
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Laba</th>
                        <th>Status</th>
                        <th width="24%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($sales as $sale)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $sale->invoice_number }}</strong>
                            </td>

                            <td>
                                {{ $sale->customer_name }}
                                <br>
                                <small class="text-muted">{{ $sale->customer_phone ?? '-' }}</small>
                            </td>

                            <td>{{ $sale->sale_date->format('d-m-Y') }}</td>

                            <td>
                                Rp {{ number_format($sale->total_amount, 0, ',', '.') }}
                            </td>

                            <td>
                                Rp {{ number_format($sale->profit, 0, ',', '.') }}
                            </td>

                            <td>
                                @if ($sale->status === 'diproses')
                                    <span class="badge bg-secondary">Diproses</span>
                                @elseif ($sale->status === 'dikemas')
                                    <span class="badge bg-warning text-dark">Dikemas</span>
                                @elseif ($sale->status === 'dikirim')
                                    <span class="badge bg-info text-dark">Dikirim</span>
                                @elseif ($sale->status === 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif ($sale->status === 'dibatalkan')
                                    <span class="badge bg-danger">Dibatalkan</span>
                                @else
                                    <span class="badge bg-dark">Return</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.sales.show', $sale->id) }}"
                                   class="btn btn-info btn-sm">
                                    Invoice
                                </a>

                                <a href="{{ route('admin.sales.edit_status', $sale->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Status
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                Belum ada transaksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection