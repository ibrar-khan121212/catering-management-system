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
            <h1 class="text-2xl font-bold mb-6">Edit Menu Item</h1>
            <form method="POST" action="{{ route('menu_items.update', $item->MenuItem_ID) }}" class="space-y-5">
                @csrf
                @method('PUT')
                <div>
                    <label for="Name" class="block text-sm font-medium">Name</label>
                    <input type="text" name="Name" id="Name" value="{{ old('Name', $item->Name) }}" required class="w-full border rounded p-2">
                    @error('Name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="Price" class="block text-sm font-medium">Price</label>
                    <input type="number" name="Price" id="Price" step="0.01" value="{{ old('Price', $item->Price) }}" required class="w-full border rounded p-2">
                    @error('Price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="Description" class="block text-sm font-medium">Description</label>
                    <textarea name="Description" id="Description" rows="4" required class="w-full border rounded p-2">{{ old('Description', $item->Description) }}</textarea>
                    @error('Description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">Update</button>
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
