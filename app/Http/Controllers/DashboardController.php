<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductReturn;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function redirect()
    {
        $role = auth()->user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($role === 'owner') {
            return redirect()->route('owner.dashboard');
        }

 if ($role === 'customer') {
    return redirect()->route('home');
}

        return redirect()->route('login');
    }

    public function admin()
    {
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');
        $totalSales = Sale::count();
        $totalReturns = ProductReturn::count();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalStock',
            'totalSales',
            'totalReturns'
        ));
    }

    public function owner(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $salesQuery = Sale::query();
        $returnsQuery = ProductReturn::query();

        if ($startDate && $endDate) {
            $salesQuery->whereBetween('sale_date', [$startDate, $endDate]);
            $returnsQuery->whereBetween('return_date', [$startDate, $endDate]);
        }

        $totalOmzet = (clone $salesQuery)->sum('total_amount');
        $totalCost = (clone $salesQuery)->sum('total_cost');
        $grossProfit = (clone $salesQuery)->sum('profit');
        $totalReturn = (clone $returnsQuery)->sum('total_return');
        $netProfit = $grossProfit - $totalReturn;
        $totalTransactions = (clone $salesQuery)->count();

        $latestSales = (clone $salesQuery)
            ->latest()
            ->take(5)
            ->get();

        $bestSellingProducts = SaleItem::select(
                'product_name',
                DB::raw('SUM(qty) as total_qty'),
                DB::raw('SUM(subtotal) as total_sales')
            )
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereHas('sale', function ($saleQuery) use ($startDate, $endDate) {
                    $saleQuery->whereBetween('sale_date', [$startDate, $endDate]);
                });
            })
            ->groupBy('product_name')
            ->orderByDesc('total_qty')
            ->take(5)
            ->get();

        return view('owner.dashboard', compact(
            'startDate',
            'endDate',
            'totalOmzet',
            'totalCost',
            'grossProfit',
            'totalReturn',
            'netProfit',
            'totalTransactions',
            'latestSales',
            'bestSellingProducts'
        ));
    }

public function exportOwnerReport(Request $request)
{
    $startDate = $request->start_date;
    $endDate = $request->end_date;

    $salesQuery = Sale::query();

    if ($startDate && $endDate) {
        $salesQuery->whereBetween('sale_date', [$startDate, $endDate]);
    }

    $sales = $salesQuery->latest()->get();

    $totalOmzet = $sales->sum('total_amount');
    $totalModal = $sales->sum('total_cost');
    $totalLaba = $sales->sum('profit');

    $pdf = Pdf::loadView('owner.reports.pdf', [
        'sales' => $sales,
        'startDate' => $startDate,
        'endDate' => $endDate,
        'totalOmzet' => $totalOmzet,
        'totalModal' => $totalModal,
        'totalLaba' => $totalLaba,
    ])->setPaper('a4', 'landscape');

    return $pdf->download('laporan-penjualan-laris-food-' . date('Y-m-d') . '.pdf');
}

    public function customer()
    {
        return view('customer.dashboard');
    }
}