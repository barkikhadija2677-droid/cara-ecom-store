@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <section id="page-header" class="about-header">
        <h2>#cart</h2>
        <p>Add your coupon code & SAVE upto 70%!</p>
    </section>
    
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody>
                @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
                    <tr>
                        <td>
                            <form action="{{ url('/cart/remove', $id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:none;border:none;cursor:pointer;"><i class="far fa-times-circle"></i></button>
                            </form>
                        </td>
                        <td><img src="{{ asset('img/products/' . ($details['image'] ?? 'f1.jpg')) }}" alt="{{ $details['name'] }}"></td>
                        <td style="max-width: 250px; word-wrap: break-word; white-space: normal;">{{ $details['name'] }}</td>
                        <td>${{ number_format($details['price'], 2) }}</td>
                        <td>
                            <form action="{{ url('/cart/update', $id) }}" method="POST">
                                @csrf
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" onchange="this.form.submit()">
                            </form>
                        </td>
                        <td>${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">Your cart is empty.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </section>

    <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Apply Coupon</h3>
            <div>
                <input type="text" placeholder="Enter Your Coupon">
                <button class="normal">Apply</button>
            </div>
        </div>

        <div id="subtotal">
            <h3>Cart Totals</h3>
            @php $total = 0 @endphp
            @if(session('cart'))
                @foreach(session('cart') as $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                @endforeach
            @endif
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td>$ {{ number_format($total, 2) }}</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>$ 10.00</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>$ {{ number_format($total + 10, 2) }}</strong></td>
                </tr>
            </table>
            <a href="{{ url('/checkout') }}" class="normal" style="background-color: #088178; color: #fff; text-decoration: none; display: block; text-align: center; padding: 15px 30px; border-radius: 4px; font-weight: 600; font-size: 14px; transition: 0.2s; margin-top: 20px;">Proceed to checkout</a>
        </div>
    </section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Generic DOM Selectors
    const couponInput = document.querySelector('input[placeholder*="Coupon"]');
    let applyBtn = null;
    
    // Find the Apply button dynamically regardless of class name
    document.querySelectorAll('button').forEach(btn => {
        if (btn.textContent.trim().toLowerCase() === 'apply') {
            applyBtn = btn;
        }
    });

    if (applyBtn && couponInput) {
        // Intercept the click
        applyBtn.addEventListener('click', function(e) {
            e.preventDefault(); // prevent hard refresh
            
            // 2. Grab text and convert to uppercase
            const code = couponInput.value.trim().toUpperCase();
            
            // 3. Handle SAVE50 valid logic
            if (code === 'SAVE50') {
                if (applyBtn.dataset.applied) {
                    alert('Coupon already applied!');
                    return;
                }
                
                alert('Coupon Applied successfully!');
                applyBtn.dataset.applied = "true";
                
                // Dynamically update the total down by 50%
                const strongTags = document.querySelectorAll('td strong');
                strongTags.forEach(strong => {
                    if (strong.textContent.includes('$')) {
                        let currentVal = parseFloat(strong.textContent.replace('$', '').replace(',', '').trim());
                        if (!isNaN(currentVal)) {
                            let newVal = currentVal * 0.5; // Apply 50% off
                            strong.textContent = '$ ' + newVal.toFixed(2);
                        }
                    }
                });
            } else {
                // 4. Handle Invalid logic
                alert('Invalid coupon code. Try using SAVE50.');
            }
        });
    }
});
</script>
@endsection
