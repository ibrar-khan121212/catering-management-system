@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6">Edit Employee Event</h2>

    <form action="{{ route('employee_events.update', $employee_event->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div>
            <label for="Role_in_Event" class="block text-sm font-medium text-gray-700">Role in Event</label>
            <input type="text" name="Role_in_Event" id="Role_in_Event" value="{{ $employee_event->Role_in_Event }}" class="mt-1 block w-full border-gray-300 rounded" required>
        </div>

        <div>
            <label for="Shift_Time" class="block text-sm font-medium text-gray-700">Shift Time</label>
            <input type="text" name="Shift_Time" id="Shift_Time" value="{{ $employee_event->Shift_Time }}" class="mt-1 block w-full border-gray-300 rounded" required>
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Update</button>
            <a href="{{ route('employee_events.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">← Back to List</a>
        </div>
    </form>
</div>
@endsection
