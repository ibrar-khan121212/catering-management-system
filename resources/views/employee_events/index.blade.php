@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Employee Events</h1>
        <div class="space-x-2">
            <a href="{{ route('dashboard') }}" 
               class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition duration-300">
               ← Dashboard
            </a>
            <a href="{{ route('employee_events.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
               + Create New
            </a>
        </div>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Employee ID</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Event ID</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Role in Event</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Shift Time</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($employee_events as $item)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->Employee_ID }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->Event_ID }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->Role_in_Event }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->Shift_Time }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900 space-x-2">
                        <a href="{{ route('employee_events.show', $item->id) }}"
                           class="text-indigo-600 hover:text-indigo-900">View</a>
                        <a href="{{ route('employee_events.edit', $item->id) }}"
                           class="text-yellow-600 hover:text-yellow-800">Edit</a>
                        <form method="POST" 
                              action="{{ route('employee_events.destroy', $item->id) }}" 
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-800"
                                    onclick="return confirm('Are you sure you want to delete this item?');">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
