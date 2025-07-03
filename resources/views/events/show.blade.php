@extends('layout')

@section('content')
    @if(session('success'))
        <div id="flash-message" class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow z-50">
            {{ session('success') }}
        </div>
    @endif
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white py-10 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between mb-6">
                <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow mr-4">&larr; Back to Dashboard</a>
                <button onclick="toggleDark()" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded shadow font-semibold transition">Toggle Dark Mode</button>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Event Details</h1>
                    <div class="space-x-2">
                        <a href="{{ route('events.edit', $event->Event_ID) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded shadow">Edit Event</a>
                        <a href="{{ route('events.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded shadow">Back to Events</a>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Event Information</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Event ID</label>
                                <p class="text-lg">{{ $event->Event_ID }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Event Type</label>
                                <p class="text-lg">{{ $event->Event_Type }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Date</label>
                                <p class="text-lg">{{ $event->Date }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Location</label>
                                <p class="text-lg">{{ $event->Location }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Client Contact</label>
                                <p class="text-lg">{{ $event->Client_Contact }}</p>
                            </div>
                        </div>
                    </div>
                </div>
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
