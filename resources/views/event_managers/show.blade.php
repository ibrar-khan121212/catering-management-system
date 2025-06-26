@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Event Manager Details</h1>

        <div class="space-y-4">
            <div>
                <p class="text-gray-600"><strong class="font-medium text-gray-800">Employee ID:</strong> {{ $item->Employee_ID }}</p>
            </div>

            <div>
                <p class="text-gray-600"><strong class="font-medium text-gray-800">Name:</strong> {{ $item->employee->name ?? 'N/A' }}</p>
            </div>

            <div>
                <p class="text-gray-600"><strong class="font-medium text-gray-800">Managed Events Count:</strong> {{ $item->Managed_Events_Count }}</p>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('event_managers.index') }}"
               class="inline-block bg-gray-600 hover:bg-gray-700 text-white text-sm font-semibold py-2 px-4 rounded">
                ← Back to List
            </a>
        </div>
    </div>
</div>
@endsection
