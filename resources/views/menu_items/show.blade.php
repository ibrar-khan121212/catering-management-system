@extends('layout')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white py-10 px-4 flex flex-col items-center">
        <div class="max-w-md w-full bg-white dark:bg-gray-800 shadow rounded-lg p-8">
            <div class="flex justify-between mb-6">
                <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow mr-4">&larr; Back to Dashboard</a>
                <button onclick="toggleDark()" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded shadow font-semibold transition">Toggle Dark Mode</button>
            </div>
            <h1 class="text-2xl font-bold mb-6">Menu Item Details</h1>
            <div class="space-y-4">
                <p><strong>Name:</strong> {{ $item->Name }}</p>
                <p><strong>Price:</strong> Rs. {{ number_format($item->Price, 2) }}</p>
                <p><strong>Description:</strong> {{ $item->Description }}</p>
            </div>
            <div class="mt-6 text-center">
                <a href="{{ route('menu_items.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded shadow">&larr; Back to Menu Items</a>
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
    </script>
@endsection
