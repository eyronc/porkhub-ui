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
                    <a href="\porkhub\home" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600">Home</a>
                    <a href="\porkhub\order" class="text-sm font-medium text-red-600 dark:text-red-500">Products</a>
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
            {{-- Back Button --}}
            <a href="../../porkhub/order" class="inline-flex items-center gap-2 text-red-600 hover:text-red-700 mb-6 font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Products
            </a>

            <div class="grid md:grid-cols-2 gap-8 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                {{-- Product Image --}}
                <div class="p-8 space-y-4">
                    <div class="aspect-square bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden flex items-center justify-center">
                        @if($product->image_path)
                            <img
                                id="mainImage"
                                src="{{ asset('storage/' . $product->image_path) }}"
                                alt="{{ $product->product_name }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                            />
                        @else
                            <span class="text-gray-400 text-sm">No image available</span>
                        @endif
                    </div>
                </div>

                {{-- Product Details --}}
                <div class="p-8 space-y-6">
                    {{-- Title & Category --}}
                    <div>
                        <h1 class="text-3xl font-bold mb-2" style="font-family: 'Dancing Script', cursive; color: #dc2626;">
                            {{ $product->product_name }}
                        </h1>
                        <span class="inline-block px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded-full text-sm font-semibold text-gray-700 dark:text-gray-300">
                            {{ $product->category }}
                        </span>
                    </div>

                    {{-- Price --}}
                    <div class="flex items-center gap-3">
                        <span class="text-4xl font-bold text-red-600">
                            ₱{{ number_format($product->product_price, 2) }}
                        </span>
                    </div>

                    {{-- Stock Status --}}
                    <div>
                        @if($product->stock > 0)
                            <span class="inline-flex items-center gap-1 px-3 py-2 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg font-semibold text-sm">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                                In Stock ({{ $product->stock }})
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-3 py-2 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-lg font-semibold text-sm">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                                </svg>
                                Out of Stock
                            </span>
                        @endif
                    </div>

                    {{-- Description --}}
                    <div>
                        <h3 class="font-semibold mb-2">Description</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                            {{ $product->product_description }}
                        </p>
                    </div>

                    {{-- Order Form --}}
                    <form action="/porkhub/addOrderToCart/{{ $product->id }}" method="POST" class="space-y-4">
                        @csrf

                        {{-- Quantity --}}
                        <div>
                            <label class="block text-sm font-semibold mb-2">Quantity</label>
                            <div class="flex items-center gap-2">
                                <button
                                    type="button"
                                    onclick="const q = document.getElementById('quantity'); if (q.value > 1) q.value--;"
                                    class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                    </svg>
                                </button>
                                <input
                                    type="number"
                                    id="quantity"
                                    name="quantity"
                                    value="1"
                                    min="1"
                                    max="{{ $product->stock }}"
                                    class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-center dark:bg-gray-700 focus:ring-2 focus:ring-red-600"
                                >
                                <button
                                    type="button"
                                    onclick="const q = document.getElementById('quantity'); if (q.value < {{ $product->stock }}) q.value++;"
                                    class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Add to Cart Button --}}
                        <button
                            type="submit"
                            {{ $product->stock <= 0 ? 'disabled' : '' }}
                            class="w-full py-3 bg-red-600 hover:bg-red-700 disabled:bg-gray-400 text-white font-bold rounded-lg transition-all duration-300 flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            {{ $product->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                        </button>
                        <input type="hidden" name="redirect" value="porkhub\order">

                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12 border-t border-gray-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center space-y-4">
                <p class="text-2xl text-red-500 font-bold" style="font-family: 'Dancing Script', cursive;">Porkhub</p>
                <p class="text-sm text-gray-500">&copy; 2024 Porkhub. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function increaseQuantity() {
            const input = document.getElementById('quantity');
            input.value = parseInt(input.value) + 1;
        }

        function decreaseQuantity() {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
    </script>
</body>
</html>