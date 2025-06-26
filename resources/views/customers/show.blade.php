@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <a href="{{ route('customers.index') }}" class="text-sm text-blue-600 hover:underline block mb-4">
        ← Back to Customers
    </a>

    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Customer Details</h2>

    <div class="bg-white shadow-md rounded-lg p-6 space-y-4">
        <p><span class="font-medium text-gray-700">ID:</span> {{ $customer->Customer_ID }}</p>
        <p><span class="font-medium text-gray-700">Name:</span> {{ $customer->Name ?? 'N/A' }}</p>
        <p><span class="font-medium text-gray-700">Email:</span> {{ $customer->Email ?? 'N/A' }}</p>
        <p><span class="font-medium text-gray-700">Contact:</span> {{ $customer->Contact ?? 'N/A' }}</p>
    </div>
</div>
@endsection
