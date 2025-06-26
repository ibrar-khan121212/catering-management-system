@extends('layout')

@section('content')
<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow">
    <h1 class="text-2xl font-semibold text-gray-700 mb-6">Chef Details</h1>

    <div class="space-y-4 text-gray-800">
        <p><strong>Employee Name:</strong> {{ $item->employee->Name ?? 'N/A' }}</p>
        <p><strong>Specialty:</strong> {{ $item->Specialty }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('chefs.index') }}"
           class="inline-block bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition">
            ← Back to List
        </a>
    </div>
</div>
@endsection
