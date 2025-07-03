<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Event;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Admin: View all orders
    public function index()
    {
        $orders = Order::with(['customer', 'event'])->get();
        return view('orders.index', compact('orders'));
    }

    // Admin: Show order creation form
    public function create()
    {
        $customers = Customer::all();
        $events = Event::all();
        return view('orders.create', compact('customers', 'events'));
    }

    // Admin: Store a new order
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

    // Admin: Show single order
    public function show($id)
    {
        $order = Order::with(['customer', 'event'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    // Admin: Show order edit form
    public function edit($id)
    {
        $order = Order::with(['customer', 'event'])->findOrFail($id);
        $customers = Customer::all();
        $events = Event::all();
        return view('orders.edit', compact('order', 'customers', 'events'));
    }

    // Admin: Update order
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

    // Admin: Delete an order
    public function destroy($id)
    {
        $order = Order::with(['menuItems', 'payments'])->findOrFail($id);

        // Detach related menu items
        $order->menuItems()->detach();

        // Delete related payments
        foreach ($order->payments as $payment) {
            $payment->delete();
        }

        // Delete the order itself
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    // Customer: View only their own orders (matched via email)
    public function myOrders()
    {
        $user = auth()->user();

        // Match logged-in user to customer via email
        $customer = Customer::where('Email', $user->email)->first();

        $orders = $customer
            ? Order::where('Customer_ID', $customer->Customer_ID)
                ->with('event')
                ->get()
            : collect(); // empty if no matching customer

        return view('orders.my', compact('orders'));
    }
}
