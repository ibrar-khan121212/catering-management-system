@extends('layout')

@section('content')
<div 
class="min-h-screen min-w-screen pr-5 gradient-bg text-black dark:text-white  overflow-hidden bg-white dark:bg-gray-900 transition-colors w-full"
>
    <style>
        .glass {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.08);
        }
        .stat-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        .dark .glass {
            background: rgba(30, 41, 59, 0.5);
        }
    </style>

    <!-- Dark Mode Toggle & Home Button -->
    <div class="flex justify-between items-center w-full pt-8 px-4">
        <a href="{{ route('home') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition font-semibold">
            ← Home
        </a>
        <button id="darkModeToggle" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded shadow transition font-semibold">
            Toggle Dark Mode
        </button>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div id="alert-success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 w-full mx-auto mt-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div id="alert-error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 w-full mx-auto mt-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Decorative Blobs -->
    <div class="absolute top-[-100px] left-[-100px] w-[300px] h-[300px] rounded-full bg-white opacity-5 blur-3xl"></div>
    <div class="absolute bottom-[-100px] right-[-100px] w-[300px] h-[300px] rounded-full bg-white opacity-5 blur-3xl"></div>

    <!-- Header -->
    <div class="text-center py-16 px-4 w-full">
        <h1 class="text-5xl md:text-6xl font-extrabold text-black dark:text-white leading-tight mb-4">
            Catering <span class="text-yellow-300">Management</span>
        </h1>
        <p class="text-xl text-white/80 w-full mx-auto">
            Streamline your catering business operations with ease and elegance.
        </p>
    </div>

    <!-- Dashboard Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4 pb-20 w-full">
        @php
            $cards = [
                ['route' => 'customers.index', 'color' => 'from-blue-400 to-blue-600', 'label' => 'Customers', 'desc' => 'Manage client profiles', 'icon' => '👥', 'count' => $stats['customers'] ?? 0],
                ['route' => 'events.index', 'color' => 'from-green-400 to-green-600', 'label' => 'Events', 'desc' => 'Plan & schedule events', 'icon' => '📅', 'count' => $stats['events'] ?? 0],
                ['route' => 'orders.index', 'color' => 'from-yellow-400 to-orange-500', 'label' => 'Orders', 'desc' => 'Track order status', 'icon' => '📦', 'count' => $stats['orders'] ?? 0],
                ['route' => 'payments.index', 'color' => 'from-emerald-400 to-emerald-600', 'label' => 'Payments', 'desc' => 'Manage payments', 'icon' => '💰', 'count' => $stats['payments'] ?? 0],
                ['route' => 'menu_items.index', 'color' => 'from-purple-400 to-purple-600', 'label' => 'Menu Items', 'desc' => 'Manage your menu', 'icon' => '🍽️', 'count' => $stats['menu_items'] ?? 0],
                ['route' => 'inventory_items.index', 'color' => 'from-indigo-400 to-indigo-600', 'label' => 'Inventory', 'desc' => 'Stock control', 'icon' => '📦', 'count' => $stats['inventory_items'] ?? 0],
                ['route' => 'employees.index', 'color' => 'from-teal-400 to-teal-600', 'label' => 'Employees', 'desc' => 'Manage staff', 'icon' => '🧑‍💼', 'count' => $stats['employees'] ?? 0],
                ['route' => 'chefs.index', 'color' => 'from-red-400 to-red-600', 'label' => 'Chefs', 'desc' => 'Kitchen management', 'icon' => '👨‍🍳', 'count' => $stats['chefs'] ?? 0],
                ['route' => 'servers.index', 'color' => 'from-cyan-400 to-cyan-600', 'label' => 'Servers', 'desc' => 'Service team', 'icon' => '🧑‍🍽️','count' => $stats['chefs'] ?? 0],
                ['route' => 'event_managers.index', 'color' => 'from-amber-400 to-amber-600', 'label' => 'Event Managers', 'desc' => 'Coordination staff', 'icon' => '🎤','count' => $stats['chefs'] ?? 0],
             ];
        @endphp

        @foreach($cards as $card)
            @if(isset($card['more']) && $card['more'])
                <div class="glass rounded-xl p-5 text-center shadow-lg opacity-80 cursor-not-allowed flex flex-col items-center justify-center">
                    <div class="w-14 h-14 mx-auto flex items-center justify-center bg-gradient-to-br {{ $card['color'] }} rounded-full text-2xl">
                        {{ $card['icon'] }}
                    </div>
                    <h2 class="mt-4 font-bold text-lg">{{ $card['label'] }}</h2>
                    <p class="text-sm text-white/70">{{ $card['desc'] }}</p>
                </div>
            @else
                <a href="{{ route($card['route']) }}" class="glass rounded-xl p-5 text-center shadow-lg hover:scale-105 transform transition flex flex-col items-center justify-center">
                    <div class="w-14 h-14 mx-auto flex items-center justify-center bg-gradient-to-br {{ $card['color'] }} rounded-full text-2xl">
                        {{ $card['icon'] }}
                    </div>
                    <h2 class="mt-4 font-bold text-lg">{{ $card['label'] }}</h2>
                    <div class="text-3xl font-extrabold text-black dark:text-white mt-2">{{ $card['count'] }}</div>
                    <p class="text-sm text-white/70">{{ $card['desc'] }}</p>
                </a>
            @endif
        @endforeach
    </div>

    <!-- Stats Section -->
    <div class="bg-white/5 dark:bg-gray-800/60 py-10 px-4 mt-8 w-full">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center w-full">
            <div class="glass p-6 rounded-xl flex flex-col items-center">
                <span class="stat-icon">👥</span>
                <div class="text-3xl font-bold">{{ $stats['customers'] ?? 0 }}</div>
                <div class="text-black/70 dark:text-gray-300 text-sm">Active Customers</div>
            </div>
            <div class="glass p-6 rounded-xl flex flex-col items-center">
                <span class="stat-icon">📅</span>
                <div class="text-3xl font-bold">{{ $stats['events'] ?? 0 }}</div>
                <div class="text-black/70 dark:text-gray-300 text-sm">Events</div>
            </div>
            <div class="glass p-6 rounded-xl flex flex-col items-center">
                <span class="stat-icon">🧑‍💼</span>
                <div class="text-3xl font-bold">{{ $stats['employees'] ?? 0 }}</div>
                <div class="text-black/70 dark:text-gray-300 text-sm">Team Members</div>
            </div>
            <div class="glass p-6 rounded-xl flex flex-col items-center">
                <span class="stat-icon">📦</span>
                <div class="text-3xl font-bold">{{ $stats['orders'] ?? 0 }}</div>
                <div class="text-black/70 dark:text-gray-300 text-sm">Orders</div>
            </div>
        </div>
    </div>

    <script>
        // Dark mode toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        darkModeToggle.addEventListener('click', function() {
            if(document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });
        // On page load, set theme from localStorage
        if(localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }

        setTimeout(() => {
            const fadeOut = (el) => {
                if (!el) return;
                el.style.transition = 'opacity 0.5s ease';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            };
            fadeOut(document.getElementById('alert-success'));
            fadeOut(document.getElementById('alert-error'));
        }, 3000);
    </script>
</div>
@endsection
