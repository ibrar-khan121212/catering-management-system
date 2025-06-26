@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow-md rounded-lg p-6 max-w-xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Create Event Manager</h1>

        <form method="POST" action="{{ route('event_managers.store') }}">
            @csrf

            <div class="mb-4">
                <label for="Employee_ID" class="block text-sm font-medium text-gray-700">Employee ID</label>
                <input type="number" name="Employee_ID" id="Employee_ID" required
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="Managed_Events_Count" class="block text-sm font-medium text-gray-700">Managed Events Count</label>
                <input type="number" name="Managed_Events_Count" id="Managed_Events_Count" required
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                Save
            </button>
        </form>

        <div class="mt-4">
            <a href="{{ route('event_managers.index') }}" class="text-blue-600 hover:underline text-sm">
                ← Back to List
            </a>
        </div>
    </div>
</div>
@endsection
