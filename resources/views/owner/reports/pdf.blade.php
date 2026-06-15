<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan Laris Food</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #000;
        }

        h2, h4 {
            text-align: center;
            margin: 0;
        }

        h2 {
            margin-bottom: 5px;
        }

        h4 {
            margin-bottom: 20px;
            font-weight: normal;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .summary {
            margin-top: 20px;
            width: 45%;
        }

        .footer {
            margin-top: 35px;
            text-align: right;
        }
    </style>
</head>
<body>

    <h2>LAPORAN PENJUALAN UMKM LARIS FOOD</h2>

    <h4>
        Periode:
        @if ($startDate && $endDate)
            {{ $startDate }} sampai {{ $endDate }}
        @else
            Semua Data
        @endif
    </h4>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No Invoice</th>
                <th>Nama Customer</th>
                <th>No HP</th>
                <th>Tanggal</th>
                <th>Total Penjualan</th>
                <th>Total Modal</th>
                <th>Laba</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sales as $sale)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $sale->invoice_number }}</td>
                    <td>{{ $sale->customer_name }}</td>
                    <td>{{ $sale->customer_phone ?? '-' }}</td>
                    <td class="text-center">{{ $sale->sale_date }}</td>
                    <td class="text-right">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($sale->total_cost, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($sale->profit, 0, ',', '.') }}</td>
                    <td class="text-center">{{ ucfirst($sale->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Data penjualan belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <table class="summary">
        <tr>
            <th colspan="2">Ringkasan Laporan</th>
        </tr>
        <tr>
            <td>Total Omzet</td>
            <td class="text-right">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Total Modal</td>
            <td class="text-right">Rp {{ number_format($totalModal, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Total Laba</td>
            <td class="text-right">Rp {{ number_format($totalLaba, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Tangerang Selatan, {{ date('d-m-Y') }}</p>
        <br><br><br>
        <p>Owner Laris Food</p>
    </div>

</body>
</html>