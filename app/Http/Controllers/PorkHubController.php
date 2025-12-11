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

class PorkHubController extends Controller
{
    public function adminDashboard()
    {
        $users = User::all();

        $orders = Order::with(['user', 'items.dish', 'restaurantBranch'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        $reviews = Review::with('user')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('dashboard', compact('users', 'orders', 'reviews'));
    }

    public function createProductForm()
    {
        return view('porkhub.create');
    }
    public function storeProduct(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0',
            'stock' => 'required|integer',
            'product_description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('products', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        $product = PorkHub::create([
            'product_name' => $validatedData['product_name'],
            'product_price' => $validatedData['product_price'],
            'stock' => $validatedData['stock'],
            'product_description' => $validatedData['product_description'] ?? null,
            'category' => $validatedData['category'] ?? null,
            'image_path' => $validatedData['image_path'] ?? null,
        ]);

        return view('porkhub.created', compact('product'))->with('success', 'Product created successfully.');
    }

    public function showProduct()
    {
        $product = PorkHub::all();
        return view('porkhub.productlist', compact('product'));
    }

    public function editProduct($id)
    {
        $product = PorkHub::findOrFail($id);
        return view('porkhub.updateProduct', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0',
            'stock' => 'required|integer',
            'product_description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('products', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        PorkHub::whereId($id)->update($validatedData);
        
        return redirect('/porkhub/list')->with('success', 'Product updated successfully.');
    }

    public function deleteProduct($id)
    {
        $product = PorkHub::findOrFail($id);
        $product->delete();

        return redirect('/porkhub/list')->with('success', 'Product deleted successfully.');
    }
    
    public function placeOrder()
    {
        $hasDeliveredOrder = Order::where('user_id', auth()->id())
                                ->where('status', 'delivered')
                                ->exists();
        
        $popupDismissed = session()->get('review_popup_dismissed', false);
        
        if ($hasDeliveredOrder && !$popupDismissed) {
            session(['review_popup_shown' => true]);
        } else {
            session(['review_popup_shown' => false]);
        }

        $product = PorkHub::all();
        return view('porkhub.placeOrder', compact('product'));
    }

    public function addOrder(Request $request)
    {
        $validated = $request->validate([
            'product_id'   => 'required|integer|exists:dishes,id',
            'quantity'     => 'required|integer|min:1',
            'buyer_name'   => 'required|string|max:255',
            'contact'      => 'nullable|string|max:255',
            'address'      => 'nullable|string',
        ]);

        $product = PorkHub::findOrFail($validated['product_id']);

        if ($product->stock < $validated['quantity']) {
            return redirect()->back()
                ->withErrors(['quantity' => 'Requested quantity exceeds available stock.'])
                ->withInput();
        }

        \DB::beginTransaction();
        try {
            \DB::table('orders')->insert([
                'product_id'  => $product->id,
                'quantity'    => $validated['quantity'],
                'buyer_name'  => $validated['buyer_name'],
                'contact'     => $validated['contact'] ?? null,
                'address'     => $validated['address'] ?? null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            $product->decrement('stock', $validated['quantity']);

            \DB::commit();

            return redirect('/porkhub/placeorder')->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Unable to place order.')->withInput();
        }
    }

    public function userHome()
    {
        $reviews = Review::with('user')->latest()->take(3)->get(); 
        return view('porkhub.userhome', compact('reviews'));
    }


    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('porkhub.updateUser', compact('user'));
    }
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ];

        if ($user->role === 'admin') {
            $rules['is_admin'] = 'required|boolean';
        }

        $validated = $request->validate($rules);

        $user->update($validated);

        return redirect('/dashboard')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return redirect('/dashboard')->with('error', 'You cannot delete yourself.');
        }

        $user->delete();

        return redirect('/dashboard')->with('success', 'User deleted successfully.');
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,shipping,delivered,cancelled',
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Order deleted successfully.');
    }

    public function storeReview(Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:500',
        ]);

        $review = Review::create([
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('user.home')->with('success', 'Thank you for your review!');
    }

    public function showUserReviewForm()
    {
        return view('porkhub.review');
    }

    public function deleteReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully.');
    }
} 