@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Add Order Menu Item</h1>

    <form method="POST" action="{{ route('order_menuitem.store') }}" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf

        <div>
            <label class="block mb-1 font-semibold">Order</label>
            <select name="Order_ID" class="w-full border px-3 py-2 rounded">
                @foreach($orders as $order)
                <option value="{{ $order->Order_ID }}">{{ $order->Order_ID }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Menu Item</label>
            <select name="MenuItem_ID" class="w-full border px-3 py-2 rounded">
                @foreach($menuItems as $item)
                <option value="{{ $item->MenuItem_ID }}">{{ $item->Name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Quantity</label>
            <input type="number" name="Quantity" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Special Notes</label>
            <textarea name="Special_Notes" class="w-full border px-3 py-2 rounded"></textarea>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('order_menuitem.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-500">← Back</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-500">Save</button>
        </div>
    </form>
</div>
@endsection
