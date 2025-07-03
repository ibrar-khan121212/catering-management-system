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
            <h1 class="text-2xl font-bold mb-6">Create New Order</h1>
            <form method="POST" action="{{ route('orders.store') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="Customer_ID" class="block text-sm font-medium">Customer</label>
                    <select name="Customer_ID" id="Customer_ID" required class="w-full border rounded p-2">
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->Customer_ID }}" {{ old('Customer_ID') == $customer->Customer_ID ? 'selected' : '' }}>
                                {{ $customer->Name }} - {{ $customer->Email }}
                            </option>
                        @endforeach
                    </select>
                    @error('Customer_ID') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="Event_ID" class="block text-sm font-medium">Event</label>
                    <select name="Event_ID" id="Event_ID" required class="w-full border rounded p-2">
                        <option value="">Select Event</option>
                        @foreach($events as $event)
                            <option value="{{ $event->Event_ID }}" {{ old('Event_ID') == $event->Event_ID ? 'selected' : '' }}>
                                {{ $event->Event_Name }} - {{ $event->Event_Date }}
                            </option>
                        @endforeach
                    </select>
                    @error('Event_ID') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="Order_Date" class="block text-sm font-medium">Order Date</label>
                    <input type="date" name="Order_Date" id="Order_Date" value="{{ old('Order_Date', date('Y-m-d')) }}" required class="w-full border rounded p-2">
                    @error('Order_Date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="Total_Amount" class="block text-sm font-medium">Total Amount</label>
                    <input type="number" step="0.01" name="Total_Amount" id="Total_Amount" value="{{ old('Total_Amount') }}" required class="w-full border rounded p-2">
                    @error('Total_Amount') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="Status" class="block text-sm font-medium">Status</label>
                    <select name="Status" id="Status" required class="w-full border rounded p-2">
                        <option value="Pending" {{ old('Status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Confirmed" {{ old('Status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="In Progress" {{ old('Status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ old('Status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ old('Status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('Status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded shadow">Create Order</button>
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
