<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    public function index()
    {
        $data = InventoryItem::all();
        return view('inventory_items.index', ['inventory_items' => $data]);
    }

    public function create()
    {
        return view('inventory_items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required|string|max:100',
            'Unit' => 'required|string|max:20',
            'Quantity_Available' => 'required|integer|min:0',
        ]);

        InventoryItem::create($request->only('Name', 'Unit', 'Quantity_Available'));

        return redirect()->route('inventory_items.index')->with('success', 'Item added successfully!');
    }


    public function show($id)
    {
        $item = InventoryItem::findOrFail($id);
        return view('inventory_items.show', ['item' => $item]);
    }

    public function edit($id)
    {
        $item = InventoryItem::findOrFail($id);
        return view('inventory_items.edit', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Name' => 'required|string|max:100',
            'Unit' => 'required|string|max:20',
            'Quantity_Available' => 'required|integer|min:0',
        ]);

        $item = InventoryItem::findOrFail($id);
        $item->update($request->only('Name', 'Unit', 'Quantity_Available'));

        return redirect()->route('inventory_items.index')->with('success', 'Item updated successfully!');
    }

    public function destroy($id)
    {
        InventoryItem::destroy($id);
        return redirect()->route('inventory_items.index');
    }
}
