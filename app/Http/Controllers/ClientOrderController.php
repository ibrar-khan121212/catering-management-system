<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\MenuItem;
use App\Models\Customer;
use App\Models\Event;
use App\Models\OrderMenuItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientOrderController extends Controller
{
    // Show the order form
    public function create()
    {
        $user = auth()->user();

        if (!$user || $user->is_admin) {
            abort(403, 'Only customers can place orders.');
        }

        $customer = Customer::firstOrCreate(
            ['Email' => $user->email],
            ['Name' => $user->name, 'Contact' => '']
        );

        $menuItems = MenuItem::all();

        return view('client_order_create', compact('customer', 'menuItems'));
    }

    // Store the order
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,Customer_ID',
            'contact' => 'nullable|string|max:15',
            'event_type' => 'required|string|max:100',
            'event_date' => 'required|date',
            'event_location' => 'required|string|max:255',
            'client_contact' => 'required|string|max:100',
            'order_date' => 'required|date',
            'menu_items' => 'required|array|min:1',
            'menu_items.*.id' => 'required|exists:menu_items,MenuItem_ID',
            'menu_items.*.qty' => 'required|integer|min:1',
            'payment_method' => 'required|string|max:50',
            'payment_date' => 'required|date',
            'payment_amount' => 'required|numeric|min:0',
        ]);

        // Ensure authenticated customer is the one submitting
        $authCustomerId = Customer::where('Email', auth()->user()->email)->value('Customer_ID');
        if ((int)$validated['customer_id'] !== (int)$authCustomerId) {
            abort(403, 'Unauthorized action.');
        }

        DB::beginTransaction();

        try {
            // Update contact if provided
            if ($request->filled('contact')) {
                $customer = Customer::find($validated['customer_id']);
                $customer->Contact = $request->input('contact');
                $customer->save();
            }

            // Create the new event
            $event = Event::create([
                'Event_Type'     => $validated['event_type'],
                'Date'           => $validated['event_date'],
                'Location'       => $validated['event_location'],
                'Client_Contact' => $validated['client_contact'],
            ]);

            // Create the order
            $order = Order::create([
                'Customer_ID' => $validated['customer_id'],
                'Event_ID'    => $event->Event_ID,
                'Order_Date'  => $validated['order_date'],
                'Status'      => 'Pending',
            ]);

            // Link menu items to order
            foreach ($validated['menu_items'] as $item) {
                OrderMenuItem::create([
                    'Order_ID'     => $order->Order_ID,
                    'MenuItem_ID'  => $item['id'],
                    'Quantity'     => $item['qty'],
                    'Special_Notes' => null,
                ]);
            }

            // Create the payment record
            Payment::create([
                'Customer_ID' => $validated['customer_id'],
                'Order_ID' => $order->Order_ID,
                'Payment_Date' => $validated['payment_date'],
                'Amount' => $validated['payment_amount'],
                'Method' => $validated['payment_method'],
            ]);

            DB::commit();

            return redirect()
                ->route('client.orders.create')
                ->with('success', 'Order placed successfully with payment information!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'Failed to place order: ' . $e->getMessage()])
                ->withInput();
        }
    }
}
