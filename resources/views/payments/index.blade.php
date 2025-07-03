@extends('layout')

@section('content')
    @if(session('success'))
        <div id="flash-message" class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow z-50">
            {{ session('success') }}
        </div>
    @endif
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white py-10 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between mb-6">
                <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow mr-4">&larr; Back to Dashboard</a>
                <h1 class="text-2xl font-bold">All Payments</h1>
                <button onclick="toggleDark()" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded shadow font-semibold transition">Toggle Dark Mode</button>
            </div>
            <a href="{{ route('payments.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow mb-4 inline-block">+ Create New</a>
            <div class="overflow-x-auto">
                <table class="w-full mt-4 border-collapse rounded-lg overflow-hidden">
                    <thead class="bg-gray-200 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2">Payment ID</th>
                            <th class="px-4 py-2">Customer Name</th>
                            <th class="px-4 py-2">Order ID</th>
                            <th class="px-4 py-2">Payment Date</th>
                            <th class="px-4 py-2">Amount</th>
                            <th class="px-4 py-2">Payment Method</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
                            <td class="px-4 py-2 font-semibold">{{ $payment->Payment_ID }}</td>
                            <td class="px-4 py-2">
                                <div class="font-medium">{{ $payment->customer->Name ?? 'N/A' }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">ID: {{ $payment->Customer_ID }}</div>
                            </td>
                            <td class="px-4 py-2">{{ $payment->Order_ID }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($payment->Payment_Date)->format('M d, Y') }}</td>
                            <td class="px-4 py-2 font-bold text-green-600 dark:text-green-400">${{ number_format($payment->Amount, 2) }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm font-medium">
                                    {{ $payment->Method }}
                                </span>
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('payments.show', ['payment' => $payment->Payment_ID]) }}" class="text-blue-600 hover:underline font-medium">View</a>
                                <a href="{{ route('payments.edit', ['payment' => $payment->Payment_ID]) }}" class="text-yellow-600 hover:underline font-medium">Edit</a>
                                <form method="POST" action="{{ route('payments.destroy', ['payment' => $payment->Payment_ID]) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline font-medium" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
        const flash = document.getElementById('flash-message');
        if (flash) setTimeout(() => flash.remove(), 2000);
    </script>
@endsection
