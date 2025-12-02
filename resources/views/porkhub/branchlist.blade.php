<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PorkHub Branch List</title>
    <link rel="icon" href="{{ asset('images/logo-removebg-preview.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased font-sans overflow-x-hidden">

    <!-- Header (same as other pages) -->
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
                    <a href="{{ url('/') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300">
                        Home
                    </a>
                    <a href="/branches" class="text-sm font-medium text-red-600 dark:text-red-500 hover:text-red-700 transition-all duration-300">
                        Branches
                    </a>
                    <a href="/porkhub/list" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300">
                        Dishes
                    </a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300">
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

    <main class="pt-24 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">
                        Branch List
                    </h1>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Manage all your restaurant branches.
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="/branches/create"
                       class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-md hover:shadow-xl transform hover:-translate-y-0.5 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add New Branch
                    </a>
                </div>
            </div>

            <!-- Flash message -->
            @if (session('success'))
                <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-800 px-4 py-3 text-sm flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Branch table -->
            <section class="bg-white dark:bg-gray-800/80 shadow-xl rounded-2xl border border-gray-200/60 dark:border-gray-700/70 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-900/50">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">Address</th>
                                <th class="px-4 py-3 text-right font-semibold text-xs text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800 bg-white dark:bg-gray-800">
                            @foreach ($branches as $branch)
                                <tr class="hover:bg-gray-50/70 dark:hover:bg-gray-700/60 transition-colors">
                                    <td class="px-4 py-3 text-gray-700 dark:text-gray-200">{{ $branch->id }}</td>
                                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100 font-semibold">{{ $branch->name }}</td>
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $branch->address }}</td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="inline-flex gap-2">
                                            <a href="/branches/edit/{{ $branch->id }}" class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold bg-blue-500 hover:bg-blue-600 text-white shadow-sm hover:shadow-md transition">
                                                Edit
                                            </a>
                                            <form action="/branches/delete/{{ $branch->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this branch?');">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold bg-rose-500 hover:bg-rose-600 text-white shadow-sm hover:shadow-md transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if ($branches->isEmpty())
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                        No branches found. Click
                                        <a href="/branches/create" class="text-red-600 hover:text-red-700 font-semibold">
                                            "Add New Branch"
                                        </a>
                                        to add your first branch.
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
