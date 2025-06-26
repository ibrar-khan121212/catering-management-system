@extends('layout')

@section('content')

@if(session('success'))
    <div id="alert-success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div id="alert-error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">All Orders</h1>
        <div class="space-x-2">
           
            <a href="{{ route('dashboard') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
               ← Dashboard
            </a>
            <a href="{{ route('orders.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Create New Order
            </a>
        </div>
        
    </div>



    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100 text-left text-sm text-gray-700">
                <tr>
                    <th class="px-4 py-3">Order ID</th>
                    <th class="px-4 py-3">Customer</th>
                    <th class="px-4 py-3">Event</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @foreach($orders as $order)
                <tr>
                    <td class="px-4 py-2">{{ $order->Order_ID }}</td>
                    <td class="px-4 py-2">{{ $order->customer->Name ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $order->event->Event_Type ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $order->Order_Date }}</td>
                    <td class="px-4 py-2">{{ $order->Status }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('orders.show', $order->Order_ID) }}" class="text-blue-500 hover:underline">View</a>
                        <a href="{{ route('orders.edit', $order->Order_ID) }}" class="text-yellow-500 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('orders.destroy', $order->Order_ID) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
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
@endsection
