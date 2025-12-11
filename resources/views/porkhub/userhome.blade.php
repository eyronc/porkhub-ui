<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Porkhub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel = "icon" href = "{{ asset('images/logo-removebg-preview.png') }}" type = "image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

</head>
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
                        <a href="\porkhub\home" class="text-sm font-medium text-red-600 dark:text-red-500 hover:text-red-700 transition-all duration-300 pb-1 pt-1">
                            Home
                        </a>
                        <a href="\porkhub\order" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full pb-1 pt-1">
                            Products
                        </a>
                        <a href="{{ route('cart.show') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full pb-1 pt-1">
                            My Cart
                        </a>
                        @auth
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
    <main class="relative min-h-screen flex items-center justify-center overflow-hidden pt-16">

        <!-- Animated Background Slider (crossfades every 5s) -->
        <div id="hero-bg" class="absolute inset-0 overflow-hidden">
            <!-- Slides will be injected by JS -->
            <style>
                .hero-slide {
                    position: absolute;
                    inset: 0;
                    background-position: center;
                    background-size: cover;
                    background-repeat: no-repeat;
                    opacity: 0;
                    transition: opacity 1s ease-in-out;
                }
                .hero-slide.active { opacity: 1; }
            </style>
        </div>

        <!-- Gradient Overlays for depth -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-br from-black/70 via-red-900/50 to-black/80"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
        </div>

        <!-- Animated Floating Elements -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 left-10 w-32 h-32 bg-red-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-40 h-40 bg-orange-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/4 w-24 h-24 bg-yellow-500/10 rounded-full blur-2xl animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <!-- Content Container -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                
                <!-- Left Column - Text Content -->
                <div class="text-white space-y-6 animate-fade-in">
                    <div class="inline-block px-4 py-2 bg-red-600/80 backdrop-blur-sm rounded-full text-sm font-semibold mb-4 transform hover:scale-105 transition-transform duration-300">
                        🥩 Premium Quality Since 1969
                    </div>
                    
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold leading-tight transform hover:scale-105 transition-transform duration-500" style="font-family: 'Dancing Script', cursive;">
                        <span class="text-red-500 drop-shadow-lg">Premium Pork</span>
                        <br />
                        <span class="text-white drop-shadow-lg">Recipes & Cuts</span>
                    </h1>
                    
                    <p class="text-lg sm:text-xl text-gray-200 leading-relaxed max-w-xl backdrop-blur-sm bg-black/20 p-4 rounded-lg">
                        Discover a world of culinary excellence at 
                        <span class="text-red-400 font-semibold">Porkhub</span> — 
                        your ultimate destination for expertly crafted pork dishes, cooking tips, and chef-curated inspirations.
                    </p>
                    
                    <div class="flex flex-wrap gap-4 pt-4">
                        <a href="\porkhub\list" 
                            class="bg-red-600 hover:bg-red-700 text-white font-semibold px-8 py-4 rounded-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-110 hover:-translate-y-1 flex items-center gap-2">
                            <span>Explore Products</span>
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="{{ url('/') }}" 
                            class="bg-transparent border-2 border-white hover:bg-white hover:text-gray-900 text-white font-semibold px-8 py-4 rounded-lg shadow-xl transition-all duration-300 transform hover:scale-110 hover:-translate-y-1">
                            Learn More
                        </a>
                    </div>
                    
                    <!-- Stats Section -->
                    <div class="grid grid-cols-3 gap-6 pt-8 border-t border-gray-600/50">
                        <div class="transform hover:scale-110 transition-all duration-300 cursor-pointer text-left">
                            <div class="text-3xl font-bold text-red-500">500+</div>
                            <div class="text-sm text-gray-300 mt-1">Recipes</div>
                        </div>
                        <div class="transform hover:scale-110 transition-all duration-300 cursor-pointer text-left">
                            <div class="text-3xl font-bold text-red-500">10K+</div>
                            <div class="text-sm text-gray-300 mt-1">Customers</div>
                        </div>
                        <div class="transform hover:scale-110 transition-all duration-300 cursor-pointer text-left">
                            <div class="text-3xl font-bold text-red-500">4.9★</div>
                            <div class="text-sm text-gray-300 mt-1">Rating</div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Enhanced Feature Cards (aligned content, equal heights) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-stretch">

                    <!-- Card A - Chef Recipes -->
                    <article class="group transform transition-all duration-500 hover:-translate-y-3 hover:scale-[1.02] will-change-transform perspective h-full">
                        <div class="relative bg-gradient-to-b from-white/90 to-white/80 dark:from-gray-800/90 dark:to-gray-800/80 rounded-xl overflow-hidden shadow-2xl border border-gray-200/40 h-full flex flex-col">
                            <div class="relative h-40 sm:h-48 bg-cover bg-center" style="background-image:url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200&q=80');">
                                <div class="absolute inset-0 bg-black/30 mix-blend-multiply"></div>
                                <span class="absolute top-3 left-3 inline-flex items-center gap-2 bg-gradient-to-r from-red-500 to-amber-400 text-white px-3 py-1 rounded-full text-xs font-semibold shadow">Chef Recipes</span>
                            </div>

                            <div class="p-5 flex-1 flex flex-col justify-between text-left">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Expert-curated pork recipes from professional chefs</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">Handpicked techniques, plating tips and flavor pairings to elevate your cooking.</p>

                                    <ul class="grid grid-cols-1 gap-2 text-sm text-gray-600 dark:text-gray-300">
                                        <li class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            Chef-tested recipes
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3 1.343 3 3S13.657 14 12 14s-3-1.343-3-3 1.343-3 3-3z"/></svg>
                                            Step-by-step guides
                                        </li>
                                    </ul>
                                </div>

                                <div class="mt-6 flex items-center justify-between gap-3">
                                    <a href="\porkhub\list" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-semibold transition-transform transform hover:-translate-y-1 shadow">
                                        Browse Recipes
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                                    </a>
                                    <div class="text-sm text-gray-500">Pro tips included</div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Card B - Premium Quality -->
                    <article class="group transform transition-all duration-500 hover:-translate-y-3 hover:scale-[1.02] will-change-transform perspective h-full">
                        <div class="relative bg-gradient-to-b from-white/90 to-white/80 dark:from-gray-800/90 dark:to-gray-800/80 rounded-xl overflow-hidden shadow-2xl border border-gray-200/40 h-full flex flex-col">
                            <div class="relative h-40 sm:h-48 bg-cover bg-center" style="background-image:url('https://images.unsplash.com/photo-1544025162-d76694265947?w=1200&q=80');">
                                <div class="absolute inset-0 bg-black/25 mix-blend-multiply"></div>
                                <span class="absolute top-3 left-3 inline-flex items-center gap-2 bg-rose-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow">Premium Quality</span>
                            </div>

                            <div class="p-5 flex-1 flex flex-col justify-between text-left">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Only the finest cuts and freshest ingredients</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">Sustainably raised, expertly butchered and curated for the best flavor.</p>

                                    <div class="flex flex-wrap gap-3">
                                        <span class="inline-flex items-center gap-2 bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-full text-xs text-gray-700 dark:text-gray-200">
                                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M5 7v10a2 2 0 002 2h10a2 2 0 002-2V7"/></svg>
                                            Farm-to-table
                                        </span>
                                        <span class="inline-flex items-center gap-2 bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-full text-xs text-gray-700 dark:text-gray-200">
                                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v6M5 6h14"/></svg>
                                            Ethically sourced
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-6 flex items-center justify-between gap-4">
                                    <div>
                                        <div class="text-xl font-bold text-rose-600">$—</div>
                                        <div class="text-base text-gray-500 normal-case">premium selection</div>
                                    </div>
                                    <a href="\porkhub\list" class="inline-flex items-center gap-2 border border-rose-600 text-rose-600 hover:bg-rose-600 hover:text-white px-4 py-2 rounded-md text-sm font-semibold transition">
                                        View Cuts
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Card C - Cold-Chain Delivery -->
                    <article class="group transform transition-all duration-500 hover:-translate-y-3 hover:scale-[1.02] will-change-transform perspective h-full">
                        <div class="relative bg-gradient-to-b from-white/90 to-white/80 dark:from-gray-800/90 dark:to-gray-800/80 rounded-xl overflow-hidden shadow-2xl border border-gray-200/40 h-full flex flex-col">
                            <div class="relative h-40 sm:h-48 bg-cover bg-center" style="background-image:url('https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=1200&q=80');">
                                <div class="absolute inset-0 bg-black/25 mix-blend-multiply"></div>
                                <span class="absolute top-3 left-3 inline-flex items-center gap-2 bg-emerald-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow">
                                    Cold-Chain Delivery
                                </span>
                            </div>

                            <div class="p-5 flex-1 flex flex-col justify-between text-left">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                                        Kept chilled from our hub to your kitchen.
                                    </h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                                        We use temperature-controlled transport so every pork cut stays safe, fresh, and ready to cook the moment it arrives.
                                    </p>

                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center bg-gray-100 dark:bg-gray-700 px-3 py-2 rounded-full gap-2">
                                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M5 7v10a2 2 0 002 2h10a2 2 0 002-2V7"/>
                                            </svg>
                                            <span class="text-xs text-gray-700 dark:text-gray-200">Chilled packaging</span>
                                        </div>
                                        <div class="flex items-center bg-gray-100 dark:bg-gray-700 px-3 py-2 rounded-full gap-2">
                                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h2l1 2h13l1-2h2"/>
                                            </svg>
                                            <span class="text-xs text-gray-700 dark:text-gray-200">Live delivery updates</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 flex items-center justify-between gap-4">
                                    <div>
                                        <div class="text-xl font-bold text-rose-600">2</div>
                                        <div class="text-base text-gray-500 normal-case">delivery time windows</div>
                                    </div>
                                    <a href="\porkhub\list" class="inline-flex items-center gap-2 bg-rose-600 hover:bg-rose-700 text-white px-4 py-2 rounded-md text-sm font-semibold transition-transform transform hover:-translate-y-1 shadow">
                                        Schedule Delivery
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>


                    <!-- Card D - Freshness Promise -->
                    <article class="group transform transition-all duration-500 hover:-translate-y-3 hover:scale-[1.02] will-change-transform perspective h-full">
                        <div class="relative bg-gradient-to-b from-white/90 to-white/80 dark:from-gray-800/90 dark:to-gray-800/80 rounded-xl overflow-hidden shadow-2xl border border-gray-200/40 h-full flex flex-col">
                            <div class="relative h-40 sm:h-48 bg-cover bg-center" style="background-image:url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200&q=80');">
                                <div class="absolute inset-0 bg-black/25 mix-blend-multiply"></div>
                                <div class="absolute top-3 left-3 inline-flex items-center gap-2 bg-indigo-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow">
                                    Freshness Promise
                                </div>
                            </div>

                            <div class="p-5 flex-1 flex flex-col justify-between text-left">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                                        Delivered fresh, packed with care, and kept at the right temperature from our hub to your kitchen.
                                    </h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                                        Every cut is handled by trained staff, sealed properly, and shipped quickly so you can cook with confidence every time.
                                    </p>

                                    <div class="flex items-center gap-4 mb-3">
                                        <div class="flex -space-x-3">
                                            <img class="w-10 h-10 rounded-full ring-2 ring-white object-cover" src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=80&q=80" alt="butcher1">
                                            <img class="w-10 h-10 rounded-full ring-2 ring-white object-cover" src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=80&q=80" alt="butcher2">
                                            <img class="w-10 h-10 rounded-full ring-2 ring-white object-cover" src="https://images.unsplash.com/photo-1544723795-3fb6469f5b39?w=80&q=80" alt="butcher3">
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                                                Mark · Lina · Carlo
                                            </div>
                                            <div class="text-xs text-gray-500">QC & cold-chain specialists</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                    <a href="\porkhub\list" class="inline-flex items-center gap-2 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 bg-transparent hover:bg-gray-100 px-4 py-2 rounded-md text-sm font-semibold transition">
                                        View Cut Selection
                                    </a>
                                    <div class="text-sm text-gray-500">
                                        Chilled delivery · Temperature checked
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>


                </div>

            </div>
        </div>

        <!-- Decorative Bottom Wave -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#111827" fill-opacity="0.9"/>
            </svg>
        </div>

        <!-- Background slider script (crossfade slides every 5s) -->
        <script>
            (function() {
                const slideUrls = [
                    // online images (Unsplash) - imported directly
                    'https://images.unsplash.com/photo-1529692236671-f1f6cf9683ba?w=1920&q=80',
                    'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=1920&q=80',
                    'https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d?w=1920&q=80'
                ];
                const container = document.getElementById('hero-bg');

                // create slide elements
                const slides = slideUrls.map((url, i) => {
                    const div = document.createElement('div');
                    div.className = 'hero-slide';
                    if (i === 0) div.classList.add('active');
                    div.style.backgroundImage = 'url("' + url + '")';
                    container.appendChild(div);
                    return div;
                });

                let idx = 0;
                setInterval(() => {
                    const next = (idx + 1) % slides.length;
                    slides[idx].classList.remove('active');
                    slides[next].classList.add('active');
                    idx = next;
                }, 5000);
            })();
        </script>
    </main>
    
    @if($reviews->isNotEmpty())
        <section class="py-16 bg-gray-900 relative overflow-hidden">
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0" style="background-image: url('https://images.unsplash.com/photo-1607623814075-e51df1bdc82f?w=400&q=80'); background-size: cover; background-position: center;"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-white mb-2" style="font-family: 'Dancing Script', cursive;">
                        Customer Reviews
                    </h2>
                    <p class="text-gray-400">See what our customers are saying</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($reviews as $review)
                    <article class="bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-2xl border border-gray-700/70 p-6 transform hover:scale-105 hover:-translate-y-2 transition-all duration-300">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 bg-red-600/20 rounded-full flex items-center justify-center ring-2 ring-red-500/30">
                                <span class="text-red-500 font-bold text-lg">
                                    {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                </span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white">{{ $review->user->name }}</h3>
                                <p class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-1 mb-3">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-gray-600 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                @endif
                            @endfor
                            <span class="ml-2 text-sm font-semibold text-gray-300">{{ $review->rating }}/5</span>
                        </div>

                        <p class="text-gray-300 text-sm leading-relaxed italic">
                            "{{ $review->comment }}"
                        </p>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12 border-t border-gray-800 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('https://images.unsplash.com/photo-1607623814075-e51df1bdc82f?w=400&q=80'); background-size: cover; background-position: center;"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center space-y-4">
                <p class="text-2xl text-red-500 font-bold transform hover:scale-110 transition-transform duration-300 inline-block cursor-pointer" style="font-family: 'Dancing Script', cursive;">Porkhub</p>
                <p class="text-sm text-gray-500">&copy; 2024 Porkhub. All rights reserved.</p>
                <div class="flex justify-center space-x-6 pt-4">
                    <a href="#" class="text-gray-500 hover:text-red-500 transition-all duration-300 transform hover:scale-125 hover:-translate-y-1">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-red-500 transition-all duration-300 transform hover:scale-125 hover:-translate-y-1">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-red-500 transition-all duration-300 transform hover:scale-125 hover:-translate-y-1">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fade-in 1s ease-out;
        }

        /* tiny perspective helper for subtle 3D tilt */
        .perspective { perspective: 1200px; }
    </style>
</body>
</html>