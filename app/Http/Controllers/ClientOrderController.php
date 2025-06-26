<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\MenuItem;
use App\Models\Customer;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ClientOrderController extends Controller
{
    // Show order form
    public function create()
    {
        $menuItems = MenuItem::all(['MenuItem_ID', 'Name', 'Price', 'Description']);

        return Inertia::render('Client/OrderCreate', [
            'menuItems' => $menuItems
        ]);
    }

    // Store order
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name'      => 'required|string|max:100',
            'customer_email'     => 'required|email',
            'customer_contact'   => 'required|string|max:15',
            'event_type'         => 'required|string|max:50',
            'event_date'         => 'required|date',
            'event_location'     => 'required|string|max:100',
            'menu_items'         => 'required|array|min:1',
            'menu_items.*.id'    => 'required|integer|exists:menu_items,MenuItem_ID',
            'menu_items.*.qty'   => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            // 1. Create or find the customer
            $customer = Customer::firstOrCreate(
                ['Email' => $data['customer_email']],
                [
                    'Name' => $data['customer_name'],
                    'Contact' => $data['customer_contact'],
                ]
            );

            // 2. Create the event
            $event = Event::create([
                'Event_Type'     => $data['event_type'],
                'Date'           => $data['event_date'],
                'Location'       => $data['event_location'],
                'Client_Contact' => $data['customer_contact'],
            ]);

            // 3. Create the order
            $order = Order::create([
                'Customer_ID' => $customer->Customer_ID,
                'Event_ID'    => $event->Event_ID,
                'Order_Date'  => now(),
                'Status'      => 'pending',
            ]);

            // 4. Attach menu items via pivot table
            foreach ($data['menu_items'] as $item) {
                DB::table('order_menuitem')->insert([
                    'Order_ID'      => $order->Order_ID,
                    'MenuItem_ID'   => $item['id'],
                    'Quantity'      => $item['qty'],
                    'Special_Notes' => '',
                ]);
            }

            DB::commit();

            return redirect()->route('client/order/create')
                ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Something went wrong. Please try again.']);
        }
    }
}
