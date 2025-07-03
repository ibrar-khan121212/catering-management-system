@extends('layout')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white py-10 px-4">
    <div class="max-w-6xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-8">
        <div class="flex justify-between mb-6">
            <a href="/" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">&larr; Back to Welcome</a>
            <button onclick="toggleDark()" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded shadow font-semibold transition">Toggle Dark Mode</button>
        </div>
        <h1 class="text-2xl font-bold mb-6">My Orders</h1>
        @if($orders->count())
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="border p-3 text-left">Order ID</th>
                            <th class="border p-3 text-left">Event Details</th>
                            <th class="border p-3 text-left">Order Date</th>
                            <th class="border p-3 text-left">Payment</th>
                            <th class="border p-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="border p-3 font-semibold">{{ $order->Order_ID }}</td>
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
                                <td class="border p-3">{{ \Carbon\Carbon::parse($order->Order_Date)->format('M d, Y') }}</td>
                                <td class="border p-3">
                                    @if($order->payments->count() > 0)
                                        <div class="space-y-1">
                                            <div class="font-bold text-green-600 dark:text-green-400">
                                                ${{ number_format($order->payments->first()->Amount, 2) }}
                                            </div>
                                            <div class="text-sm">
                                                <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-xs font-medium">
                                                    {{ $order->payments->first()->Method }}
                                                </span>
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ \Carbon\Carbon::parse($order->payments->first()->Payment_Date)->format('M d, Y') }}
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-gray-500 dark:text-gray-400 text-sm">No payment recorded</span>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 dark:text-gray-500 text-6xl mb-4">📋</div>
                <p class="text-gray-500 dark:text-gray-400 text-lg mb-2">You have not placed any orders yet.</p>
                <p class="text-gray-400 dark:text-gray-500 text-sm">Start by creating your first order!</p>
            </div>
        @endif
    </div>
</div>
<script>
    if(localStorage.getItem('theme') === 'dark') document.documentElement.classList.add('dark');
    function toggleDark() {
        const root = document.documentElement;
        const isDark = root.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    }
</script>
@endsection 