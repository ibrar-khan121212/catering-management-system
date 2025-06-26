@extends('layout')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">All Chefs</h1>
        <a href="{{ route('chefs.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Create New</a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Specialty</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($chefs as $chef)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $chef->Employee_ID }}</td>
                    <td class="px-6 py-4">{{ $chef->employee->Name ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $chef->Specialty }}</td>
                    <td class="px-6 py-4 space-x-2">
                        <a href="{{ route('chefs.show', $chef->Employee_ID) }}" class="text-blue-500 hover:underline">View</a>
                        <a href="{{ route('chefs.edit', $chef->Employee_ID) }}" class="text-yellow-500 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('chefs.destroy', $chef->Employee_ID) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">No chefs found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
