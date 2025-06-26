@extends('layout')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">

    {{-- Back to Dashboard button --}}
    

    {{-- Page title and Create button --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">All Events</h1>
      <div class="flex gap-4">
        <a href="{{ route('dashboard') }}" 
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
            ← Back to Dashboard
        </a>
   
        <a href="{{ route('events.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Create New Event
        </a>
        </div>

    </div>

    {{-- Events table --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100 text-left text-gray-700 text-sm">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Location</th>
                    <th class="px-4 py-3">Contact</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @foreach($events as $item)
                <tr>
                    <td class="px-4 py-2">{{ $item->Event_ID }}</td>
                    <td class="px-4 py-2">{{ $item->Event_Type }}</td>
                    <td class="px-4 py-2">{{ $item->Date }}</td>
                    <td class="px-4 py-2">{{ $item->Location }}</td>
                    <td class="px-4 py-2">{{ $item->Client_Contact }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('events.show', $item->Event_ID) }}" class="text-blue-500 hover:underline">View</a>
                        <a href="{{ route('events.edit', $item->Event_ID) }}" class="text-yellow-500 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('events.destroy', $item->Event_ID) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
