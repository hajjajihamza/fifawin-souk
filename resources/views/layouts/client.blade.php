<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans leading-normal tracking-normal">

<!-- Navigation -->
<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <span class="text-2xl font-bold text-indigo-600 tracking-tight">FIFAWIN SOUK</span>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('logout') }}" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-150 ease-in-out">Logout</a>
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-150 ease-in-out">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-150 ease-in-out">Login</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @yield('content')
</main>

<footer class="bg-white border-t border-gray-100 py-12 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-400 text-sm">
        &copy; {{ date('Y') }} FIFAWIN SOUK. All rights reserved.
    </div>
</footer>
</body>
</html>
