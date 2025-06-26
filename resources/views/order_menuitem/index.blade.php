@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-4">Order Menu Items</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4 flex justify-between">
        <a href="{{ route('dashboard') }}" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">← Back to Dashboard</a>
        <a href="{{ route('order_menuitem.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500">+ Add New</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Order</th>
                    <th class="px-4 py-2 border">Menu Item</th>
                    <th class="px-4 py-2 border">Quantity</th>
                    <th class="px-4 py-2 border">Special Notes</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
               @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->order->Order_ID ?? 'N/A' }}</td>
                        <td>{{ $item->menuItem->MenuItem_ID ?? 'N/A' }}</td>
                        <td>{{ $item->Quantity }}</td>
                        <td>{{ $item->Special_Notes }}</td>
                        <td class="flex gap-2">
                            <a href="{{ route('order_menuitem.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-1 rounded">Edit</a>
                            <form method="POST" action="{{ route('order_menuitem.destroy', $item->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection
