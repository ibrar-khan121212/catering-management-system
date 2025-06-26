@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white dark:bg-gray-900 shadow-md rounded-lg p-6 mt-10">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Edit Menu Item Inventory</h2>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-800 p-4 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('menuitem_inventoryitem.update', $menuitem_inventoryitem->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="MenuItem_ID" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Menu Item</label>
            <select name="MenuItem_ID" id="MenuItem_ID" class="mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white">
                @foreach ($menuItems as $item)
                    <option value="{{ $item->MenuItem_ID }}" {{ $menuitem_inventoryitem->MenuItem_ID == $item->MenuItem_ID ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="Inventory_ID" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Inventory Item</label>
            <select name="Inventory_ID" id="Inventory_ID" class="mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white">
                @foreach ($inventoryItems as $item)
                    <option value="{{ $item->Inventory_ID }}" {{ $menuitem_inventoryitem->Inventory_ID == $item->Inventory_ID ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="Quantity_Required" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Quantity Required</label>
            <input type="number" name="Quantity_Required" id="Quantity_Required" min="1" value="{{ $menuitem_inventoryitem->Quantity_Required }}" class="mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white">
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('menuitem_inventoryitem.index') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">← Back to List</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">Update</button>
        </div>
    </form>
</div>
@endsection
