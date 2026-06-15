<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReturn;
use App\Models\ProductReturnItem;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\StockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductReturnController extends Controller
{
    public function index()
    {
        $returns = ProductReturn::with(['sale', 'items'])
            ->latest()
            ->get();

        return view('admin.returns.index', compact('returns'));
    }

    public function create()
    {
        $sales = Sale::with('items')
            ->whereIn('status', ['diproses', 'dikemas', 'dikirim', 'selesai'])
            ->latest()
            ->get();

        return view('admin.returns.create', compact('sales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'sale_item_id' => 'required|exists:sale_items,id',
            'return_date' => 'required|date',
            'qty' => 'required|integer|min:1',
            'reason' => 'nullable|string',
            'back_to_stock' => 'required|in:0,1',
        ], [
            'sale_id.required' => 'Invoice wajib dipilih.',
            'sale_item_id.required' => 'Produk return wajib dipilih.',
            'return_date.required' => 'Tanggal return wajib diisi.',
            'qty.required' => 'Jumlah return wajib diisi.',
        ]);

        $sale = Sale::findOrFail($request->sale_id);
        $saleItem = SaleItem::findOrFail($request->sale_item_id);

        if ($saleItem->sale_id !== $sale->id) {
            return back()
                ->withInput()
                ->with('error', 'Produk tidak sesuai dengan invoice yang dipilih.');
        }

        if ($request->qty > $saleItem->qty) {
            return back()
                ->withInput()
                ->with('error', 'Jumlah return tidak boleh lebih besar dari jumlah pembelian.');
        }

        DB::transaction(function () use ($request, $sale, $saleItem) {
            $subtotalReturn = $saleItem->selling_price * $request->qty;

            $productReturn = ProductReturn::create([
                'return_number' => $this->generateReturnNumber(),
                'sale_id' => $sale->id,
                'customer_name' => $sale->customer_name,
                'return_date' => $request->return_date,
                'total_return' => $subtotalReturn,
                'reason' => $request->reason,
                'user_id' => Auth::id(),
            ]);

            ProductReturnItem::create([
                'product_return_id' => $productReturn->id,
                'product_id' => $saleItem->product_id,
                'product_name' => $saleItem->product_name,
                'qty' => $request->qty,
                'selling_price' => $saleItem->selling_price,
                'subtotal' => $subtotalReturn,
                'back_to_stock' => $request->back_to_stock,
                'reason' => $request->reason,
            ]);

            if ($request->back_to_stock == 1 && $saleItem->product_id) {
                $product = Product::find($saleItem->product_id);

                if ($product) {
                    $stockBefore = $product->stock;
                    $stockAfter = $product->stock + $request->qty;

                    $product->update([
                        'stock' => $stockAfter,
                    ]);

                    StockHistory::create([
                        'product_id' => $product->id,
                        'user_id' => Auth::id(),
                        'type' => 'return',
                        'qty' => $request->qty,
                        'stock_before' => $stockBefore,
                        'stock_after' => $stockAfter,
                        'note' => 'Return barang dari invoice ' . $sale->invoice_number,
                    ]);
                }
            }

            $sale->update([
                'status' => 'return',
            ]);
        });

        return redirect()
            ->route('admin.returns.index')
            ->with('success', 'Data return barang berhasil disimpan.');
    }

    public function show(ProductReturn $return)
    {
        $return->load(['sale', 'items', 'user']);

        return view('admin.returns.show', compact('return'));
    }

    private function generateReturnNumber()
    {
        $date = date('Ymd');

        $lastReturn = ProductReturn::whereDate('created_at', date('Y-m-d'))
            ->latest()
            ->first();

        $number = $lastReturn ? $lastReturn->id + 1 : 1;

        return 'RET-' . $date . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}