@extends('layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">All Payments</h1>
    <a href="{{ route('payments.create') }}" class="text-blue-500 underline">Create New</a>

    <table border="1" class="w-full mt-4 border-collapse border border-gray-300">
        <tr>
            <th>ID</th>
            <th>Customer ID</th>
            <th>Order ID</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Method</th>
            <th>Actions</th>
        </tr>
        @foreach($payments as $payment)
        <tr>
            <td>{{ $payment->Payment_ID }}</td>
            <td>{{ $payment->Customer_ID }}</td>
            <td>{{ $payment->Order_ID }}</td>
            <td>{{ $payment->Payment_Date }}</td>
            <td>{{ $payment->Amount }}</td>
            <td>{{ $payment->Method }}</td>
            <td>
                <a href="{{ route('payments.show', ['payment' => $payment->Payment_ID]) }}">View</a> |
                <a href="{{ route('payments.edit', ['payment' => $payment->Payment_ID]) }}">Edit</a> |
                <form method="POST" action="{{ route('payments.destroy', ['payment' => $payment->Payment_ID]) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach

    </table>
@endsection
