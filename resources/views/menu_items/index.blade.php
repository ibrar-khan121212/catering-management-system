@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Menu Items</h1>
        <a href="{{ route('menu_items.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Create New Item
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100 text-gray-700 text-sm text-left">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Price</th>
                    <th class="px-4 py-3">Description</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700 text-sm">
                @foreach($menu_items as $item)
                <tr>
                    <td class="px-4 py-2">{{ $item->MenuItem_ID }}</td>
                    <td class="px-4 py-2">{{ $item->Name }}</td>
                    <td class="px-4 py-2">Rs. {{ number_format($item->Price, 2) }}</td>
                    <td class="px-4 py-2">{{ \Illuminate\Support\Str::limit($item->Description, 50) }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('menu_items.show', $item->MenuItem_ID) }}" class="text-blue-500 hover:underline">View</a>
                        <a href="{{ route('menu_items.edit', $item->MenuItem_ID) }}" class="text-yellow-500 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('menu_items.destroy', $item->MenuItem_ID) }}" class="inline">
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
