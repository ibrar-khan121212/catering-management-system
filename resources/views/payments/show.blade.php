@extends('layout')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white py-10 px-4 flex flex-col items-center">
        <div class="max-w-lg w-full bg-white dark:bg-gray-800 shadow rounded-lg p-8">
            <div class="flex justify-between mb-6">
                <h1 class="text-2xl font-bold">Payment Details</h1>
                <button onclick="toggleDark()" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded shadow font-semibold transition">Toggle Dark Mode</button>
            </div>
            
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg dark:bg-green-900 dark:text-green-200">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="space-y-4">
                <div class="bg-blue-50 dark:bg-blue-900 p-4 rounded-lg">
                    <h3 class="font-semibold text-blue-800 dark:text-blue-200 mb-2">Customer Information</h3>
                    <p class="text-lg font-bold">{{ $payment->customer->Name ?? 'N/A' }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Customer ID: {{ $payment->Customer_ID }}</p>
                </div>
                
                <div class="bg-green-50 dark:bg-green-900 p-4 rounded-lg">
                    <h3 class="font-semibold text-green-800 dark:text-green-200 mb-2">Payment Amount</h3>
                    <p class="text-2xl font-bold text-green-600 dark:text-green-400">${{ number_format($payment->Amount, 2) }}</p>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Order ID</label>
                        <p class="font-semibold">{{ $payment->Order_ID }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Payment Date</label>
                        <p class="font-semibold">{{ \Carbon\Carbon::parse($payment->Payment_Date)->format('M d, Y') }}</p>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Payment Method</label>
                    <span class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm font-medium">
                        {{ $payment->Method }}
                    </span>
                </div>
            </div>
            
            <div class="mt-8 flex justify-between">
                <a href="{{ route('payments.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded shadow transition">← Back to List</a>
                <a href="{{ route('payments.edit', ['payment' => $payment->Payment_ID]) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded shadow transition">Edit Payment</a>
            </div>
        </div>
    </div>
    <script>
        if(localStorage.getItem('theme') === 'dark') document.documentElement.classList.add('dark');
        function toggleDark() {
            const root = document.documentElement;
            const isDark = root.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }
    </script>
@endsection
