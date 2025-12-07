<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PorkHub;

class PorkHubController extends Controller
{
    
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
        return view('porkhub.userhome');
    }

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

    public function showCheckout()
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
    }

    // Get restaurant branches for selection
    $branches = \App\Models\RestaurantBranch::all();

    // Get logged-in user's name from Breeze
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
        'payment_method' => 'required|string|in:cash,gcash,maya',
        'buyer_name' => 'required|string|max:255',
    ]);

    \DB::beginTransaction();

    try {
        // Calculate total amount
        $totalAmount = array_sum(array_column($cart, 'subtotal'));

        // Create the main order
        $orderId = \DB::table('orders')->insertGetId([
            'user_id' => auth()->id(),
            'restaurant_branch_id' => $validated['branch_id'],
            'payment_method' => $validated['payment_method'],
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert each item into order_items
        foreach ($cart as $id => $item) {
            $dish = PorkHub::find($id); // your dishes table

            if (!$dish) continue;

            if ($dish->stock < $item['quantity']) {
                \DB::rollBack();
                return back()->with('error', 'Not enough stock for: ' . $dish->product_name);
            }

            \DB::table('order_items')->insert([
                'order_id' => $orderId,
                'dish_id' => $id, // <-- match your migration
                'quantity' => $item['quantity'],
                'price' => $dish->product_price,
                'subtotal' => $item['subtotal'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Decrement stock
            $dish->decrement('stock', $item['quantity']);
        }

        \DB::commit();

        // Clear cart
        session()->forget('cart');

        return redirect()->route('order.success')->with('success', 'Order placed successfully! Total: ₱' . number_format($totalAmount, 2));

    } catch (\Exception $e) {
        \DB::rollBack();
        return back()->with('error', 'Unable to place order: ' . $e->getMessage());
    }
}



public function orderSuccess()
{
    // Get the latest order of the logged-in user
    $order = \App\Models\Order::with(['items.dish', 'restaurantBranch'])
                ->where('user_id', auth()->id())
                ->latest()
                ->first();

    if (!$order) {
        return redirect()->route('user.menu')->with('error', 'No recent order found.');
    }

    return view('porkhub.ordersuccess', compact('order'));
}



}
    