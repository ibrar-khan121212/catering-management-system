@extends('layout')

@section('content')
<div class="max-w-xl mx-auto p-8 bg-white dark:bg-gray-900 rounded-xl shadow-lg mt-10">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">Server Details</h1>
        <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition font-semibold">Back to Dashboard</a>
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
    <div class="mb-6 space-y-4">
        <div class="flex items-center">
            <span class="w-48 font-semibold text-gray-700 dark:text-gray-200">Employee ID:</span>
            <span class="text-gray-900 dark:text-gray-100">{{ $server->Employee_ID }}</span>
        </div>
        <div class="flex items-center">
            <span class="w-48 font-semibold text-gray-700 dark:text-gray-200">Name:</span>
            <span class="text-gray-900 dark:text-gray-100">{{ $server->employee->Name ?? 'N/A' }}</span>
        </div>
        <div class="flex items-center">
            <span class="w-48 font-semibold text-gray-700 dark:text-gray-200">Assigned Section:</span>
            <span class="text-gray-900 dark:text-gray-100">{{ $server->Assigned_Section }}</span>
        </div>
    </div>
    <div class="flex items-center gap-4 mt-8">
        <a href="{{ route('servers.index') }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Back to List</a>
        <button type="button" onclick="document.documentElement.classList.toggle('dark')" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition font-semibold">Toggle Dark Mode</button>
    </div>
</div>
@endsection
