@extends('layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">All Event Managers</h1>
    <a href="{{ route('event_managers.create') }}" class="inline-block mb-4 bg-blue-500 text-white px-4 py-2 rounded">Create New</a>

    <table class="w-full border border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Employee ID</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Managed Events</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($event_managers as $item)
            <tr class="text-center">
                <td class="border px-4 py-2">{{ $item->Employee_ID }}</td>
                <td class="border px-4 py-2">{{ $item->employee->name ?? 'N/A' }}</td>
                <td class="border px-4 py-2">{{ $item->Managed_Events_Count }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('event_managers.show', $item->Employee_ID) }}" class="text-blue-600">View</a> |
                    <a href="{{ route('event_managers.edit', $item->Employee_ID) }}" class="text-green-600">Edit</a> |
                    <form method="POST" action="{{ route('event_managers.destroy', $item->Employee_ID) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
