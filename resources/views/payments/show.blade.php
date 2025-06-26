@extends('layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Payment Details</h1>
    <p><strong>Customer ID:</strong> {{ $payment->Customer_ID }}</p>
    <p><strong>Order ID:</strong> {{ $payment->Order_ID }}</p>
    <p><strong>Date:</strong> {{ $payment->Payment_Date }}</p>
    <p><strong>Amount:</strong> {{ $payment->Amount }}</p>
    <p><strong>Method:</strong> {{ $payment->Method }}</p>

    <a href="{{ route('payments.index') }}">Back</a>
@endsection
