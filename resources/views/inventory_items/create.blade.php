@extends('layout')

@section('content')
<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Add Inventory Item</h1>

    <form method="POST" action="{{ route('inventory_items.store') }}" class="space-y-5">
        @csrf

        <div>
            <label for="Name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="Name" id="Name" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div>
            <label for="Unit" class="block text-sm font-medium text-gray-700">Unit (e.g., kg, liter, pcs)</label>
            <input type="text" name="Unit" id="Unit" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div>
            <label for="Quantity_Available" class="block text-sm font-medium text-gray-700">Quantity Available</label>
            <input type="number" name="Quantity_Available" id="Quantity_Available" min="0" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div class="text-right">
            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
