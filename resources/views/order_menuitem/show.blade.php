@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow rounded p-6 max-w-xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Order Menu Item Details</h1>

        <div class="mb-4">
            <label class="font-semibold text-gray-700">ID:</label>
            <div class="text-gray-900">{{ $order_menuitem->id }}</div>
        </div>

        <div class="mb-4">
            <label class="font-semibold text-gray-700">Order ID:</label>
            <div class="text-gray-900">{{ $order_menuitem->Order_ID }}</div>
        </div>

        <div class="mb-4">
            <label class="font-semibold text-gray-700">Menu Item ID:</label>
            <div class="text-gray-900">{{ $order_menuitem->MenuItem_ID }}</div>
        </div>

        <div class="mb-4">
            <label class="font-semibold text-gray-700">Quantity:</label>
            <div class="text-gray-900">{{ $order_menuitem->Quantity }}</div>
        </div>

        <div class="mb-4">
            <label class="font-semibold text-gray-700">Special Notes:</label>
            <div class="text-gray-900">{{ $order_menuitem->Special_Notes ?? 'N/A' }}</div>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('order_menuitem.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-500">← Back to List</a>
            <a href="{{ route('order_menuitem.edit', $order_menuitem->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500">Edit</a>
        </div>
    </div>
</div>
@endsection
