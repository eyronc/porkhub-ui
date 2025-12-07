<!-- resources/views/porkhub/addorder.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order - Porkhub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('images/logo-removebg-preview.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
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
                <a href="\porkhub\userhome" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600">Home</a>
                <a href="\porkhub\order" class="text-sm font-medium text-red-600 dark:text-red-500">Products</a>
                <a href="{{ route('cart.show') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600">My Cart</a>
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

<!-- Alerts -->
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-28">
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg border border-red-200">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<!-- Main Content -->
<main class="pt-6 pb-12 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Back Button --}}
        <a href="{{ url('/porkhub/order') }}" class="inline-flex items-center gap-2 text-red-600 hover:text-red-700 mb-6 font-semibold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Products
        </a>

        <div class="grid md:grid-cols-2 gap-8 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
            {{-- Product Image --}}
            <div class="p-8 flex items-center justify-center">
                @if($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->product_name }}" class="w-full h-full object-cover rounded-lg">
                @else
                    <span class="text-gray-400 text-sm">No image available</span>
                @endif
            </div>

            {{-- Product Details --}}
            <div class="p-8 space-y-6">
                <h1 class="text-3xl font-bold mb-2 text-red-600" style="font-family: 'Dancing Script', cursive;">
                    {{ $product->product_name }}
                </h1>
                <span class="inline-block px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded-full text-sm font-semibold text-gray-700 dark:text-gray-300">
                    {{ $product->category }}
                </span>

                <div class="text-4xl font-bold text-red-600">₱{{ number_format($product->product_price, 2) }}</div>

                <div>
                    @if($product->stock > 0)
                        <span class="inline-flex items-center gap-1 px-3 py-2 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg font-semibold text-sm">
                            In Stock ({{ $product->stock }})
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-3 py-2 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-lg font-semibold text-sm">
                            Out of Stock
                        </span>
                    @endif
                </div>

                <div>
                    <h3 class="font-semibold mb-2">Description</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">{{ $product->product_description }}</p>
                </div>

                {{-- Order Form --}}
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold mb-2">Quantity</label>
                        <div class="flex items-center gap-2">
                            <button type="button" onclick="updateQuantity(-1)" class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">-</button>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-center dark:bg-gray-700 focus:ring-2 focus:ring-red-600">
                            <button type="button" onclick="updateQuantity(1)" class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">+</button>
                        </div>
                    </div>

                    <button type="submit" {{ $product->stock <= 0 ? 'disabled' : '' }} class="w-full py-3 bg-red-600 hover:bg-red-700 disabled:bg-gray-400 text-white font-bold rounded-lg">
                        {{ $product->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-400 py-12 border-t border-gray-800 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-2xl text-red-500 font-bold" style="font-family: 'Dancing Script', cursive;">Porkhub</p>
        <p class="text-sm text-gray-500">&copy; 2024 Porkhub. All rights reserved.</p>
    </div>
</footer>

<script>
function updateQuantity(change) {
    const input = document.getElementById('quantity');
    let value = parseInt(input.value) + change;
    const min = parseInt(input.min);
    const max = parseInt(input.max);
    if (value < min) value = min;
    if (value > max) value = max;
    input.value = value;
}
</script>
</body>
</html>
