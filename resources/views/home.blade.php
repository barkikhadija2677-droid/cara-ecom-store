@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section id="page-header">
        <h2>#stayhome</h2>
        <p>Save more with coupons & up to 70% off!</p>
        <button onclick="window.location.href='{{ url('/shop') }}'">Shop Now</button>
    </section>
    
    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="{{ asset('img/features/f1.png') }}" alt="">
            <h6>Free Shipping</h6>
        </div>
        <div class="fe-box">
            <img src="{{ asset('img/features/f2.png') }}" alt="">
            <h6>Online order</h6>
        </div>
        <div class="fe-box">
            <img src="{{ asset('img/features/f3.png') }}" alt="">
            <h6>Save Money</h6>
        </div>
        <div class="fe-box">
            <img src="{{ asset('img/features/f4.png') }}" alt="">
            <h6>Promotions</h6>
        </div>
        <div class="fe-box">
            <img src="{{ asset('img/features/f5.png') }}" alt="">
            <h6>Happy Sell</h6>
        </div>
        <div class="fe-box">
            <img src="{{ asset('img/features/f6.png') }}" alt="">
            <h6>F24/7 Support</h6>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Modern Design</p>
        <div class="pro-container">
            @foreach($featuredProducts as $product)
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
    
    <section id="banner" class="section-m1">
        <h4>Repair Services </h4>
        <h2>Up to <span>70% Off</span> All t-Shirts & Accessories</h2>
        <button class="normal" onclick="window.location.href='{{ url('/shop') }}'">Explore More</button>
    </section>
    
    <section id="product1" class="section-p1">
        <h2>New Arrivals</h2>
        <p>Summer Collection New Modern Design</p>
        <div class="pro-container">
            @foreach($newArrivals as $product)
            <div class="pro" onclick="window.location.href='{{ url('/product', $product->id) }}'">
                <img src="{{ asset('img/products/' . ($product->image ?? 'n1.jpg')) }}" alt="{{ $product->name }}">
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

    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>crazy deals</h4>
            <h2>buy 1 get 1 free</h2>
            <span>The best classic dress is on sale at cara</span>
            <button class="white">Learn More</button>
        </div>
        <div class="banner-box banner-box2">
            <h4>spring/summer</h4>
            <h2>upcoming season</h2>
            <span>The best classic dress is on sale at cara</span>
            <button class="white">Collection</button>
        </div>
    </section>

    <section id="banner3">
        <a href="{{ url('/collections/winter') }}" class="banner-box" style="text-decoration: none;">
            <h2>SEASONAL SALE</h2>
            <h3>Winter Collection -50% OFF</h3>
        </a>
        <a href="{{ url('/collections/footwear') }}" class="banner-box banner-box2" style="text-decoration: none;">
            <h2>NEW FOOTWEAR COLLECTION</h2>
            <h3>Spring / Summer 2022</h3>
        </a>
        <a href="{{ url('/collections/tshirts') }}" class="banner-box banner-box3" style="text-decoration: none;">
            <h2>T-SHIRTS</h2>
            <h3>New Trendy Prints</h3>
        </a>
    </section>

    <!-- Modern User Auth Popup -->
    <div id="signupModal" class="modal-overlay" style="display: none;">
        <div class="modal-card" id="signupFormContainer">
            <span class="close-btn" onclick="document.getElementById('signupModal').style.display='none'">&#10060;</span>
            <h2 id="modalHeader">Join Flexaura</h2>
            <p id="modalSubtext">Sign up for exclusive offers and updates!</p>
            
            @if($errors->any())
                <div style="color: #e63946; margin-bottom: 15px; font-size: 14px; text-align: left; background: #ffe6e6; padding: 10px; border-radius: 5px;">
                    @foreach($errors->all() as $error)
                        <p style="margin: 0; color: #e63946;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if(session('success'))
                <div style="color: #088178; margin-bottom: 15px; font-size: 14px; text-align: left; background: #e6f9f5; padding: 10px; border-radius: 5px;">
                    <p style="margin: 0;">{{ session('success') }}</p>
                </div>
            @endif

            <form id="authForm" action="{{ url('/register') }}" method="POST">
                @csrf
                <div id="nameField">
                    <input type="text" name="name" placeholder="Full Name" required>
                </div>
                <input type="email" name="email" placeholder="Email Address" required>
                <div id="phoneField">
                    <input type="tel" name="phone" placeholder="Phone Number">
                </div>
                <div id="passwordField">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn-signup" id="submitBtn">Register Now</button>
            </form>
            <p style="margin-top: 15px; font-size: 14px;">
                <a href="#" id="toggleAuth" style="color: #088178; text-decoration: none; font-weight: bold;">Already have an account? Login</a>
            </p>
        </div>
    </div>
