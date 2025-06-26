@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Order Menu Item</h1>

    <form method="POST" action="{{ route('order_menuitem.update', $order_menuitem->id) }}" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf @method('PUT')

        <div>
            <label class="block mb-1 font-semibold">Order</label>
            <select name="Order_ID" class="w-full border px-3 py-2 rounded">
                @foreach($orders as $order)
                <option value="{{ $order->Order_ID }}" @if($order_menuitem->Order_ID == $order->Order_ID) selected @endif>
                    {{ $order->Order_ID }}
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Menu Item</label>
            <select name="MenuItem_ID" class="w-full border px-3 py-2 rounded">
                @foreach($menuItems as $item)
                <option value="{{ $item->MenuItem_ID }}" @if($order_menuitem->MenuItem_ID == $item->MenuItem_ID) selected @endif>
                    {{ $item->Name }}
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Quantity</label>
            <input type="number" name="Quantity" value="{{ $order_menuitem->Quantity }}" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Special Notes</label>
            <textarea name="Special_Notes" class="w-full border px-3 py-2 rounded">{{ $order_menuitem->Special_Notes }}</textarea>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('order_menuitem.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-500">← Back</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500">Update</button>
        </div>
    </form>
</div>
@endsection
