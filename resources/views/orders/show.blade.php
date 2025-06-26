@extends('layout')

@section('content')
<div class="max-w-xl mx-auto px-4 py-10 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Order Details</h2>

    <p><strong>Order ID:</strong> {{ $order->Order_ID }}</p>
    <p><strong>Customer:</strong> {{ $order->customer->Name ?? 'N/A' }}</p>
    <p><strong>Event:</strong> {{ $order->event->Event_Type ?? 'N/A' }}</p>
    <p><strong>Order Date:</strong> {{ $order->Order_Date }}</p>
    <p><strong>Status:</strong> {{ $order->Status }}</p>

    <a href="{{ route('orders.index') }}" class="inline-block mt-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">← Back to Orders</a>
</div>
@endsection
