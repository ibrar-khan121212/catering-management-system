@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Inventory Items</h1>
        <a href="{{ route('inventory_items.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Add New
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100 text-gray-700 text-sm text-left">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Unit</th>
                    <th class="px-4 py-3">Quantity</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700 text-sm">
                @foreach($inventory_items as $item)
                <tr>
                    <td class="px-4 py-2">{{ $item->Inventory_ID }}</td>
                    <td class="px-4 py-2">{{ $item->Name }}</td>
                    <td class="px-4 py-2">{{ $item->Unit }}</td>
                    <td class="px-4 py-2">{{ $item->Quantity_Available }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('inventory_items.show', $item->Inventory_ID) }}" class="text-blue-500 hover:underline">View</a>
                        <a href="{{ route('inventory_items.edit', $item->Inventory_ID) }}" class="text-yellow-500 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('inventory_items.destroy', $item->Inventory_ID) }}" class="inline">
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
@endsection
