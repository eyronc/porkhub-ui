<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Branch</title>
    <link rel="icon" href="{{ asset('images/logo-removebg-preview.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased font-sans">

    <div class="max-w-lg mx-auto mt-24 p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6 text-center">Update Branch</h1>

        @if (session('success'))
            <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-800 px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('branches.update', $branch->id) }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Branch Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $branch->name) }}" 
                    class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                @error('name')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Branch Address</label>
                <textarea name="address" id="address" rows="3"
                    class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">{{ old('address', $branch->address) }}</textarea>
                @error('address')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:shadow-xl transition">Update Branch</button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('branches.list') }}" class="text-red-600 hover:text-red-700 text-sm">← Back to Branch List</a>
        </div>
    </div>

</body>
</html>
