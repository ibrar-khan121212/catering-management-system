@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">Create New Event</h2>
        <a href="{{ route('events.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">← Back to Events</a>
    </div>

    <form action="{{ route('events.store') }}" method="POST" class="bg-white p-6 rounded shadow space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Event Type</label>
            <input type="text" name="Event_Type" class="w-full mt-1 border-gray-300 rounded-md" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" name="Date" class="w-full mt-1 border-gray-300 rounded-md" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" name="Location" class="w-full mt-1 border-gray-300 rounded-md" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Client Contact</label>
            <input type="text" name="Client_Contact" class="w-full mt-1 border-gray-300 rounded-md" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
    </form>
</div>
@endsection
