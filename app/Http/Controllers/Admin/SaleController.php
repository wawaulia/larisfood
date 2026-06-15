<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\StockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('items')->latest()->get();

        return view('admin.sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::where('status', 'aktif')
            ->where('stock', '>', 0)
            ->orderBy('name')
            ->get();

        return view('admin.sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'sale_date' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->qty > $product->stock) {
            return back()
                ->withInput()
                ->with('error', 'Stok produk tidak cukup.');
        }

        DB::transaction(function () use ($request, $product) {
            $totalAmount = $product->selling_price * $request->qty;
            $totalCost = $product->cost_price * $request->qty;
            $profit = $totalAmount - $totalCost;

            $sale = Sale::create([
                'invoice_number' => $this->generateInvoiceNumber(),
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'sale_date' => $request->sale_date,
                'total_amount' => $totalAmount,
                'total_cost' => $totalCost,
                'profit' => $profit,
                'status' => 'diproses',
                'note' => $request->note,
                'user_id' => Auth::id(),
            ]);

            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'cost_price' => $product->cost_price,
                'selling_price' => $product->selling_price,
                'qty' => $request->qty,
                'subtotal' => $totalAmount,
                'profit' => $profit,
            ]);

            $stockBefore = $product->stock;
            $stockAfter = $product->stock - $request->qty;

            $product->update([
                'stock' => $stockAfter,
            ]);

            StockHistory::create([
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'type' => 'keluar',
                'qty' => $request->qty,
                'stock_before' => $stockBefore,
                'stock_after' => $stockAfter,
                'note' => 'Penjualan invoice ' . $sale->invoice_number,
            ]);
        });

        return redirect()
            ->route('admin.sales.index')
            ->with('success', 'Transaksi penjualan berhasil ditambahkan.');
    }

    public function show(Sale $sale)
    {
        $sale->load(['items', 'user']);

        return view('admin.sales.show', compact('sale'));
    }

    public function editStatus(Sale $sale)
    {
        return view('admin.sales.edit-status', compact('sale'));
    }

    public function updateStatus(Request $request, Sale $sale)
    {
        $request->validate([
            'status' => 'required|in:diproses,dikemas,dikirim,selesai,dibatalkan,return',
        ]);

        $sale->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.sales.index')
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }

    private function generateInvoiceNumber()
    {
        $date = date('Ymd');

        $lastSale = Sale::whereDate('created_at', date('Y-m-d'))
            ->latest()
            ->first();

        $number = $lastSale ? $lastSale->id + 1 : 1;

        return 'INV-' . $date . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}