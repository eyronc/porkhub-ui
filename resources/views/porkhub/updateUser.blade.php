<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User - PorkHub</title>
    <link rel="icon" href="{{ asset('images/logo-removebg-preview.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased font-sans overflow-x-hidden">

    <!-- Header -->
    <header class="fixed top-0 w-full bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm shadow-lg z-50 border-b border-gray-200 dark:border-gray-700 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo-removebg-preview.png') }}" class="w-8 h-9 transform group-hover:scale-110 transition-transform duration-300" alt="Porkhub Logo" />
                    <span class="text-red-600 dark:text-red-500 text-2xl font-semibold group-hover:text-red-700 transition-colors duration-300" style="font-family: 'Dancing Script', cursive;">
                        Porkhub
                    </span>
                </a>
                <nav class="flex items-center space-x-8">
                    <a href="{{ url('/') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300">Home</a>
                    <a href="/branches" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300">Branches</a>
                    <a href="/porkhub/list" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300">Dishes</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-red-600 dark:text-red-500 hover:text-red-700 transition-all duration-300">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline-block">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white text-sm font-semibold px-5 py-2 rounded-lg hover:bg-red-700 transition-all duration-300 shadow-md hover:shadow-xl transform hover:scale-105">Logout</button>
                        </form>
                    @else
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="bg-red-600 text-white text-sm font-semibold px-5 py-2 rounded-lg hover:bg-red-700 transition-all duration-300 shadow-md hover:shadow-xl transform hover:scale-105">Login</a>
                        @endif
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <main class="pt-28 pb-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Title -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">Update User</h1>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Modify the user details below.</p>
            </div>

            <!-- Flash messages -->
            @if (session('success'))
                <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-800 px-4 py-3 text-sm flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 rounded-lg border border-rose-200 bg-rose-50 text-rose-800 px-4 py-3 text-sm flex items-center justify-between">
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Form Card -->
            <section class="bg-white dark:bg-gray-800/80 shadow-xl rounded-2xl border border-gray-200/60 dark:border-gray-700/70 p-6">
                <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 shadow-sm focus:border-red-600 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 shadow-sm focus:border-red-600 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                        @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Only show Is Admin if user is admin -->
                    @if($user->role === 'admin')
                    <div>
                        <label for="is_admin" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Is Admin?</label>
                        <select name="is_admin" id="is_admin" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 shadow-sm focus:border-red-600 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                            <option value="0" {{ $user->is_admin ? '' : 'selected' }}>No</option>
                            <option value="1" {{ $user->is_admin ? 'selected' : '' }}>Yes</option>
                        </select>
                        @error('is_admin') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    @endif

                    <!-- Submit & Delete buttons -->
                    <div class="flex flex-wrap gap-3">
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-semibold shadow-md hover:shadow-xl transform hover:scale-105 transition">Update User</button>
                        <form action="{{ route('users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            <button type="submit" class="bg-rose-500 hover:bg-rose-600 text-white px-5 py-2 rounded-lg font-semibold shadow-md hover:shadow-xl transform hover:scale-105 transition">Delete User</button>
                        </form>
                        <a href="{{ url('/dashboard') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-900 px-5 py-2 rounded-lg font-semibold shadow-md hover:shadow-xl transform hover:-translate-y-0.5 transition">Back to Dashboard</a>
                    </div>
                </form>
            </section>

        </div>
    </main>
</body>
</html>