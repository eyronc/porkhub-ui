<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create PorkHub Product</title>
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
                    <a href="{{ url('/') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600">Home</a>
                    <a href="{{ route(name: 'branches.list') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300">Branches</a>
                    <a href="/porkhub/list" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600">Dishes</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline-block">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white text-sm font-semibold px-5 py-2 rounded-lg hover:bg-red-700">Logout</button>
                        </form>
                    @else
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="bg-red-600 text-white text-sm font-semibold px-5 py-2 rounded-lg hover:bg-red-700">Login</a>
                        @endif
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-24 pb-16">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">Create PorkHub Product</h1>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Add a new premium pork product to your catalog.</p>
            </div>

            <!-- Form Card -->
            <section class="bg-white dark:bg-gray-800/80 shadow-xl rounded-2xl border border-gray-200/60 dark:border-gray-700/70 overflow-hidden p-6 sm:p-8">
                <form method="POST" action="/porkhub" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label for="productName" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Product Name</label>
                        <input type="text" name="product_name" id="productName" placeholder="Enter product name" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        @error('product_name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="productPrice" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Price</label>
                            <input type="number" step="0.01" name="product_price" id="productPrice" placeholder="0.00" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            @error('product_price') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="stock" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Stock</label>
                            <input type="number" name="stock" id="stock" placeholder="0" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            @error('stock') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Description</label>
                        <textarea name="product_description" id="description" rows="4" placeholder="Enter product description" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-transparent"></textarea>
                        @error('product_description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Category</label>
                        <select name="category" id="category" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="">Select Category</option>
                            <option value="Main Dish">Main Dish</option>
                            <option value="Side Dish">Side Dish</option>
                            <option value="Dessert">Dessert</option>
                            <option value="Beverage">Beverage</option>
                            <option value="Other">Other</option>
                        </select>
                        @error('category') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div id="customCategoryDiv" style="display:none;">
                        <label for="customCategory" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Custom Category</label>
                        <input type="text" name="custom_category" id="customCategory" placeholder="Enter custom category" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    </div>

                <script>
                    document.getElementById('category').addEventListener('change', function() {
                        document.getElementById('customCategoryDiv').style.display = this.value === 'Other' ? 'block' : 'none';
                    });
                </script>

                    <div>
                        <label for="image" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Product Image</label>
                        <input type="file" name="image_path" id="image" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        @error('image_path') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105">
                        Create Product
                    </button>
                </form>

                <a href="/porkhub/list" class="mt-4 inline-block text-red-600 hover:text-red-700 font-semibold">Go to PorkHub products list</a>
            </section>
        </div>
    </main>
</body>
</html>
