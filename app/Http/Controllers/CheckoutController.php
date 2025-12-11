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

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        $branches = RestaurantBranch::all();

        $userName = auth()->user()->name;

        return view('cart.checkout', compact('cart', 'branches', 'userName'));
    }
    public function finalizeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'branch_id' => 'required|integer|exists:restaurant_branches,id',
            'payment_method' => 'required|string|in:Cash-on-Delivery,GCash,PayMaya,UnionBank',
            'buyer_name' => 'required|string|max:255',
            'user_address' => 'required|string',
        ]);

        \DB::beginTransaction();

        try {

            $totalAmount = array_sum(array_column($cart, 'subtotal'));

            $orderId = \DB::table('orders')->insertGetId([
                'user_id' => auth()->id(),
                'restaurant_branch_id' => $validated['branch_id'],
                'payment_method' => $validated['payment_method'],
                'total_amount' => $totalAmount,
                'user_address' => $request->input('user_address', ''),
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($cart as $id => $item) {
                $dish = PorkHub::find($id); 

                if (!$dish) continue;

                if ($dish->stock < $item['quantity']) {
                    \DB::rollBack();
                    return back()->with('error', 'Not enough stock for: ' . $dish->product_name);
                }

                \DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'dish_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $dish->product_price,
                    'subtotal' => $item['subtotal'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $dish->decrement('stock', $item['quantity']);
            }

            \DB::commit();

            session()->forget('cart');
            session()->forget('review_popup_dismissed');

            return redirect()->route('order.success')->with('success', 'Order placed successfully! Total: ₱' . number_format($totalAmount, 2));

        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->with('error', 'Unable to place order: ' . $e->getMessage());
        }
    }
    public function orderSuccess()
    {
        $order = Order::with(['items.dish', 'restaurantBranch'])
                    ->where('user_id', auth()->id())
                    ->latest()
                    ->first();

        if (!$order) {
            return redirect()->route('user.menu')->with('error', 'No recent order found.');
        }

        return view('porkhub.ordersuccess', compact('order'));
    }
}
