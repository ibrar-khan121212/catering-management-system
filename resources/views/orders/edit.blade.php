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
            <h1 class="text-2xl font-bold mb-6">Edit Order</h1>
            
            {{-- Payment Information Display --}}
            @if($order->payments->count() > 0)
                <div class="mb-6 p-4 bg-green-50 dark:bg-green-900 rounded-lg">
                    <h3 class="text-lg font-semibold mb-3 text-green-800 dark:text-green-200">Payment Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Payment Amount</label>
                            <p class="text-xl font-bold text-green-600 dark:text-green-400">
                                ${{ number_format($order->payments->first()->Amount, 2) }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Payment Method</label>
                            <span class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm font-medium">
                                {{ $order->payments->first()->Method }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Payment Date</label>
                            <p class="text-lg">{{ \Carbon\Carbon::parse($order->payments->first()->Payment_Date)->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Payment ID</label>
                            <p class="text-lg">{{ $order->payments->first()->Payment_ID }}</p>
                        </div>
                    </div>
                    <div class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                        <p>💡 Payment information is managed separately. To update payment details, please use the <a href="{{ route('payments.edit', $order->payments->first()->Payment_ID) }}" class="text-blue-600 hover:underline">Payment Management</a> section.</p>
                    </div>
                </div>
            @else
                <div class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900 rounded-lg">
                    <h3 class="text-lg font-semibold mb-2 text-yellow-800 dark:text-yellow-200">No Payment Recorded</h3>
                    <p class="text-yellow-700 dark:text-yellow-300">This order does not have any payment information recorded yet.</p>
                </div>
            @endif
            
            <form method="POST" action="{{ route('orders.update', $order->Order_ID) }}" class="space-y-5">
                @csrf
                @method('PUT')
                <div>
                    <label for="Customer_ID" class="block text-sm font-medium">Customer</label>
                    <select name="Customer_ID" id="Customer_ID" required class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600">
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->Customer_ID }}" {{ old('Customer_ID', $order->Customer_ID) == $customer->Customer_ID ? 'selected' : '' }}>
                                {{ $customer->Name }} - {{ $customer->Email }}
                            </option>
                        @endforeach
                    </select>
                    @error('Customer_ID') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="Event_ID" class="block text-sm font-medium">Event</label>
                    <select name="Event_ID" id="Event_ID" required class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600">
                        <option value="">Select Event</option>
                        @foreach($events as $event)
                            <option value="{{ $event->Event_ID }}" {{ old('Event_ID', $order->Event_ID) == $event->Event_ID ? 'selected' : '' }}>
                                {{ $event->Event_Name }} - {{ $event->Event_Date }}
                            </option>
                        @endforeach
                    </select>
                    @error('Event_ID') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="Order_Date" class="block text-sm font-medium">Order Date</label>
                    <input type="date" name="Order_Date" id="Order_Date" value="{{ old('Order_Date', $order->Order_Date) }}" required class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600">
                    @error('Order_Date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="Status" class="block text-sm font-medium">Status</label>
                    <select name="Status" id="Status" required class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600">
                        <option value="Pending" {{ old('Status', $order->Status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Confirmed" {{ old('Status', $order->Status) == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="In Progress" {{ old('Status', $order->Status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ old('Status', $order->Status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ old('Status', $order->Status) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('Status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">Update Order</button>
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
