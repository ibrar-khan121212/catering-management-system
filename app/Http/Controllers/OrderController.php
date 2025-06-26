<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Event;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Load customer and event relationships for readable display
        $orders = Order::with(['customer', 'event'])->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        // Send all customers and events for dropdowns in the form
        $customers = Customer::all();
        $events = Event::all();
        return view('orders.create', compact('customers', 'events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Customer_ID' => 'required|integer|exists:customers,Customer_ID',
            'Event_ID' => 'required|integer|exists:events,Event_ID',
            'Order_Date' => 'required|date',
            'Status' => 'required|string|max:50',
        ]);

        Order::create($request->only('Customer_ID', 'Event_ID', 'Order_Date', 'Status'));

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function show($id)
    {
        // Use consistent variable name: $order
        $order = Order::with(['customer', 'event'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::with(['customer', 'event'])->findOrFail($id);
        $customers = Customer::all();
        $events = Event::all();
        return view('orders.edit', compact('order', 'customers', 'events'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Customer_ID' => 'required|integer|exists:customers,Customer_ID',
            'Event_ID' => 'required|integer|exists:events,Event_ID',
            'Order_Date' => 'required|date',
            'Status' => 'required|string|max:50',
        ]);

        $order = Order::findOrFail($id);
        $order->update($request->only('Customer_ID', 'Event_ID', 'Order_Date', 'Status'));

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        $order = Order::with(['menuItems', 'payments'])->findOrFail($id);

        // Detach related menu items from pivot table
        $order->menuItems()->detach();

        // Delete related payments
        foreach ($order->payments as $payment) {
            $payment->delete();
        }

        // Now delete the order
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

}
