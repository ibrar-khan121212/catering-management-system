@extends('layout')

@section('content')
    @if(session('success'))
        <div id="flash-message" class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow z-50">
            {{ session('success') }}
        </div>
    @endif
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white py-10 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between mb-6">
                <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow mr-4">&larr; Back to Dashboard</a>
                <button onclick="toggleDark()" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded shadow font-semibold transition">Toggle Dark Mode</button>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Events</h1>
                    <a href="{{ route('events.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">Add New Event</a>
                </div>
                @if($events->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th class="border p-3 text-left">ID</th>
                                    <th class="border p-3 text-left">Event Type</th>
                                    <th class="border p-3 text-left">Date</th>
                                    <th class="border p-3 text-left">Location</th>
                                    <th class="border p-3 text-left">Client Contact</th>
                                    <th class="border p-3 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $event)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="border p-3">{{ $event->Event_ID }}</td>
                                        <td class="border p-3">{{ $event->Event_Type }}</td>
                                        <td class="border p-3">{{ $event->Date }}</td>
                                        <td class="border p-3">{{ $event->Location }}</td>
                                        <td class="border p-3">{{ $event->Client_Contact }}</td>
                                        <td class="border p-3">
                                            <a href="{{ route('events.show', $event->Event_ID) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm mr-2">View</a>
                                            <a href="{{ route('events.edit', $event->Event_ID) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-sm mr-2">Edit</a>
                                            <form method="POST" action="{{ route('events.destroy', $event->Event_ID) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center text-gray-500 dark:text-gray-400 py-8">No events found.</p>
                @endif
            </div>
        </div>
    </div>
    <script>
        if(localStorage.getItem('theme') === 'dark') document.documentElement.classList.add('dark');
        function toggleDark() {
            const root = document.documentElement;
            const isDark = root.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }
        const flash = document.getElementById('flash-message');
        if (flash) setTimeout(() => flash.remove(), 2000);
    </script>
@endsection
