<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success - Porkhub</title>
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

    <!-- Main -->
    <main class="pt-24 pb-12 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 p-6 bg-green-100 text-green-800 rounded-lg border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                <h1 class="text-3xl font-bold mb-6 text-red-600" style="font-family: 'Dancing Script', cursive;">Order Placed Successfully!</h1>

                <h2 class="text-xl font-semibold mb-4 text-gray-700 dark:text-gray-300">Order Details</h2>

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
                        @foreach($order->items as $item)
                            @php $total += $item->subtotal; @endphp
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $item->dish->product_name }}</td>
                                <td class="px-6 py-4">₱{{ number_format($item->dish->product_price, 2) }}</td>
                                <td class="px-6 py-4">{{ $item->quantity }}</td>
                                <td class="px-6 py-4">₱{{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <p class="text-lg font-semibold mb-4">Total Amount: ₱{{ number_format($total, 2) }}</p>
                <p class="mb-2"><span class="font-semibold">Restaurant Branch:</span> {{ $order->restaurantBranch->name }} - {{ $order->restaurantBranch->address }}</p>
                <p class="mb-2"><span class="font-semibold">Payment Method:</span> {{ ucfirst($order->payment_method) }}</p>
                <p class="mb-2"><span class="font-semibold">Status:</span> {{ ucfirst($order->status) }}</p>
                <p class="mb-2"><span class="font-semibold">Address:</span> {{ $order->user_address }}</p>
                <div class="mt-6 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('user.menu') }}" class="w-full sm:w-auto py-3 px-6 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg text-center transition-all duration-300">
                        Continue Shopping
                    </a>
                    <a href="{{ route('user.home') }}" class="w-full sm:w-auto py-3 px-6 border border-gray-300 rounded-lg text-center hover:bg-gray-100 transition-all duration-300">
                        Go to Home
                    </a>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
