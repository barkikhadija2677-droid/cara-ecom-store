<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/shop', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);

Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/add/{id}', [CartController::class, 'add']);
Route::post('/cart/update/{id}', [CartController::class, 'update']);
Route::delete('/cart/remove/{id}', [CartController::class, 'remove']);

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\AuthController;

Route::post('/newsletter', [NewsletterController::class, 'store']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

use App\Http\Controllers\CheckoutController;
Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/checkout/process', [CheckoutController::class, 'process']);
Route::get('/checkout/success', [CheckoutController::class, 'success']);
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel']);
Route::get('/checkout/confirmation/{id}', [CheckoutController::class, 'confirmation']);

Route::get('/collections/winter', function () {
    $products = \App\Models\Product::where('category', 'winter')->get();
    return view('collections.winter', compact('products'));
});
Route::get('/collections/footwear', function () {
    $products = \App\Models\Product::where('category', 'footwear')->get();
    return view('collections.footwear', compact('products'));
});
Route::get('/collections/tshirts', function () {
    $products = \App\Models\Product::where('category', 'tshirts')->get();
    return view('collections.tshirts', compact('products'));
});

use App\Http\Controllers\ContactController;
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']);
Route::get('/about', function () {
    return view('about');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/payment-process', function (\Illuminate\Http\Request $request) {
    $wallet = $request->query('wallet', 'Mobile Wallet');
    $total = $request->query('total', '0');
    $order_id = $request->query('order_id');
    
    return view('payment-process', compact('wallet', 'total', 'order_id'));
});

Route::get('/custom-shirt', function () {
    return view('custom-shirt');
});

Route::post('/custom-shirt/add-to-cart', [\App\Http\Controllers\CartController::class, 'addCustom']);
