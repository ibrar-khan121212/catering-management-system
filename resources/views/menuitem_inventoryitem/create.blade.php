@extends('layout')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h2 class="text-xl font-bold mb-4">Add New Mapping</h2>

    <form action="{{ route('menuitem_inventoryitem.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label>Menu Item:</label>
            <select name="MenuItem_ID" class="w-full border px-3 py-2">
                @foreach($menuItems as $item)
                    <option value="{{ $item->MenuItem_ID }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Inventory Item:</label>
            <select name="Inventory_ID" class="w-full border px-3 py-2">
                @foreach($inventoryItems as $item)
                    <option value="{{ $item->Inventory_ID }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Quantity Required:</label>
            <input type="number" name="Quantity_Required" class="w-full border px-3 py-2">
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
            <a href="{{ route('menuitem_inventoryitem.index') }}" class="text-gray-600 underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
