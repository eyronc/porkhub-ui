<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PorkHub Admin Dashboard</title>
    <link rel="icon" href="{{ asset('images/logo-removebg-preview.png') }}" type="image/x-icon" />
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
                    <a href="{{ url('/') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300">
                        Home
                    </a>
                    <a href="/branches" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300">
                        Branches
                    </a>
                    <a href="/porkhub/list" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300">
                        Dishes
                    </a>
                    @auth
                        <a href="/dashboard" class="text-sm font-medium text-red-600 dark:text-red-500 hover:text-red-700 transition-all duration-300">
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
    <main class="pt-24 pb-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Title Section -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">Admin Dashboard</h1>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Manage registered PorkHub users below.</p>
        </div>

        <!-- Tabs Navigation -->
        <nav id="tabs-nav" class="inline-flex space-x-2 rounded-full bg-gray-300 dark:bg-gray-700 p-1 mb-8">
            <a href="#overview" class="px-5 py-2 rounded-full bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 font-semibold shadow-sm cursor-pointer select-none">
                Overview
            </a>
            <a href="#user-management" class="px-5 py-2 rounded-full text-gray-700 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-900 hover:text-gray-900 dark:hover:text-gray-100 font-semibold cursor-pointer select-none">
                User Management
            </a>
            <a href="#reviews" class="px-5 py-2 rounded-full text-gray-700 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-900 hover:text-gray-900 dark:hover:text-gray-100 font-semibold cursor-pointer select-none">
                Reviews
            </a>
            <a href="#purchase-history" class="px-5 py-2 rounded-full text-gray-700 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-900 hover:text-gray-900 dark:hover:text-gray-100 font-semibold cursor-pointer select-none">
                Purchase History
            </a>
        </nav>

        <!-- Tab Contents -->
        <section id="overview" class="tab-content">
            <div class="bg-white dark:bg-gray-800/80 rounded-2xl border border-gray-200/60 dark:border-gray-700/70 p-6 shadow-xl">
                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Overview</h2>
                <p class="text-gray-600 dark:text-gray-300">Welcome to the PorkHub admin dashboard overview! Here you can see quick stats and summaries.</p>
                <!-- You can add summary cards or stats here later -->
            </div>
        </section>

        <section id="user-management" class="tab-content hidden">
            <!-- Users Table -->
            <section class="bg-white dark:bg-gray-800/80 shadow-xl rounded-2xl border border-gray-200/60 dark:border-gray-700/70 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-900/50">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">Registered</th>
                                <th class="px-4 py-3 text-right font-semibold text-xs text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800 bg-white dark:bg-gray-800">
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50/70 dark:hover:bg-gray-700/60 transition-colors">
                                    <td class="px-4 py-3 text-gray-700 dark:text-gray-200">{{ $user->id }}</td>
                                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100 font-semibold">{{ $user->name }}</td>
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $user->email }}</td>
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $user->created_at->format('M d, Y H:i A') }}</td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="inline-flex gap-2">
                                            <a href="{{ url('/users/edit/' . $user->id) }}" class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold bg-blue-500 hover:bg-blue-600 text-white shadow-sm hover:shadow-md transition">
                                                Edit
                                            </a>
                                            <form action="{{ url('/users/delete/' . $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold bg-rose-500 hover:bg-rose-600 text-white shadow-sm hover:shadow-md transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                        No users registered.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </section>

        <section id="reviews" class="tab-content hidden">
            <div class="bg-white dark:bg-gray-800/80 rounded-2xl border border-gray-200/60 dark:border-gray-700/70 p-6 shadow-xl">
                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Reviews</h2>
                <p class="text-gray-600 dark:text-gray-300">Reviews section coming soon.</p>
            </div>
        </section>

        <section id="purchase-history" class="tab-content hidden">
            <div class="bg-white dark:bg-gray-800/80 rounded-2xl border border-gray-200/60 dark:border-gray-700/70 p-6 shadow-xl">
                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Purchase History</h2>
                <p class="text-gray-600 dark:text-gray-300">Purchase History section coming soon.</p>
            </div>
        </section>

    </main>

    <script>
        const tabs = document.querySelectorAll('#tabs-nav a');  // only tabs
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
        tab.addEventListener('click', e => {
            e.preventDefault();

            tabs.forEach(t => {
            t.classList.remove('bg-white', 'dark:bg-gray-900', 'text-gray-900', 'dark:text-gray-100');
            t.classList.add('text-gray-700', 'dark:text-gray-300');
            });

            contents.forEach(c => c.classList.add('hidden'));

            tab.classList.add('bg-white', 'dark:bg-gray-900', 'text-gray-900', 'dark:text-gray-100');
            tab.classList.remove('text-gray-700', 'dark:text-gray-300');

            const id = tab.getAttribute('href').substring(1);
            document.getElementById(id).classList.remove('hidden');
        });
        });

    </script>

</body>
</html>
