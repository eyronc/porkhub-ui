<!-- resources/views/cart/showcart.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart - Porkhub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('images/logo-removebg-preview.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased font-sans">

    <!-- Header -->
    <header class="fixed top-0 w-full bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm shadow-lg z-50 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">
            <div class="flex items-center justify-between h-16">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-removebg-preview.png') }}" class="w-8 h-9" alt="Porkhub Logo">
                    <span class="text-red-600 dark:text-red-500 text-2xl font-semibold" style="font-family: 'Dancing Script', cursive;">Porkhub</span>
                </a>
                <nav class="flex items-center gap-10">
                    <a href="/porkhub/userhome" class="text-sm font-medium hover:text-red-600">Home</a>
                    <a href="/porkhub/order" class="text-sm font-medium hover:text-red-600">Products</a>
                    <a href="{{ route('cart.show') }}" class="text-sm font-medium text-red-600 dark:text-red-500">My Cart</a>
                    @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700 text-sm font-semibold">
                            Logout
                        </button>
                    </form>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <main class="pt-24 pb-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">

            <h1 class="text-4xl font-bold mb-8 text-red-600" style="font-family: 'Dancing Script', cursive;">
                My Cart
            </h1>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($cart && count($cart) > 0)

            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl p-6 overflow-x-auto">

                <table class="w-full text-left text-lg">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700 border-b">
                            <th class="px-6 py-4">Product</th>
                            <th class="px-6 py-4">Price</th>
                            <th class="px-6 py-4">Quantity</th>
                            <th class="px-6 py-4">Subtotal</th>
                            <th class="px-6 py-4">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php 
                            $total = 0;
                            $productIds = array_keys($cart);
                            $products = \App\Models\PorkHub::whereIn('id', $productIds)->get()->keyBy('id');
                        @endphp

                        @foreach($cart as $id => $item)
                        @php 
                            $total += $item['subtotal'];
                            $currentStock = $products->has($id) ? $products[$id]->stock : 0;
                        @endphp

                        <tr class="border-b dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-lg">
                                {{ $item['name'] }}
                            </td>

                            <td class="px-6 py-4">
                                ₱{{ number_format($item['price'], 2) }}
                            </td>

                            <td class="px-6 py-4">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-3">
                                    @csrf
                                    <input 
                                        type="number" 
                                        name="quantity" 
                                        min="1"
                                        max="{{ $currentStock }}"
                                        value="{{ $item['quantity'] }}"
                                        class="w-20 px-3 py-2 border rounded-lg dark:bg-gray-700 text-center"
                                    >
                                    <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm">
                                        Update
                                    </button>
                                </form>
                                <p class="text-xs text-gray-500 mt-1">Available: {{ $currentStock }}</p>
                            </td>

                            <td class="px-6 py-4">
                                ₱{{ number_format($item['subtotal'], 2) }}
                            </td>
 
                            <td class="px-6 py-4">
                                <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Remove this item from cart?');">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold"> Remove </button>
                                </form>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>

                <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear your cart?');">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 mt-4">
                        Clear Cart
                    </button>
                </form>


                <div class="flex justify-between items-center mt-8">
                    <p class="text-2xl font-bold">
                        Total: ₱{{ number_format($total, 2) }}
                    </p>
                    <a href="{{ route('cart.checkout') }}"
                        class="px-8 py-3 bg-red-600 text-white text-lg font-bold rounded-xl hover:bg-red-700">
                        Proceed to Checkout
                    </a>
                </div>

            </div>

            @else
                <p class="text-center text-gray-500 text-xl py-10">
                    Your cart is empty.
                </p>
            @endif

        </div>
    </main>

    <footer class="bg-gray-900 text-gray-400 py-12 mt-20 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-6 lg:px-10 text-center">
            <p class="text-3xl text-red-500 font-bold" style="font-family: 'Dancing Script', cursive;">Porkhub</p>
            <p class="text-sm mt-2">&copy; 2024 Porkhub. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>