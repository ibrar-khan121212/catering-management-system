@extends('layout')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white dark:bg-gray-900 rounded shadow mt-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Assign Server</h1>
        <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-300 dark:hover:bg-gray-600 transition">Back to Dashboard</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded dark:bg-green-900 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded dark:bg-red-900 dark:text-red-200">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('servers.store') }}" class="space-y-6">
        @csrf
        <div>
            <label for="Employee_ID" class="block font-semibold text-gray-700 dark:text-gray-200 mb-1">Select Employee</label>
            <select id="Employee_ID" name="Employee_ID" required class="w-full px-3 py-2 border rounded dark:bg-gray-800 dark:text-gray-100">
                <option value="">-- Choose Employee --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->Employee_ID }}" {{ old('Employee_ID') == $employee->Employee_ID ? 'selected' : '' }}>{{ $employee->Name }}</option>
                @endforeach
            </select>
            @error('Employee_ID')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="Assigned_Section" class="block font-semibold text-gray-700 dark:text-gray-200 mb-1">Assigned Section</label>
            <input id="Assigned_Section" type="text" name="Assigned_Section" value="{{ old('Assigned_Section') }}" required class="w-full px-3 py-2 border rounded dark:bg-gray-800 dark:text-gray-100" />
            @error('Assigned_Section')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Save</button>
            <button type="button" onclick="document.documentElement.classList.toggle('dark')" class="ml-4 px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-600 transition">Toggle Dark Mode</button>
        </div>
    </form>
</div>
@endsection
