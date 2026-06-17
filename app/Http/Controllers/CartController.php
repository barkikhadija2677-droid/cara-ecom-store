<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity ?? 1;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $request->quantity ?? 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
          
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $id)
    {
        if($id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Cart updated successfully');
    }

    public function remove($id)
    {
        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }
        return redirect()->back()->with('success', 'Product removed successfully');
    }

    public function addCustom(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = 'custom_' . time();
        
        $color = $request->input('color', 'White');
        $size = $request->input('size', 'M');
        $text = $request->input('text', '');
        $textColor = $request->input('textColor', '#333333');
        $graphic = $request->input('graphic', 'None');
        
        $name = "Custom Shirt - {$color}";
        if (!empty($text)) {
            $name .= " - Text: '{$text}' (Color: {$textColor})";
        }
        $name .= " ({$size})";
        
        if ($graphic !== 'None') {
            $name .= " [{$graphic}]";
        }
        
        $cart[$id] = [
            "name" => $name,
            "quantity" => 1,
            "price" => 25.00,
            "image" => "plain-white-shirt.png"
        ];
          
        session()->put('cart', $cart);
        
        return response()->json(['success' => true, 'message' => 'Custom shirt added to cart!', 'cart_count' => count($cart)]);
    }
}
