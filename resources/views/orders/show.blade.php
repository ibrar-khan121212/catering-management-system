@extends('layout')

@section('content')
    @if(session('success'))
        <div id="flash-message" class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow z-50">
            {{ session('success') }}
        </div>
    @endif
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white py-10 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between mb-6">
                <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow mr-4">&larr; Back to Dashboard</a>
                <button onclick="toggleDark()" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded shadow font-semibold transition">Toggle Dark Mode</button>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Order Details</h1>
                    <div class="space-x-2">
                        <a href="{{ route('orders.edit', $order->Order_ID) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded shadow">Edit Order</a>
                        <a href="{{ route('orders.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded shadow">Back to Orders</a>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Order Information</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Order ID</label>
                                <p class="text-lg">{{ $order->Order_ID }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Order Date</label>
                                <p class="text-lg">{{ $order->Order_Date }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Total Amount</label>
                                @if($order->payments->count() > 0)
                                    <p class="text-lg font-semibold text-green-600 dark:text-green-400">
                                        ${{ number_format($order->payments->first()->Amount, 2) }}
                                    </p>
                                @else
                                    <p class="text-lg text-gray-500 dark:text-gray-400">No payment recorded</p>
                                @endif
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Status</label>
                                <span class="px-3 py-1 rounded text-sm font-semibold
                                    @if($order->Status == 'Completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                    @elseif($order->Status == 'In Progress') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                    @elseif($order->Status == 'Confirmed') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                    @elseif($order->Status == 'Cancelled') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                    @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200
                                    @endif">
                                    {{ $order->Status }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Customer & Event Details</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Customer</label>
                                <p class="text-lg">{{ $order->customer->Name ?? 'N/A' }}</p>
                                @if($order->customer)
                                    <p class="text-sm text-gray-500">{{ $order->customer->Email }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->customer->Phone }}</p>
                                @endif
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Event</label>
                                <p class="text-lg">{{ $order->event->Event_Name ?? 'N/A' }}</p>
                                @if($order->event)
                                    <p class="text-sm text-gray-500">{{ $order->event->Event_Date }} at {{ $order->event->Event_Time }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->event->Location }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Payment Information Section --}}
                @if($order->payments->count() > 0)
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold mb-4">Payment Information</h3>
                        <div class="bg-green-50 dark:bg-green-900 p-4 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Payment Amount</label>
                                    <p class="text-xl font-bold text-green-600 dark:text-green-400">
                                        ${{ number_format($order->payments->first()->Amount, 2) }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Payment Method</label>
                                    <span class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm font-medium">
                                        {{ $order->payments->first()->Method }}
                                    </span>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Payment Date</label>
                                    <p class="text-lg">{{ \Carbon\Carbon::parse($order->payments->first()->Payment_Date)->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