@endsection

@section('styles')
<style>
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        backdrop-filter: blur(4px);
    }
    .modal-card {
        background: #fff;
        padding: 40px;
        border-radius: 12px;
        width: 90%;
        max-width: 400px;
        text-align: center;
        position: relative;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        animation: fadeIn 0.3s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }
    .close-btn {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 20px;
        cursor: pointer;
        color: #333;
        transition: 0.3s;
    }
    .close-btn:hover {
        color: #e63946;
    }
    .modal-card h2 {
        font-size: 24px;
        color: #111;
        margin-bottom: 10px;
    }
    .modal-card p {
        font-size: 14px;
        color: #666;
        margin-bottom: 20px;
    }
    .modal-card input {
        width: 100%;
        padding: 12px 15px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        box-sizing: border-box;
    }
    .modal-card input:focus {
        border-color: #088178;
        outline: none;
    }
    .btn-signup {
        background: #088178;
        color: #fff;
        border: none;
        padding: 12px;
        width: 100%;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }
    .btn-signup:hover {
        background: #066b63;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let isLoginMode = false;
        const toggleLink = document.getElementById('toggleAuth');
        const authForm = document.getElementById('authForm');
        const modalHeader = document.getElementById('modalHeader');
        const modalSubtext = document.getElementById('modalSubtext');
        const nameField = document.getElementById('nameField');
        const phoneField = document.getElementById('phoneField');
        const submitBtn = document.getElementById('submitBtn');

        toggleLink.addEventListener('click', function(e) {
            e.preventDefault();
            isLoginMode = !isLoginMode;

            if (isLoginMode) {
                // Switch to Login
                modalHeader.innerText = "Welcome back to Flexaura";
                modalSubtext.innerText = "Login to your account";
                nameField.style.display = 'none';
                nameField.querySelector('input').removeAttribute('required');
                phoneField.style.display = 'none';
                authForm.setAttribute('action', '{{ url("/login") }}');
                submitBtn.innerText = "Login Now";
                toggleLink.innerText = "New to Flexaura? Sign Up";
            } else {
                // Switch to Sign Up
                modalHeader.innerText = "Join Flexaura";
                modalSubtext.innerText = "Sign up for exclusive offers and updates!";
                nameField.style.display = 'block';
                nameField.querySelector('input').setAttribute('required', 'required');
                phoneField.style.display = 'block';
                authForm.setAttribute('action', '{{ url("/register") }}');
                submitBtn.innerText = "Register Now";
                toggleLink.innerText = "Already have an account? Login";
            }
        });

        const hasErrors = {{ $errors->any() ? 'true' : 'false' }};
        const hasSuccess = {{ session('success') ? 'true' : 'false' }};
        
        setTimeout(function() {
            if(!sessionStorage.getItem('signupModalShown') || hasErrors || hasSuccess) {
                document.getElementById('signupModal').style.display = 'flex';
                if(!hasErrors && !hasSuccess) {
                    sessionStorage.setItem('signupModalShown', 'true');
                }
            }
        }, 1500);
    });
</script>
@endsection
