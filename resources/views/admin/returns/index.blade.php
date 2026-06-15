@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Return Barang</h2>
        <p class="text-muted mb-0">Data barang yang dikembalikan customer.</p>
    </div>

    <a href="{{ route('admin.returns.create') }}" class="btn btn-primary">
        Tambah Return
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
                        <th>No Return</th>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Tanggal</th>
                        <th>Total Return</th>
                        <th>Alasan</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($returns as $return)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $return->return_number }}</strong>
                            </td>

                            <td>
                                {{ $return->sale->invoice_number ?? '-' }}
                            </td>

                            <td>
                                {{ $return->customer_name ?? '-' }}
                            </td>

                            <td>
                                {{ $return->return_date->format('d-m-Y') }}
                            </td>

                            <td>
                                Rp {{ number_format($return->total_return, 0, ',', '.') }}
                            </td>

                            <td>
                                {{ $return->reason ?? '-' }}
                            </td>

                            <td>
                                <a href="{{ route('admin.returns.show', $return->id) }}"
                                   class="btn btn-info btn-sm">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                Belum ada data return.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection