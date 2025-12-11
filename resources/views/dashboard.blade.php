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
                    <a href="{{ route('branches.list') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300">
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
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users Card -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 rounded-2xl p-6 shadow-lg text-white">
                <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Users</p>
                    <p class="text-3xl font-bold mt-2">{{ $users->count() }}</p>
                </div>
                <div class="text-5xl opacity-20">👥</div>
                </div>
            </div>

            <!-- Total Orders Card -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 dark:from-green-600 dark:to-green-700 rounded-2xl p-6 shadow-lg text-white">
                <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Total Orders</p>
                    <p class="text-3xl font-bold mt-2">{{ $orders->count() }}</p>
                </div>
                <div class="text-5xl opacity-20">📦</div>
                </div>
            </div>

            <!-- Total Reviews Card -->
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 dark:from-yellow-600 dark:to-yellow-700 rounded-2xl p-6 shadow-lg text-white">
                <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-sm font-medium">Total Reviews</p>
                    <p class="text-3xl font-bold mt-2">{{ $reviews->count() }}</p>
                </div>
                <div class="text-5xl opacity-20">⭐</div>
                </div>
            </div>

            <!-- Revenue Card -->
            <div class="bg-gradient-to-br from-red-500 to-red-600 dark:from-red-600 dark:to-red-700 rounded-2xl p-6 shadow-lg text-white">
                <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-sm font-medium">Total Revenue</p>
                    <p class="text-3xl font-bold mt-2">₱{{ number_format($orders->sum('total_amount'), 2) }}</p>
                </div>
                <div class="text-5xl opacity-20">💰</div>
                </div>
            </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Orders -->
            <div class="bg-white dark:bg-gray-800/80 rounded-2xl border border-gray-200/60 dark:border-gray-700/70 p-6 shadow-xl">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Recent Orders</h3>
                <div class="space-y-3">
                @forelse ($orders->take(5) as $order)
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-gray-100">Order #{{ $order->id }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->user->name }}</p>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                        @if($order->status == 'pending') bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200
                        @elseif($order->status == 'shipping') bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200
                        @elseif($order->status == 'delivered') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                        @else bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                    </div>
                @empty
                    <p class="text-gray-600 dark:text-gray-400 text-center py-4">No recent orders</p>
                @endforelse
                </div>
            </div>

            <!-- Recent Reviews -->
            <div class="bg-white dark:bg-gray-800/80 rounded-2xl border border-gray-200/60 dark:border-gray-700/70 p-6 shadow-xl">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Recent Reviews</h3>
                <div class="space-y-3">
                @forelse ($reviews->take(5) as $review)
                    <div class="p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <div class="flex items-center justify-between mb-2">
                        <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $review->user->name }}</p>
                        <span class="text-yellow-500">⭐ {{ $review->rating }}/5</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ $review->comment }}</p>
                    </div>
                @empty
                    <p class="text-gray-600 dark:text-gray-400 text-center py-4">No recent reviews</p>
                @endforelse
                </div>
            </div>
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

            @if($reviews->isEmpty())
                <p class="text-gray-600 dark:text-gray-300">No reviews yet.</p>
            @else
                <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">Rating</th>
                        <th class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">Comment</th>
                        <th class="px-4 py-3 text-right font-semibold text-xs text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800 bg-white dark:bg-gray-800">
                    @foreach($reviews as $review)
                        <tr class="hover:bg-gray-50/70 dark:hover:bg-gray-700/60 transition-colors">
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100 font-semibold">{{ $review->user->name }}</td>
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-200">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200">
                            ⭐ {{ $review->rating }}/5
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300 max-w-sm truncate">{{ $review->comment }}</td>
                        <td class="px-4 py-3 text-right">
                            <form action="{{ route('admin.reviews.delete', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold bg-rose-500 hover:bg-rose-600 text-white shadow-sm hover:shadow-md transition">
                                Delete
                            </button>
                            </form>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            @endif
            </div>
        </section>

        <section id="purchase-history" class="tab-content hidden">
            <div class="bg-white dark:bg-gray-800/80 rounded-2xl border border-gray-200/60 dark:border-gray-700/70 p-6 shadow-xl">
                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Purchase History</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-900/50">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">Order ID</th>
                                <th class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">Branch</th>
                                <th class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">Items</th>
                                <th class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">User Address</th>
                                <th class="px-4 py-3 text-left font-semibold text-xs text-gray-500 uppercase tracking-wider">Placed At</th>
                                <th class="px-4 py-3 text-right font-semibold text-xs text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800 bg-white dark:bg-gray-800">
                            @forelse ($orders as $order)
                                <tr class="hover:bg-gray-50/70 dark:hover:bg-gray-700/60 transition-colors">
                                    <td class="px-4 py-3 text-gray-700 dark:text-gray-200">{{ $order->id }}</td>
                                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100 font-semibold">{{ $order->user->name }}</td>
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $order->restaurantBranch->name ?? '-' }}</td>
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                        <ul class="list-disc pl-4">
                                            @foreach ($order->items as $item)
                                                <li>{{ $item->dish->product_name }} (x{{ $item->quantity }})</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="px-4 py-3 text-gray-700 dark:text-gray-200">₱{{ number_format($order->total_amount, 2) }}</td>
                                    <td class="px-4 py-3">
                                        @php
                                            $status = $order->status;
                                            $disabled = in_array($status, ['delivered', 'cancelled']);
                                        @endphp
                                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex flex-col gap-2">
                                            @csrf
                                            <select name="status" 
                                                {{ $disabled ? 'disabled' : '' }} 
                                                class="border border-gray-300 dark:border-gray-600 rounded-md text-sm p-2 bg-white dark:bg-gray-700 dark:text-gray-100 w-full">
                                                @if($status == 'pending')
                                                    <option value="pending" selected>Pending</option>
                                                    <option value="shipping">Out-for-Delivery</option>
                                                    <option value="cancelled">Cancelled</option>
                                                @elseif($status == 'shipping')
                                                    <option value="shipping" selected>Out-for-Delivery</option>
                                                    <option value="delivered">Delivered</option>
                                                    <option value="cancelled">Cancelled</option>
                                                @elseif($status == 'delivered')
                                                    <option value="delivered" selected>Delivered</option>
                                                @elseif($status == 'cancelled')
                                                    <option value="cancelled" selected>Cancelled</option>
                                                @endif
                                            </select>
                                            @if(!$disabled)
                                                <button type="submit" class="px-3 py-1 bg-blue-500 text-white text-xs font-medium rounded hover:bg-blue-600 transition">
                                                    Update
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100 font-semibold">{{ $order->user_address }}</td>
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $order->created_at->format('M d, Y H:i A') }}</td>
                                    <td class="px-4 py-3 text-right">
                                        <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 bg-rose-500 text-white text-xs rounded hover:bg-rose-600 transition">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                        No orders placed yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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
