@extends('layout')

@section('content')
<div class="min-h-screen gradient-bg text-black relative overflow-hidden">
    <style>

        
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .glass {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.05);
        }
    </style>

    <!-- Decorative Blobs -->
    <div class="absolute top-[-100px] left-[-100px] w-[300px] h-[300px] rounded-full bg-white opacity-5 blur-3xl"></div>
    <div class="absolute bottom-[-100px] right-[-100px] w-[300px] h-[300px] rounded-full bg-white opacity-5 blur-3xl"></div>

    <!-- Header -->
    <div class="text-center py-16 px-4 max-w-4xl mx-auto">
        <h1 class="text-5xl md:text-6xl font-extrabold text-black leading-tight mb-4 fade-in-up">
            Catering <span class="text-yellow-300">Management</span>
        </h1>
        <p class="text-xl text-white/80 max-w-xl mx-auto fade-in-up">
            Streamline your catering business operations with ease and elegance.
        </p>
    </div>

    <!-- Dashboard Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4 pb-20 max-w-7xl mx-auto">
        @php
            $cards = [
                ['route' => 'customers.index', 'color' => 'from-blue-400 to-blue-600', 'label' => 'Customers', 'desc' => 'Manage client profiles', 'icon' => '👥'],
                ['route' => 'events.index', 'color' => 'from-green-400 to-green-600', 'label' => 'Events', 'desc' => 'Plan & schedule events', 'icon' => '📅'],
                ['route' => 'orders.index', 'color' => 'from-yellow-400 to-orange-500', 'label' => 'Orders', 'desc' => 'Track order status', 'icon' => '📦'],
                ['route' => 'payments.index', 'color' => 'from-emerald-400 to-emerald-600', 'label' => 'Payments', 'desc' => 'Manage payments', 'icon' => '💰'],
                ['route' => 'menu_items.index', 'color' => 'from-purple-400 to-purple-600', 'label' => 'Menu Items', 'desc' => 'Manage your menu', 'icon' => '🍽️'],
                ['route' => 'inventory_items.index', 'color' => 'from-indigo-400 to-indigo-600', 'label' => 'Inventory', 'desc' => 'Stock control', 'icon' => '📦'],
                ['route' => 'employees.index', 'color' => 'from-teal-400 to-teal-600', 'label' => 'Employees', 'desc' => 'Manage staff', 'icon' => '🧑‍💼'],
                ['route' => 'chefs.index', 'color' => 'from-red-400 to-red-600', 'label' => 'Chefs', 'desc' => 'Kitchen management', 'icon' => '👨‍🍳'],
                ['route' => 'servers.index', 'color' => 'from-cyan-400 to-cyan-600', 'label' => 'Servers', 'desc' => 'Service team', 'icon' => '🧑‍🍽️'],
                ['route' => 'event_managers.index', 'color' => 'from-amber-400 to-amber-600', 'label' => 'Event Managers', 'desc' => 'Coordination staff', 'icon' => '🎤'],
                ['route' => 'order_menu_items.index', 'color' => 'from-pink-400 to-pink-600', 'label' => 'Order Items', 'desc' => 'Menu-order link', 'icon' => '🔗'],
                ['route' => 'menuitem_inventoryitems.index', 'color' => 'from-rose-400 to-rose-600', 'label' => 'Recipes', 'desc' => 'Menu-stock relations', 'icon' => '📋'],
                ['route' => 'employee_events.index', 'color' => 'from-violet-400 to-violet-600', 'label' => 'Staff Events', 'desc' => 'Assignments & shifts', 'icon' => '📊'],
            ];
        @endphp

        @foreach($cards as $card)
            <a href="{{ route($card['route']) }}" class="glass rounded-xl p-5 text-center shadow-lg hover:scale-105 transform transition">
                <div class="w-14 h-14 mx-auto flex items-center justify-center bg-gradient-to-br {{ $card['color'] }} rounded-full text-2xl">
                    {{ $card['icon'] }}
                </div>
                <h2 class="mt-4 font-bold text-lg">{{ $card['label'] }}</h2>
                <p class="text-sm text-white/70">{{ $card['desc'] }}</p>
            </a>
        @endforeach
    </div>

    <!-- Stats Section -->
    <div class="bg-white/5 py-10 px-4 mt-8">
        <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="glass p-6 rounded-xl">
                <div class="text-3xl font-bold">250+</div>
                <div class="text-black/70 text-sm">Active Customers</div>
            </div>
            <div class="glass p-6 rounded-xl">
                <div class="text-3xl font-bold">89</div>
                <div class="text-black/70 text-sm">Events This Month</div>
            </div>
            <div class="glass p-6 rounded-xl">
                <div class="text-3xl font-bold">45</div>
                <div class="ttext-black/70 text-sm">Team Members</div>
            </div>
            <div class="glass p-6 rounded-xl">
                <div class="text-3xl font-bold">98%</div>
                <div class="text-black/70 text-sm">Order Success Rate</div>
            </div>
        </div>
    </div>
</div>
@endsection
