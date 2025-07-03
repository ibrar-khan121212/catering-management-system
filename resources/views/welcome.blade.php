@extends('layout')

@section('content')
<div class="min-h-screen min-w-screen flex flex-col items-center justify-between bg-gradient-to-br from-white to-gray-100 dark:from-gray-900 dark:to-black p-6 transition-colors">
    
    {{-- Header --}}
    <header class="w-full flex justify-between items-center max-w-6xl mx-auto py-4">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white tracking-tight">🍽️ Catering Management</h2>
        <nav class="space-x-4 flex items-center">
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 text-sm rounded bg-blue-600 text-white hover:bg-blue-700 transition shadow">
                        Admin Dashboard
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                            class="px-4 py-2 text-sm rounded bg-red-600 text-white hover:bg-red-700 transition shadow">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="px-4 py-2 text-sm rounded border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 shadow transition">
                    Log in
                </a>
                <a href="{{ route('register') }}"
                   class="px-4 py-2 text-sm rounded border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 shadow transition">
                    Register
                </a>
            @endauth
            <button
                id="darkModeToggle"
                class="ml-4 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded shadow font-semibold transition"
                onclick="
                    if(document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                    }
                "
            >
                Toggle Dark Mode
            </button>
        </nav>
    </header>

    {{-- Main Section --}}
    <main class="text-center flex flex-col items-center justify-center flex-1 px-4 w-full">
        <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 dark:text-white mb-6 tracking-tight">
            Welcome to <span class="text-yellow-400">Our Catering Service</span>
        </h1>
        <p class="text-lg text-gray-600 dark:text-gray-300 mb-8 max-w-2xl">
            We provide top-notch catering and event management to make your moments unforgettable. Enjoy seamless order management, event planning, and more.
        </p>
        <div class="flex flex-col md:flex-row gap-4 justify-center mb-8">
            <a href="{{ route('client.orders.create') }}"
               class="px-8 py-3 bg-green-600 text-white rounded-lg text-lg hover:bg-green-700 transition shadow">
                Place Your Order
            </a>
            <a href="{{ route('client.menu') }}"
               class="px-8 py-3 bg-purple-600 text-white rounded-lg text-lg hover:bg-purple-700 transition shadow">
                View Menu
            </a>
        </div>

        {{-- Client Options (only after login, not admin) --}}
        @auth
            @unless(auth()->user()->is_admin)
                <div class="bg-white/90 dark:bg-gray-800/90 rounded-xl shadow-lg p-6 mt-6 w-full max-w-xl mx-auto flex flex-col gap-4">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Client Options</h2>
                    <div class="flex flex-col md:flex-row gap-4">
                        <a href="{{ route('client.orders.create') }}"
                           class="flex-1 px-6 py-3 bg-green-500 text-white rounded-lg text-lg hover:bg-green-600 transition shadow text-center">
                            Place New Order
                        </a>
                        <a href="{{ route('orders.my') }}"
                           class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg text-lg hover:bg-blue-700 transition shadow text-center">
                            My Orders
                        </a>
                        <a href="{{ route('profile.edit') }}"
                           class="flex-1 px-6 py-3 bg-gray-500 text-white rounded-lg text-lg hover:bg-gray-600 transition shadow text-center">
                            Profile
                        </a>
                    </div>
                </div>
            @endunless
        @endauth
    </main>

    {{-- Footer --}}
    <footer class="mt-10 text-sm text-gray-500 dark:text-gray-400 w-full text-center">
        &copy; {{ date('Y') }} Catering Management System. All rights reserved.
    </footer>
</div>

<script>
    // On page load, set theme from localStorage
    if(localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
    }
</script>
@endsection
