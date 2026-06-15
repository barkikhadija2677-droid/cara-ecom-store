@extends('layouts.app')
@section('title', 'Secure Checkout')
@section('styles')
<style>
/* Modern Glassmorphism & Dark Mode Inspired Checkout */
.checkout-wrapper {
    background: linear-gradient(135deg, #1f1c2c 0%, #928dab 100%);
    padding: 60px 20px;
    font-family: 'Inter', 'Spartan', sans-serif;
    color: #fff;
    min-height: 100vh;
}
.checkout-container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    gap: 40px;
    flex-wrap: wrap;
}
.checkout-form-col, .checkout-summary-col {
    flex: 1;
    min-width: 350px;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 24px;
    padding: 40px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
}
.checkout-title {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 30px;
    color: #fff;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}
.form-group {
    margin-bottom: 25px;
}
.form-group label {
    display: block;
    margin-bottom: 8px;
    font-size: 14px;
    font-weight: 500;
    color: #cbd5e1;
}
.form-control {
    width: 100%;
    padding: 16px;
    background: rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    color: #fff;
    font-size: 16px;
    transition: all 0.3s ease;
}
.form-control:focus {
    outline: none;
    border-color: #a78bfa;
    box-shadow: 0 0 15px rgba(167, 139, 250, 0.4);
    background: rgba(0, 0, 0, 0.3);
}
.payment-methods {
    display: flex;
    gap: 15px;
    margin-top: 20px;
}
.payment-option {
    flex: 1;
    position: relative;
}
.payment-option input[type="radio"] {
    display: none;
}
.payment-option label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 15px;
    background: rgba(255, 255, 255, 0.05);
    border: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    height: 120px;
    color: #fff;
    font-weight: 600;
    text-align: center;
    font-size: 14px;
}
.payment-option input[type="radio"]#cod:checked + label {
    border-color: #34d399;
    background: rgba(52, 211, 153, 0.1);
    box-shadow: 0 0 20px rgba(52, 211, 153, 0.3);
}
.payment-option input[type="radio"]#easypaisa:checked + label {
    border-color: #10b981;
    background: rgba(16, 185, 129, 0.1);
    box-shadow: 0 0 20px rgba(16, 185, 129, 0.3);
}
.payment-option input[type="radio"]#jazzcash:checked + label {
    border-color: #ef4444;
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
    box-shadow: 0 0 20px rgba(239, 68, 68, 0.3);
}
.payment-option i {
    font-size: 28px;
    margin-bottom: 10px;
}
.label-cod i { color: #34d399; }
.label-easypaisa i { color: #10b981; }
.label-jazzcash i { color: #ef4444; }
.summary-item {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}
.summary-img {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    object-fit: cover;
    margin-right: 15px;
}
.summary-details {
    flex: 1;
}
.summary-name {
    font-size: 16px;
    font-weight: 600;
    color: #fff;
    margin: 0 0 5px 0;
}
.summary-qty {
    font-size: 13px;
    color: #94a3b8;
    margin: 0;
}
.summary-price {
    font-weight: 700;
    color: #a78bfa;
}
.summary-totals {
    margin-top: 30px;
}
.totals-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    color: #cbd5e1;
    font-size: 16px;
}
.totals-row.grand-total {
    font-size: 24px;
    font-weight: 800;
    color: #fff;
    border-top: 2px dashed rgba(255,255,255,0.2);
    padding-top: 20px;
    margin-top: 10px;
}
.btn-checkout {
    width: 100%;
    padding: 18px;
    background: linear-gradient(135deg, #a78bfa 0%, #6d28d9 100%);
    color: #fff;
    font-size: 18px;
    font-weight: 700;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    margin-top: 30px;
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(109, 40, 217, 0.4);
}
.btn-checkout:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 25px rgba(109, 40, 217, 0.6);
}
</style>
@endsection
@section('content')
<div class="checkout-wrapper">
    <div class="checkout-container">
        <div class="checkout-form-col">
            <h2 class="checkout-title">Secure Checkout</h2>
            
            @if(session('error'))
                <div style="background: rgba(239, 68, 68, 0.2); border: 1px solid #ef4444; color: #fff; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
                    {{ session('error') }}
                </div>
            @endif

            <form id="checkout-form" action="{{ url('/checkout/process') }}" method="POST">
                @csrf
                <input type="hidden" id="hidden_total" value="{{ $total ?? 0 }}">
                <div class="form-group">
                    <label>Street Address</label>
                    <input type="text" name="address" class="form-control" placeholder="123 Main St" required>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-control" placeholder="San Francisco" required>
                </div>
                <div class="form-group">
                    <label>Postal Code</label>
                    <input type="text" name="postal_code" class="form-control" placeholder="94105" required>
                </div>
                
                <h3 style="margin-top: 40px; margin-bottom: 15px; font-size: 20px; color: #fff;">Payment Method</h3>
                <div class="payment-methods">
                    <div class="payment-option">
                        <input type="radio" id="cod" name="payment_method" value="cod" checked>
                        <label for="cod" class="label-cod">
                            <i class="fas fa-truck"></i>
                            Cash on Delivery
                        </label>
                    </div>
                    <div class="payment-option">
                        <input type="radio" id="easypaisa" name="payment_method" value="easypaisa">
                        <label for="easypaisa" class="label-easypaisa">
                            <i class="fas fa-mobile-alt"></i>
                            EasyPaisa
                        </label>
                    </div>
                    <div class="payment-option">
                        <input type="radio" id="jazzcash" name="payment_method" value="jazzcash">
                        <label for="jazzcash" class="label-jazzcash">
                            <i class="fas fa-wallet"></i>
                            JazzCash
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn-checkout"><i class="fas fa-lock"></i> Place Order</button>
            </form>
        </div>

        <div class="checkout-summary-col">
            <h2 class="checkout-title">Order Summary</h2>
            @foreach($cart as $id => $details)
            <div class="summary-item">
                <img src="{{ asset('img/products/' . ($details['image'] ?? 'f1.jpg')) }}" class="summary-img" alt="{{ $details['name'] }}">
                <div class="summary-details">
                    <h4 class="summary-name">{{ $details['name'] }}</h4>
                    <p class="summary-qty">Qty: {{ $details['quantity'] }}</p>
                </div>
                <div class="summary-price">${{ number_format($details['price'] * $details['quantity'], 2) }}</div>
            </div>
            @endforeach

            <div class="summary-totals">
                <div class="totals-row">
                    <span>Subtotal</span>
                    <span>${{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="totals-row">
                    <span>Shipping Fee</span>
                    <span>${{ number_format($shippingFee, 2) }}</span>
                </div>
                <div class="totals-row grand-total">
                    <span>Total</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
