<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PorkHub Product Created</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="icon" href="{{ asset('images/logo-removebg-preview.png') }}" type="image/x-icon">
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased font-sans overflow-x-hidden">

    <!-- Header -->
    <header class="fixed top-0 w-full bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm shadow-lg z-50 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo-removebg-preview.png') }}" class="w-8 h-9 transform group-hover:scale-110 transition-transform duration-300" alt="Porkhub Logo" />
                    <span class="text-red-600 dark:text-red-500 text-2xl font-semibold group-hover:text-red-700 transition-colors duration-300" style="font-family: 'Dancing Script', cursive;">Porkhub</span>
                </a>
                <nav class="flex items-center space-x-8">
                    <a href="{{ url('/') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600">Home</a>
                    <a href="/porkhub/list" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600">Products</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline-block">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white text-sm font-semibold px-5 py-2 rounded-lg hover:bg-red-700 transition-all duration-300">Logout</button>
                        </form>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-24 pb-16">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Success Header -->
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">PorkHub Product Created Successfully</h1>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Your product has been added to the catalog.</p>
            </div>

            <!-- Product Details Card -->
            <section class="bg-white dark:bg-gray-800/80 shadow-xl rounded-2xl border border-gray-200/60 dark:border-gray-700/70 p-6 sm:p-8 space-y-4">
                <p class="font-semibold text-gray-900 dark:text-gray-100">Name: {{ $product->product_name }}</p>
                <p class="text-gray-700 dark:text-gray-300">Description: {{ $product->product_description }}</p>
                <p class="text-gray-700 dark:text-gray-300">Price: ${{ $product->product_price }}</p>
                <p class="text-gray-700 dark:text-gray-300">Stock: {{ $product->stock }}</p>
                <p class="text-gray-700 dark:text-gray-300">Category: {{ $product->category ?? 'N/A' }}</p>
                @if($product->image_path)
                    <div>
                        <p class="text-gray-700 dark:text-gray-300 font-semibold">Image:</p>
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->product_name }}" class="mt-2 w-40 rounded-lg shadow-sm">
                    </div>
                @endif
            </section>

            <!-- Action Buttons -->
            <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="/porkhub/create" class="w-full sm:w-auto text-center bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                    Create Another Product
                </a>
                <a href="/porkhub/list" class="w-full sm:w-auto text-center bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-900 dark:text-gray-100 font-semibold px-6 py-3 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                    Go to Products List
                </a>
            </div>

        </div>
    </main>

</body>
</html>
