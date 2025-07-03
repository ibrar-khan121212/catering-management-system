@extends('layout')

@section('content')
    @if(session('success'))
        <div id="flash-message" class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow z-50">
            {{ session('success') }}
        </div>
    @endif
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white py-10 px-4">
        <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-8">
            <div class="flex justify-between mb-6">
                <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow mr-4">&larr; Back to Dashboard</a>
                <button onclick="toggleDark()" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded shadow font-semibold transition">Toggle Dark Mode</button>
            </div>
            <h1 class="text-2xl font-bold mb-6">Add New Event</h1>
            <form method="POST" action="{{ route('events.store') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="Event_Type" class="block text-sm font-medium">Event Type</label>
                    <input type="text" name="Event_Type" id="Event_Type" value="{{ old('Event_Type') }}" required class="w-full border rounded p-2">
                    @error('Event_Type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="Date" class="block text-sm font-medium">Date</label>
                    <input type="date" name="Date" id="Date" value="{{ old('Date') }}" required class="w-full border rounded p-2">
                    @error('Date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="Location" class="block text-sm font-medium">Location</label>
                    <input type="text" name="Location" id="Location" value="{{ old('Location') }}" required class="w-full border rounded p-2">
                    @error('Location') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="Client_Contact" class="block text-sm font-medium">Client Contact</label>
                    <input type="text" name="Client_Contact" id="Client_Contact" value="{{ old('Client_Contact') }}" required class="w-full border rounded p-2">
                    @error('Client_Contact') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded shadow">Save</button>
                </div>
            </form>
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
