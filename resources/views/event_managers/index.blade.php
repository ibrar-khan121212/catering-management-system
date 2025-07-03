@extends('layout')

@section('content')
<div class="max-w-5xl mx-auto p-8 bg-white dark:bg-gray-900 rounded-xl shadow-lg mt-10">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 gap-4">
        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">All Event Managers</h1>
        <div class="flex flex-wrap gap-2">
            <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition font-semibold">Back to Dashboard</a>
            <button type="button" onclick="document.documentElement.classList.toggle('dark')" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition font-semibold">Toggle Dark Mode</button>
            <a href="{{ route('event_managers.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">+ Create New</a>
        </div>
    </div>
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg dark:bg-green-900 dark:text-green-200 font-medium">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded-lg dark:bg-red-900 dark:text-red-200 font-medium">
            {{ session('error') }}
        </div>
    @endif
    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 mt-6">
        <table class="min-w-full bg-white dark:bg-gray-900 text-left">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200">
                    <th class="py-3 px-6 border-b">Employee ID</th>
                    <th class="py-3 px-6 border-b">Name</th>
                    <th class="py-3 px-6 border-b">Managed Events Count</th>
                    <th class="py-3 px-6 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($event_managers as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        <td class="py-3 px-6 border-b">{{ $item->Employee_ID }}</td>
                        <td class="py-3 px-6 border-b">{{ $item->employee->Name ?? 'N/A' }}</td>
                        <td class="py-3 px-6 border-b">{{ $item->Managed_Events_Count }}</td>
                        <td class="py-3 px-6 border-b">
                            <a href="{{ route('event_managers.show', $item->Employee_ID) }}" class="text-blue-600 hover:underline font-semibold">View</a>
                            <span class="mx-1">|</span>
                            <a href="{{ route('event_managers.edit', $item->Employee_ID) }}" class="text-yellow-600 hover:underline font-semibold">Edit</a>
                            <span class="mx-1">|</span>
                            <form method="POST" action="{{ route('event_managers.destroy', $item->Employee_ID) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline font-semibold bg-transparent border-none p-0 m-0">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
