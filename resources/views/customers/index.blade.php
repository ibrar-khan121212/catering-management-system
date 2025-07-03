@extends('layout')

@section('content')
    @if(session('success'))
        <div id="flash-message" class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow z-50">
            {{ session('success') }}
        </div>
    @endif
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white py-10 px-4">
        <div class="max-w-5xl mx-auto">
            <div class="flex justify-between mb-6">
                <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow mr-4">&larr; Back to Dashboard</a>
                <h1 class="text-2xl font-bold">Customers</h1>
                <button onclick="toggleDark()" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded shadow font-semibold transition">Toggle Dark Mode</button>
            </div>
            <a href="{{ route('customers.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow mb-4 inline-block">+ Add New Customer</a>
            <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded shadow">
                <table class="w-full mt-4 border-collapse rounded-lg overflow-hidden">
                    <thead class="bg-gray-200 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Phone</th>
                            <th class="px-4 py-2">Address</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-4 py-2">{{ $customer->Customer_ID }}</td>
                            <td class="px-4 py-2">{{ $customer->Name }}</td>
                            <td class="px-4 py-2">{{ $customer->Email }}</td>
                            <td class="px-4 py-2">{{ $customer->Phone }}</td>
                            <td class="px-4 py-2">{{ \Illuminate\Support\Str::limit($customer->Address, 50) }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('customers.show', $customer->Customer_ID) }}" class="text-blue-600 hover:underline">View</a>
                                <a href="{{ route('customers.edit', $customer->Customer_ID) }}" class="text-yellow-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('customers.destroy', $customer->Customer_ID) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
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
