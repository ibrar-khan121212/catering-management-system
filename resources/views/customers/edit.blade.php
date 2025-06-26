@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <a href="{{ route('customers.index') }}" class="text-sm text-blue-600 hover:underline block mb-4">
        ← Back to Customers
    </a>

    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Customer</h2>

    <form action="{{ route('customers.update', $customer->Customer_ID) }}" method="POST"
          class="space-y-6 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div>
            <label for="Name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="Name" id="Name" value="{{ $customer->Name }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                   required>
        </div>

        <div>
            <label for="Email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="Email" id="Email" value="{{ $customer->Email }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
        </div>

        <div>
            <label for="Contact" class="block text-sm font-medium text-gray-700">Contact</label>
            <input type="text" name="Contact" id="Contact" value="{{ $customer->Contact }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
        </div>

        <div>
            <button type="submit"
                    class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
