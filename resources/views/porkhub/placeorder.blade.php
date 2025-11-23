<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PorkHub Product List</title>
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
                    <a href="{{ url('/') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full pb-1 pt-1">
                        Home
                    </a>
                    <a href="\porkhub\list" class="text-sm font-medium text-red-600 dark:text-red-500 hover:text-red-700 transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full pb-1 pt-1">
                        Products
                    </a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full pb-1 pt-1">
                            Dashboard
                        </a>
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

    <!-- Main Content -->
    <main class="pt-24 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Page header / title + actions -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">
                        Product List
                    </h1>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Manage all your premium pork products in one place.
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="/porkhub/create"
                       class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-md hover:shadow-xl transform hover:-translate-y-0.5 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Create New Product
                    </a>
                </div>
            </div>

            <!-- Flash message -->
            @if (session('success'))
                <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-800 px-4 py-3 text-sm flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Card wrapper -->
            <section class="bg-white dark:bg-gray-800/80 shadow-xl rounded-2xl border border-gray-200/60 dark:border-gray-700/70 overflow-hidden">
                <!-- Card header row (summary + search placeholder) -->
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div class="space-y-1">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            All Products
                        </h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Showing {{ count($product) }} item(s) in your catalog.
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <input
                                type="text"
                                placeholder="Search products..."
                                class="w-48 sm:w-64 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/60 text-sm px-3 py-2 pl-9 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                            />
                            <svg class="w-4 h-4 absolute left-2.5 top-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Responsive table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-900/50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">
                                    Description
                                </th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">
                                    Category
                                </th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">
                                    Price
                                </th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">
                                    Stock
                                </th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">
                                    Image
                                </th>
                                <th scope="col" class="px-4 py-3 text-right font-semibold text-xs text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800 bg-white dark:bg-gray-800">
                            @foreach ($product as $item)
                                <tr class="hover:bg-gray-50/70 dark:hover:bg-gray-700/60 transition-colors">
                                    <td class="px-4 py-3 align-top text-gray-700 dark:text-gray-200">
                                        {{ $item->id }}
                                    </td>
                                    <td class="px-4 py-3 align-top">
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-gray-900 dark:text-gray-100">
                                                {{ $item->product_name }}
                                            </span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $item->category }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 align-top text-gray-600 dark:text-gray-300 max-w-xs">
                                        <p class="line-clamp-3 text-xs sm:text-sm">
                                            {{ $item->product_description }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3 align-top">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                                            {{ $item->category }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 align-top font-semibold text-gray-900 dark:text-gray-100">
                                        ₱{{ $item->product_price }}
                                    </td>
                                    <td class="px-4 py-3 align-top">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                            @if($item->stock > 20)
                                                bg-emerald-50 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300
                                            @elseif($item->stock > 0)
                                                bg-amber-50 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300
                                            @else
                                                bg-rose-50 text-rose-700 dark:bg-rose-900/40 dark:text-rose-300
                                            @endif
                                        ">
                                            Stock: {{ $item->stock }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 align-top">
                                        @if($item->image_path)
                                            <img src="{{ asset('storage/' . $item->image_path) }}"
                                                 alt="{{ $item->product_name }}"
                                                 class="w-16 h-16 object-cover rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                                        @else
                                            <span class="text-xs text-gray-400">N/A</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 align-top text-right">
                                        <div class="inline-flex gap-2">
                                            <form action="/porkhub/edit/{{ $item->id }}" method="GET">
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold bg-blue-500 hover:bg-blue-600 text-white shadow-sm hover:shadow-md transition">
                                                    Edit
                                                </button>
                                            </form>
                                            <form action="/porkhub/delete/{{ $item->id }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold bg-rose-500 hover:bg-rose-600 text-white shadow-sm hover:shadow-md transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if ($product->isEmpty())
                                <tr>
                                    <td colspan="8" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                        No products found. Click
                                        <a href="/porkhub/create" class="text-red-600 hover:text-red-700 font-semibold">
                                            "Create New Product"
                                        </a>
                                        to add your first item.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>
</body>
</html>