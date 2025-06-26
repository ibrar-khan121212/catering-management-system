@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow p-6 max-w-xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Edit Event Manager</h1>

        <form method="POST" action="{{ route('event_managers.update', $item->Employee_ID) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="Managed_Events_Count" class="block text-sm font-medium text-gray-700">Managed Events Count</label>
                <input type="number" name="Managed_Events_Count" id="Managed_Events_Count"
                       value="{{ $item->Managed_Events_Count }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                Update
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
