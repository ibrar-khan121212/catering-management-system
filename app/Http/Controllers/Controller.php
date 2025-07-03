<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Event;
use App\Models\Order;
use App\Models\Payment;
use App\Models\MenuItem;
use App\Models\InventoryItem;
use App\Models\Employee;
use App\Models\Chef;

abstract class Controller
{
    //
}

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'customers' => Customer::count(),
            'events' => Event::count(),
            'orders' => Order::count(),
            'payments' => Payment::count(),
            'menu_items' => MenuItem::count(),
            'inventory_items' => InventoryItem::count(),
            'employees' => Employee::count(),
            'chefs' => Chef::count(),
        ];
        return view('dashboard', compact('stats'));
    }
}
