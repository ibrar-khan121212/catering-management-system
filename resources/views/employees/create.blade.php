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
            <h1 class="text-2xl font-bold mb-6">Add New Employee</h1>
            <form method="POST" action="{{ route('employees.store') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="Name" class="block text-sm font-medium">Name</label>
                    <input type="text" name="Name" id="Name" value="{{ old('Name') }}" required class="w-full border rounded p-2">
                    @error('Name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="Contact" class="block text-sm font-medium">Contact</label>
                    <input type="text" name="Contact" id="Contact" value="{{ old('Contact') }}" required class="w-full border rounded p-2">
                    @error('Contact') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="Salary" class="block text-sm font-medium">Salary</label>
                    <input type="number" name="Salary" id="Salary" step="0.01" value="{{ old('Salary') }}" required class="w-full border rounded p-2">
                    @error('Salary') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
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
