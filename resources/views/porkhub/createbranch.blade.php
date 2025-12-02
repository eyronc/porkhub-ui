<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Branch</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased font-sans overflow-x-hidden">

    <!-- Header (optional, same as your Dish form header) -->
    <header class="fixed top-0 w-full bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm shadow-lg z-50 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-removebg-preview.png') }}" class="w-8 h-9" alt="Logo">
                    <span class="text-red-600 dark:text-red-500 text-2xl font-semibold" style="font-family: 'Dancing Script', cursive;">Porkhub</span>
                </a>
            </div>
        </div>
    </header>

    <main class="pt-24 pb-16">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">Add a Branch</h1>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Create a new restaurant branch for your system.</p>
            </div>

            <section class="bg-white dark:bg-gray-800/80 shadow-xl rounded-2xl border border-gray-200/60 dark:border-gray-700/70 overflow-hidden p-6 sm:p-8">

                <form action="../branches/store" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="branchName" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Branch Name</label>
                        <input type="text" name="name" id="branchName" placeholder="Enter branch name"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300">
                        @error('name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="branchAddress" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Branch Address</label>
                        <input type="text" name="address" id="branchAddress" placeholder="Enter branch address"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300">
                        @error('address')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105">
                        Create Branch
                    </button>
                </form>

                <a href="{{ route('branches.list') }}" class="inline-block mt-4 text-sm text-red-600 hover:text-red-700">← Go back to Branches list</a>

            </section>
        </div>
    </main>
</body>
</html>
