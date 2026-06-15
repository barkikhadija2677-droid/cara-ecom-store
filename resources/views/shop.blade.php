@extends('layouts.app')

@section('title', 'Shop')

@section('content')
    <section id="page-header">
        <h2>#stayhome</h2>
        <p>Save more with coupons & up to 70% off!</p>
    </section>

    <section id="product1" class="section-p1">
        <div class="pro-container">
            @foreach($products as $product)
            <div class="pro" onclick="window.location.href='{{ url('/product', $product->id) }}'">
                <img src="{{ asset('img/products/' . ($product->image ?? 'f1.jpg')) }}" alt="{{ $product->name }}">
                <div class="des">
                    <span>{{ $product->brand }}</span>
                    <h5>{{ $product->name }}</h5>
                    <div class="star">
                        @for($i = 0; $i < 5; $i++)
                            <i class="fas fa-star" style="{{ $i >= $product->rating ? 'color: #ccc;' : '' }}"></i>
                        @endfor
                    </div>
                    <h4>${{ number_format($product->price, 2) }}</h4>
                </div>
                <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
            </div>
            @endforeach
        </div>
    </section>

    <section id="pagination" class="section-p1">
        {{ $products->links('vendor.pagination.default') }}
    </section>
@endsection
