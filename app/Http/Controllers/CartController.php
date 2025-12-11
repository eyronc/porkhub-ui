<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PorkHub;
use App\Models\User;
use App\Models\Order;
use App\Models\RestaurantBranch;
use Illuminate\Support\Facades\DB;
use App\Models\Review;

class CartController extends Controller
{
    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.showcart', compact('cart'));
    }


    public function addToCartForm(Request $request, $id)
    {
        $product = PorkHub::find($id);
        return view('porkhub.addorder', compact('product'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = PorkHub::findOrFail($id);
        $cart = session()->get('cart', []);

        $quantity = $request->input('quantity', 1);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
            $cart[$id]['subtotal'] = $cart[$id]['quantity'] * $cart[$id]['price'];
        } else {
            $cart[$id] = [
                'name'     => $product->product_name,
                'price'    => $product->product_price,
                'quantity' => $quantity,
                'subtotal' => $product->product_price * $quantity,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart!');
    }
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            $cart[$id]['subtotal'] = $cart[$id]['quantity'] * $cart[$id]['price'];
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart cleared!');
    }
}
