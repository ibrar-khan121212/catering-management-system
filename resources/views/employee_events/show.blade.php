@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Employee Event Details</h2>

        <div class="mb-4">
            <strong class="text-gray-700">Employee ID:</strong>
            <p>{{ $employee_event->Employee_ID }}</p>
        </div>

        <div class="mb-4">
            <strong class="text-gray-700">Event ID:</strong>
            <p>{{ $employee_event->Event_ID }}</p>
        </div>

        <div class="mb-4">
            <strong class="text-gray-700">Role in Event:</strong>
            <p>{{ $employee_event->Role_in_Event }}</p>
        </div>

        <div class="mb-4">
            <strong class="text-gray-700">Shift Time:</strong>
            <p>{{ $employee_event->Shift_Time }}</p>
        </div>

        <a href="{{ route('employee_events.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">← Back to List</a>
    </div>
</div>
@endsection
