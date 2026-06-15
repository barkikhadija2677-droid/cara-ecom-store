@extends('layouts.app')
@section('title', $wallet . ' Secure Gateway')
@section('styles')
<style>
.gateway-wrapper {
    background: #111827;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    font-family: 'Inter', 'Spartan', sans-serif;
}
.gateway-card {
    background: rgba(31, 41, 55, 0.8);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    width: 100%;
    max-width: 450px;
    padding: 40px;
    color: #fff;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    text-align: center;
}
.gateway-header h2 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 5px;
    color: {{ $wallet === 'EasyPaisa' ? '#10b981' : ($wallet === 'JazzCash' ? '#ef4444' : '#a78bfa') }};
}
.gateway-header p {
    color: #9ca3af;
    font-size: 14px;
    margin-bottom: 30px;
}
.gateway-amount {
    font-size: 42px;
    font-weight: 800;
    margin-bottom: 35px;
    color: #fff;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}
.form-group {
    text-align: left;
    margin-bottom: 25px;
}
.form-group label {
    display: block;
    margin-bottom: 8px;
    font-size: 14px;
    font-weight: 500;
    color: #d1d5db;
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
    border-color: {{ $wallet === 'EasyPaisa' ? '#10b981' : ($wallet === 'JazzCash' ? '#ef4444' : '#a78bfa') }};
    box-shadow: 0 0 15px {{ $wallet === 'EasyPaisa' ? 'rgba(16,185,129,0.3)' : ($wallet === 'JazzCash' ? 'rgba(239,68,68,0.3)' : 'rgba(167,139,250,0.3)') }};
}
.btn-pay {
    width: 100%;
    padding: 16px;
    background: {{ $wallet === 'EasyPaisa' ? '#10b981' : ($wallet === 'JazzCash' ? 'linear-gradient(135deg, #ef4444 0%, #f59e0b 100%)' : '#a78bfa') }};
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 18px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    box-shadow: 0 10px 20px {{ $wallet === 'EasyPaisa' ? 'rgba(16,185,129,0.3)' : ($wallet === 'JazzCash' ? 'rgba(239,68,68,0.3)' : 'rgba(167,139,250,0.3)') }};
}
.btn-pay:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 25px {{ $wallet === 'EasyPaisa' ? 'rgba(16,185,129,0.4)' : ($wallet === 'JazzCash' ? 'rgba(239,68,68,0.4)' : 'rgba(167,139,250,0.4)') }};
}
.btn-pay:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}
.spinner {
    display: none;
    width: 20px;
    height: 20px;
    border: 3px solid rgba(255,255,255,0.3);
    border-radius: 50%;
    border-top-color: #fff;
    animation: spin 1s ease-in-out infinite;
}
@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>
@endsection

@section('content')
<div class="gateway-wrapper">
    <div class="gateway-card">
        <div class="gateway-header">
            <h2>{{ $wallet }} Secure Gateway</h2>
            <p>Please enter your details to complete the payment</p>
        </div>
        
        <div class="gateway-amount">
            ${{ number_format((float)$total, 2) }}
        </div>
        
        <form id="payment-form">
            <div class="form-group">
                <label>Mobile Wallet Number</label>
                <input type="text" class="form-control" placeholder="e.g. 0300 1234567" required>
            </div>
            
            <button type="submit" class="btn-pay" id="pay-btn">
                <span class="btn-text">Pay Now</span>
                <div class="spinner" id="spinner"></div>
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('payment-form');
    const payBtn = document.getElementById('pay-btn');
    const btnText = payBtn.querySelector('.btn-text');
    const spinner = document.getElementById('spinner');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Disable button & show spinner
        payBtn.disabled = true;
        btnText.textContent = 'Processing...';
        spinner.style.display = 'block';
        
        // Simulate 2-second network request
        setTimeout(function() {
            window.location.href = '/checkout/confirmation/{{ $order_id }}';
        }, 2000);
    });
});
</script>
@endsection
