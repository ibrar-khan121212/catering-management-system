<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all(); // Removed pagination
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        return view('payments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Customer_ID'   => 'required|integer|exists:customers,Customer_ID',
            'Order_ID'      => 'required|integer|exists:orders,Order_ID',
            'Payment_Date'  => 'required|date',
            'Amount'        => 'required|numeric|min:0',
            'Method'        => 'required|string|max:50',
        ]);

        Payment::create($validated);

        return redirect()->route('payments.index')->with('success', 'Payment created successfully.');
    }

    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'Customer_ID'   => 'required|integer|exists:customers,Customer_ID',
            'Order_ID'      => 'required|integer|exists:orders,Order_ID',
            'Payment_Date'  => 'required|date',
            'Amount'        => 'required|numeric|min:0',
            'Method'        => 'required|string|max:50',
        ]);

        $payment->update($validated);

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }
}
