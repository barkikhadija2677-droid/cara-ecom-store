@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <section id="prodetails" class="section-p1">
        <div class="single-pro-image">
            <img src="{{ asset('img/products/' . ($product->image ?? 'f1.jpg')) }}" width="100%" id="MainImg" alt="{{ $product->name }}">

            <div class="small-img-group">
                <div class="small-img-col">
                    <img src="{{ asset('img/products/' . ($product->image ?? 'f1.jpg')) }}" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="{{ asset('img/products/f2.jpg') }}" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="{{ asset('img/products/f3.jpg') }}" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="{{ asset('img/products/f4.jpg') }}" width="100%" class="small-img" alt="">
                </div>
            </div>
        </div>
        <div class="single-pro-details">
            <h6>Home / T-Shirt / {{ $product->brand }}</h6>
            <h4>{{ $product->name }}</h4>
            <h2>${{ number_format($product->price, 2) }}</h2>

            <form action="{{ url('/cart/add', $product->id) }}" method="POST">
                @csrf
                <select name="size">
                    <option>Select Size</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                    <option value="Small">Small</option>
                    <option value="Large">Large</option>
                </select>
                <input type="number" name="quantity" value="1" min="1">
                <button type="submit" class="normal">Add To Cart</button>
            </form>

            <h4>Product Details</h4>
            <span>
                {{ $product->description }}
            </span>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Modern Design</p>
        <div class="pro-container">
            @foreach($featuredProducts as $fp)
            <div class="pro" onclick="window.location.href='{{ url('/product', $fp->id) }}'">
                <img src="{{ asset('img/products/' . ($fp->image ?? 'n1.jpg')) }}" alt="{{ $fp->name }}">
                <div class="des">
                    <span>{{ $fp->brand }}</span>
                    <h5>{{ $fp->name }}</h5>
                    <div class="star">
                        @for($i = 0; $i < 5; $i++)
                            <i class="fas fa-star" style="{{ $i >= $fp->rating ? 'color: #ccc;' : '' }}"></i>
                        @endfor
                    </div>
                    <h4>${{ number_format($fp->price, 2) }}</h4>
                </div>
                <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
            </div>
            @endforeach
        </div>
    </section>
@endsection

@section('scripts')
<script>
    var MainImg = document.getElementById("MainImg");
    var smallimg = document.getElementsByClassName("small-img");
    
    for(let i=0; i<smallimg.length; i++) {
        smallimg[i].onclick = function(){
            MainImg.src = smallimg[i].src;
        }
    }
</script>
@endsection
