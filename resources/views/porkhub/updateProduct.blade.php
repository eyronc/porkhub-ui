<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update PorkHub Product</title>
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
                    <img src="{{ asset('images/logo-removebg-preview.png') }}" class="w-8 h-9" alt="Porkhub Logo" />
                    <span class="text-red-600 dark:text-red-500 text-2xl font-semibold" style="font-family: 'Dancing Script', cursive;">Porkhub</span>
                </a>
                <nav class="flex items-center space-x-6">
                    <a href="{{ url('/') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600">Home</a>
                    <a href="/porkhub/list" class="text-sm font-medium text-red-600 dark:text-red-500">Products</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600">Dashboard</a>
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
    <main class="pt-24 pb-16">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">
                    Update PorkHub Product
                </h1>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Edit your product details below.
                </p>
            </div>

            <!-- Form Card -->
            <section class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-6 sm:p-8 border border-gray-200/60 dark:border-gray-700/70">
                <form method="POST" action="{{ url("/porkhub/edit/{$product->id}") }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Product Name -->
                    <div>
                        <label for="productName" class="block text-sm font-semibold mb-2">Product Name</label>
                        <input type="text" id="productName" name="product_name" value="{{ $product->product_name }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        @error('product_name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price & Stock -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="productPrice" class="block text-sm font-semibold mb-2">Price</label>
                            <input type="number" step="0.01" id="productPrice" name="product_price" value="{{ $product->product_price }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            @error('product_price')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="stock" class="block text-sm font-semibold mb-2">Stock</label>
                            <input type="number" id="stock" name="stock" value="{{ $product->stock }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            @error('stock')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-semibold mb-2">Category</label>
                    <select id="category" name="category" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        <option value="">Select Category</option>
                        <option value="Main Dish" {{ $product->category == 'Main Dish' ? 'selected' : '' }}>Main Dish</option>
                        <option value="Side Dish" {{ $product->category == 'Side Dish' ? 'selected' : '' }}>Side Dish</option>
                        <option value="Dessert" {{ $product->category == 'Dessert' ? 'selected' : '' }}>Dessert</option>
                        <option value="Beverage" {{ $product->category == 'Beverage' ? 'selected' : '' }}>Beverage</option>
                        <option value="Other">Other</option>
                    </select>
                    @error('category')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
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

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold mb-2">Description</label>
                        <textarea id="description" name="product_description" rows="4" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:ring-2 focus:ring-red-500 focus:border-transparent">{{ $product->product_description }}</textarea>
                        @error('product_description')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Image -->
                    <div>
                        <label for="image" class="block text-sm font-semibold mb-2">Product Image</label>
                        <input type="file" id="image" name="image_path" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        @if($product->image_path)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" class="w-32 rounded">
                            </div>
                        @endif
                        @error('image_path')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition-all duration-300">
                        Update Product
                    </button>

                </form>

                <div class="mt-4 text-center">
                    <a href="/porkhub/list" class="text-red-600 hover:text-red-700 font-semibold">← Back to Products List</a>
                </div>
            </section>
        </div>
    </main>

</body>
</html>
