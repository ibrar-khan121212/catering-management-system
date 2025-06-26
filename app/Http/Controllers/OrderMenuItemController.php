<?php

namespace App\Http\Controllers;

use App\Models\OrderMenuitem;
use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class OrderMenuitemController extends Controller
{
    public function index()
    {
        $items = OrderMenuitem::with(['order', 'menuItem'])->get();
        return view('order_menuitem.index', compact('items'));
    }

    public function create()
    {
        $orders = Order::all();
        $menuItems = MenuItem::all();
        return view('order_menuitem.create', compact('orders', 'menuItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Order_ID' => 'required|exists:orders,Order_ID',
            'MenuItem_ID' => 'required|exists:menu_items,MenuItem_ID',
            'Quantity' => 'required|integer|min:1',
            'Special_Notes' => 'nullable|string',
        ]);

        OrderMenuitem::create($request->all());
        return redirect()->route('order_menuitem.index')->with('success', 'Item added successfully.');
    }

    public function show(OrderMenuitem $order_menuitem)
    {
        return view('order_menuitem.show', compact('order_menuitem'));
    }

    public function edit(OrderMenuitem $order_menuitem)
    {
        $orders = Order::all();
        $menuItems = MenuItem::all();
        return view('order_menuitem.edit', compact('order_menuitem', 'orders', 'menuItems'));
    }

    public function update(Request $request, OrderMenuitem $order_menuitem)
    {
        $request->validate([
            'Order_ID' => 'required|exists:orders,Order_ID',
            'MenuItem_ID' => 'required|exists:menu_items,MenuItem_ID',
            'Quantity' => 'required|integer|min:1',
            'Special_Notes' => 'nullable|string',
        ]);

        $order_menuitem->update($request->all());
        return redirect()->route('order_menuitem.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(OrderMenuitem $order_menuitem)
    {
        $order_menuitem->delete();
        return redirect()->route('order_menuitem.index')->with('success', 'Item deleted.');
    }
}
