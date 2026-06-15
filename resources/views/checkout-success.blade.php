@extends('layouts.app')
@section('title', 'Order Success')
@section('styles')
<style>
.success-wrapper {
    background: linear-gradient(135deg, #1f1c2c 0%, #928dab 100%);
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 20px;
    font-family: 'Inter', 'Spartan', sans-serif;
}
.success-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 24px;
    padding: 60px;
    text-align: center;
    max-width: 600px;
    width: 100%;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    color: #fff;
    animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
}
@keyframes slideUp {
    0% { transform: translateY(40px); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
}
.success-icon {
    width: 100px;
    height: 100px;
    background: rgba(52, 211, 153, 0.2);
    color: #34d399;
    font-size: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 30px auto;
    box-shadow: 0 0 30px rgba(52, 211, 153, 0.4);
}
.success-title {
    font-size: 36px;
    font-weight: 800;
    margin-bottom: 15px;
    background: linear-gradient(to right, #fff, #cbd5e1);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.success-desc {
    font-size: 18px;
    color: #94a3b8;
    margin-bottom: 30px;
    line-height: 1.6;
}
.order-id {
    display: inline-block;
    padding: 12px 24px;
    background: rgba(0,0,0,0.3);
    border-radius: 12px;
    font-size: 20px;
    font-weight: 700;
    letter-spacing: 2px;
    color: #a78bfa;
    margin-bottom: 40px;
    border: 1px dashed rgba(167, 139, 250, 0.5);
}
.btn-home {
    display: inline-block;
    padding: 16px 36px;
    background: linear-gradient(135deg, #a78bfa 0%, #6d28d9 100%);
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    text-decoration: none;
    border-radius: 12px;
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(109, 40, 217, 0.3);
}
.btn-home:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 25px rgba(109, 40, 217, 0.5);
    color: #fff;
}
</style>
@endsection
@section('content')
<div class="success-wrapper">
    <div class="success-card">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        <h1 class="success-title">Thank You For Your Order!</h1>
        <p class="success-desc">Your order has been successfully placed. We've sent a confirmation email with your order details.</p>
        <div class="order-id">
            Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
        </div>
        <br>
        <a href="{{ url('/') }}" class="btn-home">Continue Shopping</a>
    </div>
</div>
@endsection
