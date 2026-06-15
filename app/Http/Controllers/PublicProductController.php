<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PublicProductController extends Controller
{
    public function home()
    {
        $products = Product::with('category')
            ->where('status', 'aktif')
            ->latest()
            ->take(6)
            ->get();

        return view('public.home', compact('products'));
    }

    public function index()
    {
        $products = Product::with('category')
            ->where('status', 'aktif')
            ->latest()
            ->get();

        return view('public.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        if ($product->status !== 'aktif') {
            abort(404);
        }

        return view('public.products.show', compact('product'));
    }
}