@extends('layout')

@section('content')
<div class="max-w-xl mx-auto px-4 py-10">
    <a href="{{ route('orders.index') }}" class="text-sm text-blue-600 hover:underline block mb-4">
        ← Back to Orders
    </a>

    <h2 class="text-2xl font-bold mb-6">Create New Order</h2>

    <form action="{{ route('orders.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded shadow">
        @csrf

        <div>
            <label for="Customer_ID" class="block text-sm font-medium text-gray-700">Customer</label>
            <select name="Customer_ID" id="Customer_ID" class="mt-1 block w-full border-gray-300 rounded-md">
                @foreach($customers as $customer)
                    <option value="{{ $customer->Customer_ID }}">{{ $customer->Name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="Event_ID" class="block text-sm font-medium text-gray-700">Event</label>
            <select name="Event_ID" id="Event_ID" class="mt-1 block w-full border-gray-300 rounded-md">
                @foreach($events as $event)
                    <option value="{{ $event->Event_ID }}">{{ $event->Event_Type }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="Order_Date" class="block text-sm font-medium text-gray-700">Order Date</label>
            <input type="date" name="Order_Date" id="Order_Date" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>

        <div>
            <label for="Status" class="block text-sm font-medium text-gray-700">Status</label>
            <input type="text" name="Status" id="Status" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create</button>
    </form>
</div>
@endsection
