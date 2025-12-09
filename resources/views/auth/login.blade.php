<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Porkhub</title>
    <link rel="icon" href="{{ asset('images/logo-removebg-preview.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
        }
        
        .glass-effect {
            background: rgba(31, 41, 55, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(75, 85, 99, 0.3);
        }
        
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .glow-effect {
            box-shadow: 0 0 30px rgba(220, 38, 38, 0.3);
        }
        
        .dark .glow-effect {
            box-shadow: 0 0 40px rgba(220, 38, 38, 0.4);
        }
        
        .input-glow:focus {
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }
        
        .pattern-bg {
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(220, 38, 38, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(220, 38, 38, 0.05) 0%, transparent 50%);
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased font-sans overflow-x-hidden pattern-bg">
    
    <!-- Decorative Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-red-500/10 rounded-full blur-3xl floating-animation"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-red-600/10 rounded-full blur-3xl floating-animation" style="animation-delay: 2s;"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-6xl w-full grid lg:grid-cols-2 gap-8 items-center">
            
            <!-- Left Side - Branding -->
            <div class="hidden lg:flex flex-col justify-center space-y-8 px-8">
                <div class="space-y-6">
                    <div class="flex items-center gap-4 group">
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-xl glow-effect transform group-hover:scale-110 transition-all duration-300">
                            <img src="{{ asset('images/logo-removebg-preview.png') }}" 
                                 class="w-16 h-20" 
                                 alt="Porkhub Logo">
                        </div>
                        <span class="text-red-600 dark:text-red-500 text-6xl font-bold" 
                              style="font-family: 'Dancing Script', cursive;">
                            Porkhub
                        </span>
                    </div>
                    
                    <h1 class="text-5xl font-bold text-gray-900 dark:text-gray-100 leading-tight">
                        Welcome Back to <br>
                        <span class="text-red-600 dark:text-red-500">Premium Quality</span>
                    </h1>
                    
                    <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed">
                        Your trusted source for the finest pork products. Log in to explore our menu and place your orders with ease.
                    </p>
                    
                    <div class="flex gap-4 pt-4">
                        <div class="flex items-center gap-3 bg-white/50 dark:bg-gray-800/50 px-6 py-3 rounded-xl backdrop-blur-sm">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-semibold text-gray-900 dark:text-gray-100">Fresh Quality</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white/50 dark:bg-gray-800/50 px-6 py-3 rounded-xl backdrop-blur-sm">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span class="font-semibold text-gray-900 dark:text-gray-100">Fast Delivery</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="w-full max-w-md mx-auto space-y-8">
                
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-3 group mb-6">
                        <img src="{{ asset('images/logo-removebg-preview.png') }}" 
                             class="w-12 h-14 transform group-hover:scale-110 transition-transform duration-300" 
                             alt="Porkhub Logo">
                        <span class="text-red-600 dark:text-red-500 text-4xl font-semibold group-hover:text-red-700 transition-colors duration-300" 
                              style="font-family: 'Dancing Script', cursive;">
                            Porkhub
                        </span>
                    </a>
                </div>

                <!-- Session Status Message -->
                @if (session('status'))
                <div class="rounded-xl bg-emerald-50 dark:bg-emerald-900/20 p-4 border-l-4 border-emerald-500 shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-semibold text-emerald-800 dark:text-emerald-200">{{ session('status') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Login Card -->
                <div class="glass-effect py-10 px-8 shadow-2xl rounded-3xl glow-effect sm:px-12 transform hover:scale-[1.02] transition-all duration-300">
                    <div class="mb-8 text-center lg:text-left">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                            Sign In
                        </h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Enter your credentials to access your account
                        </p>
                    </div>

                    <form class="space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <!-- Email Address -->
                        <div class="group">
                            <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Email Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-red-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                                <input id="email" 
                                       name="email" 
                                       type="email" 
                                       autocomplete="username" 
                                       required 
                                       autofocus
                                       value="{{ old('email') }}"
                                       placeholder="you@example.com"
                                       class="input-glow appearance-none block w-full pl-12 pr-4 py-3.5 border-2 border-gray-700 rounded-xl shadow-sm placeholder-gray-500 bg-gray-900 text-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300 text-sm font-medium">
                            </div>
                            @error('email')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="group">
                            <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-red-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input id="password" 
                                       name="password" 
                                       type="password" 
                                       autocomplete="current-password" 
                                       required
                                       placeholder="••••••••"
                                       class="input-glow appearance-none block w-full pl-12 pr-4 py-3.5 border-2 border-gray-700 rounded-xl shadow-sm placeholder-gray-500 bg-gray-900 text-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300 text-sm font-medium">
                            </div>
                            @error('password')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" 
                                       name="remember" 
                                       type="checkbox"
                                       class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 dark:border-gray-700 rounded transition-colors duration-300 cursor-pointer">
                                <label for="remember_me" class="ml-2 block text-sm text-gray-700 dark:text-gray-300 font-medium cursor-pointer">
                                    Remember me
                                </label>
                            </div>
                            
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" 
                               class="text-sm font-semibold text-red-600 dark:text-red-500 hover:text-red-700 dark:hover:text-red-400 transition-all duration-300 relative group">
                                Forgot password?
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-600 group-hover:w-full transition-all duration-300"></span>
                            </a>
                            @endif
                        </div>

                        <!-- Login Button -->
                        <div>
                            <button type="submit" 
                                    class="group relative w-full flex justify-center items-center py-4 px-4 border border-transparent shadow-lg text-base font-bold rounded-xl text-white gradient-bg hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 transform hover:scale-105 hover:-translate-y-1">
                                <span class="absolute left-0 inset-y-0 flex items-center pl-4">
                                    <svg class="h-5 w-5 text-red-300 group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                                Sign In to Your Account
                            </button>
                        </div>

                        <!-- Divider -->
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300 dark:border-gray-700"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-gray-800 text-gray-400 font-medium">
                                    New to Porkhub?
                                </span>
                            </div>
                        </div>

                        <!-- Register Link -->
                        <div>
                            <a href="{{ route('register') }}" 
                               class="group w-full flex justify-center items-center py-4 px-4 border-2 border-red-600 dark:border-red-500 shadow-sm text-base font-bold rounded-xl text-red-600 dark:text-red-500 bg-transparent hover:bg-red-600 hover:text-white dark:hover:bg-red-500 focus:outline-none focus:ring-4 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                Create New Account
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Footer Text -->
                <p class="text-center text-sm text-gray-500 dark:text-gray-400">
                    Protected by industry-standard encryption
                    <svg class="w-4 h-4 inline-block ml-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </p>
            </div>
        </div>
    </div>
</body>
</html>