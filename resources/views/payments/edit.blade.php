@extends('layout')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Payment</h1>

    <form method="POST" action="{{ route('payments.update', ['payment' => $payment->Payment_ID]) }}" class="space-y-4 max-w-lg">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Customer ID:</label>
            <input type="number" name="Customer_ID" value="{{ $payment->Customer_ID }}" required class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold">Order ID:</label>
            <input type="number" name="Order_ID" value="{{ $payment->Order_ID }}" required class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold">Payment Date:</label>
            <input type="date" name="Payment_Date" value="{{ $payment->Payment_Date }}" required class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold">Amount:</label>
            <input type="number" step="0.01" name="Amount" value="{{ $payment->Amount }}" required class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold">Method:</label>
            <input type="text" name="Method" value="{{ $payment->Method }}" required class="w-full border rounded p-2">
        </div>

        <div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Update Payment
            </button>
        </div>
    </form>
@endsection
