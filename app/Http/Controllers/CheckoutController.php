<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Your cart is empty. Add items to proceed.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shippingFee = 10.00;
        $total = $subtotal + $shippingFee;

        return view('checkout', compact('cart', 'subtotal', 'shippingFee', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'payment_method' => 'required|in:cod,easypaisa,jazzcash',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Your cart is empty.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $total = $subtotal + 10.00; // $10 shipping

        // Retrieve User info if logged in, else use dummy or session (assuming auth is preferred but not mandatory)
        // From previous tasks, users might not be forced to login. I'll use auth if available.
        $user = Auth::user();
        $name = $user ? $user->name : 'Guest User';
        $email = $user ? $user->email : 'guest@example.com';

        $order = Order::create([
            'user_id' => $user ? $user->id : null,
            'name' => $name,
            'email' => $email,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'total_amount' => $total,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
        ]);

        foreach ($cart as $id => $item) {
            $isCustom = !is_numeric($id) || strpos($id, 'custom') !== false;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $isCustom ? null : $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'custom_attributes' => $isCustom ? json_encode($item) : null,
            ]);
        }

        if ($request->payment_method === 'cod') {
            session()->forget('cart');
            return redirect('/checkout/confirmation/' . $order->id)->with('success', 'Order placed successfully using Cash on Delivery.');
        } else if (in_array($request->payment_method, ['easypaisa', 'jazzcash'])) {
            $walletName = $request->payment_method === 'easypaisa' ? 'EasyPaisa' : 'JazzCash';
            session()->forget('cart');
            return redirect('/payment-process?wallet=' . urlencode($walletName) . '&total=' . urlencode($total) . '&order_id=' . $order->id);
        }

        return redirect('/checkout')->with('error', 'Invalid payment method selected.');
    }

    public function success(Request $request)
    {
        $orderId = $request->get('order_id');
        $sessionId = $request->get('session_id');

        if (!$orderId || !$sessionId) {
            return redirect('/')->with('error', 'Invalid request.');
        }

        $order = Order::findOrFail($orderId);
        
        // Optionally verify session with Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = Session::retrieve($sessionId);

        if ($session->payment_status === 'paid') {
            $order->update([
                'status' => 'paid',
                'payment_id' => $sessionId,
            ]);
            
            session()->forget('cart');
            return redirect('/checkout/confirmation/' . $order->id)->with('success', 'Payment successful!');
        }

        return redirect('/checkout/cancel');
    }

    public function cancel()
    {
        return redirect('/checkout')->with('error', 'Payment was canceled. Please try again.');
    }

    public function confirmation($id)
    {
        $order = Order::findOrFail($id);
        return view('checkout-success', compact('order'));
    }
}
