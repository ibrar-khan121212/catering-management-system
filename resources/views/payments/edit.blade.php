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
                <h1 class="text-2xl font-bold">Edit Payment</h1>
                <button onclick="toggleDark()" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded shadow font-semibold transition">Toggle Dark Mode</button>
            </div>
            <form method="POST" action="{{ route('payments.update', ['payment' => $payment->Payment_ID]) }}" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block font-semibold">Customer ID:</label>
                    <input type="number" name="Customer_ID" value="{{ old('Customer_ID', $payment->Customer_ID) }}" required class="w-full border rounded p-2">
                    @error('Customer_ID') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block font-semibold">Order ID:</label>
                    <input type="number" name="Order_ID" value="{{ old('Order_ID', $payment->Order_ID) }}" required class="w-full border rounded p-2">
                    @error('Order_ID') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block font-semibold">Payment Date:</label>
                    <input type="date" name="Payment_Date" value="{{ old('Payment_Date', $payment->Payment_Date) }}" required class="w-full border rounded p-2">
                    @error('Payment_Date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block font-semibold">Amount:</label>
                    <input type="number" step="0.01" name="Amount" value="{{ old('Amount', $payment->Amount) }}" required class="w-full border rounded p-2">
                    @error('Amount') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block font-semibold">Method:</label>
                    <input type="text" name="Method" value="{{ old('Method', $payment->Method) }}" required class="w-full border rounded p-2">
                    @error('Method') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">Update Payment</button>
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
