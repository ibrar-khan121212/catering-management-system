@extends('layout')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white dark:bg-gray-900 rounded-xl shadow-lg mt-10">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">Edit Server Assignment</h1>
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

    <form method="POST" action="{{ route('servers.update', $server->Employee_ID) }}" class="space-y-7">
        @csrf
        @method('PUT')
        <div>
            <label for="Employee_Name" class="block font-semibold text-gray-700 dark:text-gray-200 mb-2">Employee Name</label>
            <input id="Employee_Name" type="text" disabled value="{{ $server->employee->Name ?? 'N/A' }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg dark:bg-gray-800 dark:text-gray-100 bg-gray-100 font-medium cursor-not-allowed" />
        </div>
        <div>
            <label for="Assigned_Section" class="block font-semibold text-gray-700 dark:text-gray-200 mb-2">Assigned Section</label>
            <input id="Assigned_Section" type="text" name="Assigned_Section" value="{{ old('Assigned_Section', $server->Assigned_Section) }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
            @error('Assigned_Section')
                <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex items-center justify-between mt-6">
            <button type="submit" class="px-8 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">Update</button>
            <button type="button" onclick="document.documentElement.classList.toggle('dark')" class="ml-4 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition font-semibold">Toggle Dark Mode</button>
        </div>
    </form>
</div>
@endsection
