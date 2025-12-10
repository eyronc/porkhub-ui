<!-- resources/views/cart/checkout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Porkhub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('images/logo-removebg-preview.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased font-sans">

    <!-- Header -->
    <header class="fixed top-0 w-full bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm shadow-lg z-50 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo-removebg-preview.png') }}" class="w-8 h-9" alt="Porkhub Logo" />
                    <span class="text-red-600 dark:text-red-500 text-2xl font-semibold" style="font-family: 'Dancing Script', cursive;">Porkhub</span>
                </a>
                <nav class="flex items-center space-x-8">
                    <a href="{{ route('user.home') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600">Home</a>
                    <a href="{{ route('user.menu') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600">Products</a>
                    <a href="{{ route('cart.show') }}" class="text-sm font-medium text-red-600 dark:text-red-500">My Cart</a>
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="inline-block">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white text-sm font-semibold px-5 py-2 rounded-lg hover:bg-red-700">Logout</button>
                        </form>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-24 pb-12 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <h1 class="text-3xl font-bold mb-6 text-red-600" style="font-family: 'Dancing Script', cursive;">Checkout</h1>

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg border border-red-200">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">

                <form action="{{ route('order.finalize') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Order Details -->
                    <h2 class="text-xl font-semibold mb-4 text-red-600">Order Details</h2>

                    <table class="min-w-full text-left mb-6">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3">Product</th>
                                <th class="px-6 py-3">Price</th>
                                <th class="px-6 py-3">Quantity</th>
                                <th class="px-6 py-3">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($cart as $id => $item)
                                @php $total += $item['subtotal']; @endphp
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $item['name'] }}</td>
                                    <td class="px-6 py-4">₱{{ number_format($item['price'], 2) }}</td>
                                    <td class="px-6 py-4">{{ $item['quantity'] }}</td>
                                    <td class="px-6 py-4">₱{{ number_format($item['subtotal'], 2) }}</td>

                                    <!-- hidden input to send cart info -->
                                    <input type="hidden" name="cart[{{ $id }}][quantity]" value="{{ $item['quantity'] }}">
                                    <input type="hidden" name="cart[{{ $id }}][subtotal]" value="{{ $item['subtotal'] }}">
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <p class="text-lg font-semibold mb-4">Total: ₱{{ number_format($total, 2) }}</p>

                    <!-- Restaurant Branch -->
                    <h2 class="text-xl font-semibold mb-4 text-red-600">Choose Restaurant Branch</h2>
                    <select name="branch_id" required class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 mb-6">
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }} - {{ $branch->address }}</option>
                        @endforeach
                    </select>

                    <!-- Payment Method -->
                    <h2 class="text-xl font-semibold mb-4 text-red-600">Payment Method</h2>
                    <select name="payment_method" required class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 mb-6">
                        <option value="Cash-on-Delivery">Cash on Delivery</option>
                        <option value="Gcash">GCash</option>
                        <option value="PayMaya">PayMaya</option>
                        <option value="UnionBank">UnionBank</option>
                    </select>

                    <input type="hidden" name="buyer_name" value="{{ $userName }}">

                    <button type="submit" class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition-all duration-300">
                        Place Order
                    </button>

                </form>

                <a href="{{ route('cart.show') }}" class="w-full block mt-3 py-3 text-center border border-gray-300 rounded-lg hover:bg-gray-100">
                    Cancel / Back to Cart
                </a>

            </div>
        </div>
    </main>

    <footer class="bg-gray-900 text-gray-400 py-12 border-t border-gray-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center space-y-4">
                <p class="text-2xl text-red-500 font-bold" style="font-family: 'Dancing Script', cursive;">Porkhub</p>
                <p class="text-sm text-gray-500">&copy; 2025 Porkhub. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
