@extends('layout')

@section('content')
    @if(session('success'))
        <div id="flash-message" class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow z-50">
            {{ session('success') }}
        </div>
    @endif
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white py-10 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between mb-6">
                <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow mr-4">&larr; Back to Dashboard</a>
                <button onclick="toggleDark()" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded shadow font-semibold transition">Toggle Dark Mode</button>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Orders</h1>
                    <a href="{{ route('orders.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">Add New Order</a>
                </div>
                @if($orders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th class="border p-3 text-left">Order ID</th>
                                    <th class="border p-3 text-left">Customer</th>
                                    <th class="border p-3 text-left">Event</th>
                                    <th class="border p-3 text-left">Order Date</th>
                                    <th class="border p-3 text-left">Total Amount</th>
                                    <th class="border p-3 text-left">Status</th>
                                    <th class="border p-3 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="border p-3">{{ $order->Order_ID }}</td>
                                        <td class="border p-3">{{ $order->customer->Name ?? 'N/A' }}</td>
                                        <td class="border p-3">
                                            <div class="space-y-1">
                                                <div class="font-medium">{{ $order->event->Event_Type ?? 'N/A' }}</div>
                                                @if($order->event)
                                                    <div class="text-sm text-gray-600 dark:text-gray-400">
                                                        📅 {{ \Carbon\Carbon::parse($order->event->Date)->format('M d, Y') }}
                                                    </div>
                                                    <div class="text-sm text-gray-600 dark:text-gray-400">
                                                        📍 {{ $order->event->Location ?? 'Location not specified' }}
                                                    </div>
                                                    @if($order->event->Client_Contact)
                                                        <div class="text-sm text-gray-600 dark:text-gray-400">
                                                            📞 {{ $order->event->Client_Contact }}
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                        <td class="border p-3">{{ $order->Order_Date }}</td>
                                        <td class="border p-3">
                                            @if($order->payments->count() > 0)
                                                <span class="font-bold text-green-600 dark:text-green-400">
                                                    ${{ number_format($order->payments->first()->Amount, 2) }}
                                                </span>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $order->payments->first()->Method }}
                                                </div>
                                            @else
                                                <span class="text-gray-500 dark:text-gray-400">No payment</span>
                                            @endif
                                        </td>
                                        <td class="border p-3">
                                            <span class="px-2 py-1 rounded text-xs font-semibold
                                                @if($order->Status == 'Completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                @elseif($order->Status == 'In Progress') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                                @elseif($order->Status == 'Confirmed') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                @elseif($order->Status == 'Cancelled') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                                @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200
                                                @endif">
                                                {{ $order->Status }}
                                            </span>
                                        </td>
                                        <td class="border p-3">
                                            <a href="{{ route('orders.show', $order->Order_ID) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm mr-2">View</a>
                                            <a href="{{ route('orders.edit', $order->Order_ID) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-sm mr-2">Edit</a>
                                            <form method="POST" action="{{ route('orders.destroy', $order->Order_ID) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center text-gray-500 dark:text-gray-400 py-8">No orders found.</p>
                @endif
            </div>
        </div>
    </div>
    <script>
        if(localStorage.getItem('theme') === 'dark') document.documentElement.classList.add('dark');
        function toggleDark() {
            const root = document.documentElement;
            const isDark = root.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }
        const flash = document.getElementById('flash-message');
        if (flash) setTimeout(() => flash.remove(), 2000);
    </script>
@endsection
