@extends('layout')

@section('content')

{{-- Flash Messages --}}
@if(session('success'))
    <div id="alert-success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div id="alert-error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">All Customers</h1>
        <div class="space-x-2">
            <a href="{{ route('dashboard') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
               ← Dashboard
            </a>
            <a href="{{ route('customers.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
               + Create New
            </a>
        </div>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100 text-left text-gray-700 text-sm">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @foreach($customers as $item)
                <tr>
                    <td class="px-4 py-2">{{ $item->Customer_ID }}</td>
                    <td class="px-4 py-2">{{ $item->Name ?? 'N/A' }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('customers.show', $item->Customer_ID) }}" class="text-blue-500 hover:underline">View</a>
                        <a href="{{ route('customers.edit', $item->Customer_ID) }}" class="text-yellow-500 hover:underline">Edit</a>
                        <form action="{{ route('customers.destroy', $item->Customer_ID) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Auto-hide Flash Message Script --}}
<script>
    setTimeout(() => {
        const fadeOut = (el) => {
            if (!el) return;
            el.style.transition = 'opacity 0.5s ease';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        };

        fadeOut(document.getElementById('alert-success'));
        fadeOut(document.getElementById('alert-error'));
    }, 3000);
</script>

@endsection
