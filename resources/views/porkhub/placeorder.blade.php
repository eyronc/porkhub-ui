<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Place Order</title>
    <link rel = "icon" href = "{{ asset('images/logo-removebg-preview.png') }}" type = "image/x-icon">
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
                    <a href="\porkhub\userhome" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full pb-1 pt-1">
                        Home
                    </a>
                    <a href="\porkhub\order" class="text-sm font-medium text-red-600 dark:text-red-500 hover:text-red-700 transition-all duration-300 pb-1 pt-1">
                        Products
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
                        <a href="/" class="inline-flex items-center gap-1 bg-red-600 text-white px-3 py-1.5 rounded-lg hover:bg-red-700 transition-all duration-300 shadow-md hover:shadow-lg text-sm">
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
                                <form action="/porkhub/addOrderToCart/{{ $item->id }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-3 py-2 rounded-md text-sm font-semibold bg-green-500 hover:bg-green-600 text-white shadow-sm">
                                        Add Order
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                @endforeach

                @if ($product->isEmpty())
                    <div class="col-span-full text-center py-12">
                        <p class="text-sm text-gray-500 dark:text-gray-400">No products found. Please check back later or contact the administrator. </p>
                    </div>
                @endif
            </div>
        </div>
    </section>
</body>
</html>
