@extends('layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Create Payment</h1>
    <form method="POST" action="{{ route('payments.store') }}">
        @csrf
        <label>Customer ID:</label>
        <input type="number" name="Customer_ID" required><br><br>

        <label>Order ID:</label>
        <input type="number" name="Order_ID" required><br><br>

        <label>Payment Date:</label>
        <input type="date" name="Payment_Date" required><br><br>

        <label>Amount:</label>
        <input type="number" step="0.01" name="Amount" required><br><br>

        <label>Method:</label>
        <input type="text" name="Method" required><br><br>

        <button type="submit">Save</button>
    </form>
@endsection
