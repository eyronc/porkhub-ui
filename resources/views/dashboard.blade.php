<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased font-sans overflow-x-hidden">
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
                        <a href="\porkhub\list" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full pb-1 pt-1">
                            Products
                        </a>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-red-600 dark:text-red-500 hover:text-red-700 transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full pb-1 pt-1">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline-block">
                                @csrf
                                <button type="submit" class="mt-4 bg-red-600 text-white text-sm font-semibold px-5 py-2 rounded-lg hover:bg-red-700 transition-all duration-300 shadow-md hover:shadow-xl transform hover:scale-105">
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

    <main class="pt-24 pb-10 px-4 max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-center text-red-600 dark:text-red-400" style="font-family: 'Dancing Script', cursive;">
            Admin Dashboard
        </h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            <!-- Orders Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 flex flex-col items-center justify-center transition hover:scale-105 hover:shadow-xl duration-300">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                    <span class="text-xl font-semibold">Orders</span>
                </div>
                <span class="text-4xl font-bold text-red-600 dark:text-red-400" id="ordersCount">5</span>
                <span class="text-sm text-gray-500 dark:text-gray-400 mt-2">Completed Today</span>
            </div>
            <!-- Pending Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 flex flex-col items-center justify-center transition hover:scale-105 hover:shadow-xl duration-300">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 8v4l3 3" />
                    </svg>
                    <span class="text-xl font-semibold">Pending</span>
                </div>
                <span class="text-4xl font-bold text-yellow-500" id="pendingCount">10</span>
                <span class="text-sm text-gray-500 dark:text-gray-400 mt-2">Awaiting Action</span>
            </div>
            <!-- Active Users Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 flex flex-col items-center justify-center transition hover:scale-105 hover:shadow-xl duration-300">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="7" r="4" />
                        <path d="M5.5 21a7.5 7.5 0 0 1 13 0" />
                    </svg>
                    <span class="text-xl font-semibold">Active Users</span>
                </div>
                <span class="text-4xl font-bold text-green-500" id="activeUsersCount">23</span>
                <span class="text-sm text-gray-500 dark:text-gray-400 mt-2">Online Now</span>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">Recent Activity</h2>
            <ul id="activityFeed" class="space-y-4">
                <li class="flex items-center gap-4">
                    <span class="inline-block w-2 h-2 rounded-full bg-green-500"></span>
                    <span class="text-gray-700 dark:text-gray-300">User <b>Jane Doe</b> placed an order.</span>
                    <span class="ml-auto text-xs text-gray-400">2 min ago</span>
                </li>
                <li class="flex items-center gap-4">
                    <span class="inline-block w-2 h-2 rounded-full bg-yellow-500"></span>
                    <span class="text-gray-700 dark:text-gray-300">Order #1023 is pending approval.</span>
                    <span class="ml-auto text-xs text-gray-400">5 min ago</span>
                </li>
                <li class="flex items-center gap-4">
                    <span class="inline-block w-2 h-2 rounded-full bg-red-500"></span>
                    <span class="text-gray-700 dark:text-gray-300">User <b>John Smith</b> cancelled an order.</span>
                    <span class="ml-auto text-xs text-gray-400">10 min ago</span>
                </li>
            </ul>
        </div>
    </main>

    <script>
        // Example: Simulate real-time analytics with polling (replace with actual API calls)
        function fetchDashboardStats() {
            // Simulate fetching data
            document.getElementById('ordersCount').textContent = Math.floor(Math.random() * 10) + 5;
            document.getElementById('pendingCount').textContent = Math.floor(Math.random() * 15) + 5;
            document.getElementById('activeUsersCount').textContent = Math.floor(Math.random() * 30) + 10;
            // Simulate activity feed update
            // In production, replace with AJAX call to backend
        }
        setInterval(fetchDashboardStats, 5000);
    </script>
</body>