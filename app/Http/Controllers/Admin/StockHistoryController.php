<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StockHistory;
use App\Models\Product;
use Illuminate\Http\Request;

class StockHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = StockHistory::with(['product', 'user'])->latest();

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $stockHistories = $query->get();
        $products = Product::orderBy('name')->get();

        return view('admin.stock_histories.index', compact('stockHistories', 'products'));
    }
}