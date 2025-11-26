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

}
    