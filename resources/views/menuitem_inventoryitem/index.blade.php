@extends('layout')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-4">MenuItem - Inventory Mapping</h1>

    <a href="{{ route('menuitem_inventoryitem.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add New</a>

    <table class="w-full mt-6 table-auto border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">Menu Item</th>
                <th class="border px-4 py-2">Inventory Item</th>
                <th class="border px-4 py-2">Quantity</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr class="bg-white hover:bg-gray-50">
                <td class="border px-4 py-2">{{ $item->menuItem->name ?? 'N/A' }}</td>
                <td class="border px-4 py-2">{{ $item->inventoryItem->name ?? 'N/A' }}</td>
                <td class="border px-4 py-2">{{ $item->Quantity_Required }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('menuitem_inventoryitem.show', $item->id) }}" class="text-blue-500">View</a> |
                    <a href="{{ route('menuitem_inventoryitem.edit', $item->id) }}" class="text-green-600">Edit</a> |
                    <form action="{{ route('menuitem_inventoryitem.destroy', $item->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this record?')" class="text-red-600">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-6">
        <a href="{{ url('/') }}" class="text-sm text-blue-600 underline">← Back to Dashboard</a>
    </div>
</div>
@endsection
