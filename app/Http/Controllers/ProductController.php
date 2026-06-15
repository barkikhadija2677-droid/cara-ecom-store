<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(16);
        return view('shop', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $featuredProducts = Product::where('category', 'featured')->take(4)->get();
        return view('product', compact('product', 'featuredProducts'));
    }
}
