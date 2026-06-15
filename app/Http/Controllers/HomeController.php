<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('category', 'featured')->take(8)->get();
        $newArrivals = Product::where('category', 'new_arrival')->take(8)->get();
        return view('home', compact('featuredProducts', 'newArrivals'));
    }
}
