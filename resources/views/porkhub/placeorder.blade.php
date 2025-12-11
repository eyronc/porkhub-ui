<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Place Order</title>
    <link rel="icon" href="{{ asset('images/logo-removebg-preview.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased font-sans overflow-x-hidden">

    <!-- Header -->
    <header class="fixed top-0 w-full bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm shadow-lg z-50 border-b border-gray-200 dark:border-gray-700 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo-removebg-preview.png') }}" class="w-8 h-9 transform group-hover:scale-110 transition-transform duration-300" alt="Porkhub Logo" />
                    <span class="text-red-600 dark:text-red-500 text-2xl font-semibold group-hover:text-red-700 transition-colors duration-300" style="font-family: 'Dancing Script', cursive;">
                        Porkhub
                    </span>
                </a>

                <!-- Navigation -->
                <nav class="flex items-center space-x-8">
                    <a href="{{ route('user.home') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full pb-1 pt-1">
                        Home
                    </a>
                    <a href="{{ route('user.menu') }}" class="text-sm font-medium text-red-600 dark:text-red-500 hover:text-red-700 transition-all duration-300 pb-1 pt-1">
                        Products
                    </a>
                    <a href="{{ route('cart.show') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full pb-1 pt-1">
                        My Cart
                    </a>
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="inline-block">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white text-sm font-semibold px-5 py-2 rounded-lg hover:bg-red-700 transition-all duration-300 shadow-md hover:shadow-xl transform hover:scale-105">
                                Logout
                            </button>
                        </form>
                    @else
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="bg-red-600 text-white text-sm font-semibold px-5 py-2 rounded-lg hover:bg-red-700 transition-all duration-300 shadow-md hover:shadow-xl transform hover:scale-105">
                                Login
                            </a>
                        @endif
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- Card layout -->
    <section class="pt-24 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Page header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">Menu</h1>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">A detailed view of the menu.</p>
                </div>

                <!-- Cart Button -->
                <div class="fixed top-50 right-20 z-40">
                    <a href="{{ route('cart.show') }}" class="inline-flex items-center gap-1 bg-red-600 text-white px-3 py-1.5 rounded-lg hover:bg-red-700 transition-all duration-300 shadow-md hover:shadow-lg text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="font-semibold">Cart</span>
                    </a>
                </div>
            </div>

            <!-- Cards grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($product as $item)
                    <article class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200/60 dark:border-gray-700/70 overflow-hidden">
                        <div class="p-4 sm:p-6 flex flex-col h-full">
                            <div class="flex items-start gap-4">
                                <div class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700">
                                    @if($item->image_path)
                                        <img src="{{ asset('storage/' . $item->image_path) }}"
                                             alt="{{ $item->product_name }}"
                                             class="w-20 h-20 object-cover rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                                    @else
                                        <span class="text-xs text-gray-400">N/A</span>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $item->product_name }}</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $item->category }}</p>
                                </div>
                            </div>

                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-4 line-clamp-3">{{ $item->product_description }}</p>

                            <div class="mt-4 flex items-center justify-between gap-4">
                                <div class="space-y-1">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Price</div>
                                    <div class="text-lg font-bold text-gray-900 dark:text-gray-100">₱{{ $item->product_price }}</div>
                                </div>

                                <div class="text-right">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Stock</div>
                                    <div class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        @if($item->stock > 20)
                                            bg-emerald-50 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300
                                        @elseif($item->stock > 0)
                                            bg-amber-50 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300
                                        @else
                                            bg-rose-50 text-rose-700 dark:bg-rose-900/40 dark:text-rose-300
                                        @endif
                                    ">
                                        {{ $item->stock }}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 flex items-center gap-3">
                                <a href="{{ route('cart.addForm', $item->id) }}" class="inline-flex items-center px-3 py-2 rounded-md text-sm font-semibold bg-green-500 hover:bg-green-600 text-white shadow-sm">
                                    Add Order
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach

                @if ($product->isEmpty())
                    <div class="col-span-full text-center py-12">
                        <p class="text-sm text-gray-500 dark:text-gray-400">No products found. Please check back later or contact the administrator.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Review Popup -->
    @if (session('review_popup_shown'))
        <div id="review-popup" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-md w-full">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Your order has been delivered!</h3>
                    <button id="close-popup" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                    Thank you for choosing us! Please take a moment to leave a review for your order.
                </p>
                <div class="mt-4 flex justify-between gap-4">
                    <!-- Continue Shopping Button (Left) -->
                    <button id="continue-shopping" class="inline-flex items-center px-4 py-2 text-sm font-semibold bg-gray-500 hover:bg-gray-600 text-white rounded-md shadow-sm transition-all duration-300">
                        Continue Shopping
                    </button>
                    
                    <!-- Leave a Review Button (Right) -->
                    <a href="{{ route('user.reviews') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-sm transition-all duration-300">
                        Leave a Review
                    </a>
                </div>
            </div>
        </div>

        <script>
            // Close button (X) - Just hides popup, will show again next time
            document.getElementById('close-popup').addEventListener('click', function() {
                document.getElementById('review-popup').style.display = 'none';
            });

            // Continue Shopping button - Dismisses popup permanently until next delivery
            document.getElementById('continue-shopping').addEventListener('click', function() {
                document.getElementById('review-popup').style.display = 'none';
                
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch('/close-review-popup', { 
                    method: 'POST', 
                    headers: { 
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    } 
                });
            });
        </script>
    @endif
</body>
</html>