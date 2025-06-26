@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">Event Details</h2>
        <a href="{{ route('events.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">← Back to Events</a>
    </div>

    <div class="bg-white p-6 rounded shadow space-y-4">
        <p><strong>ID:</strong> {{ $event->Event_ID }}</p>
        <p><strong>Type:</strong> {{ $event->Event_Type }}</p>
        <p><strong>Date:</strong> {{ $event->Date }}</p>
        <p><strong>Location:</strong> {{ $event->Location }}</p>
        <p><strong>Contact:</strong> {{ $event->Client_Contact }}</p>
    </div>
</div>
@endsection
