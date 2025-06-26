<?php

namespace App\Http\Controllers;

use App\Models\MenuItemInventoryItem;
use App\Models\MenuItem;
use App\Models\InventoryItem;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MenuItemInventoryItemController extends Controller
{
   public function index(): View
    {
        $items = MenuItemInventoryItem::with(['menuItem', 'inventoryItem'])->get();
        return view('menuitem_inventoryitem.index', compact('items'));
    }

    public function create(): View
    {
        return view('menuitem_inventoryitem.create', [
            'menuItems' => MenuItem::all(),
            'inventoryItems' => InventoryItem::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'MenuItem_ID' => 'required|exists:menu_items,MenuItem_ID',
            'Inventory_ID' => 'required|exists:inventory_items,Inventory_ID',
            'Quantity_Required' => 'required|integer|min:1',
        ]);

        MenuItemInventoryItem::create($validated);

        return redirect()
            ->route('menuitem_inventoryitem.index')
            ->with('success', 'Record added successfully.');
    }

    public function show(MenuItemInventoryItem $menuitem_inventoryitem): View
    {
        return view('menuitem_inventoryitem.show', compact('menuitem_inventoryitem'));
    }

    public function edit(MenuItemInventoryItem $menuitem_inventoryitem): View
    {
        return view('menuitem_inventoryitem.edit', [
            'menuitem_inventoryitem' => $menuitem_inventoryitem,
            'menuItems' => MenuItem::all(),
            'inventoryItems' => InventoryItem::all(),
        ]);
    }

    public function update(Request $request, MenuItemInventoryItem $menuitem_inventoryitem): RedirectResponse
    {
        $validated = $request->validate([
            'MenuItem_ID' => 'required|exists:menu_items,MenuItem_ID',
            'Inventory_ID' => 'required|exists:inventory_items,Inventory_ID',
            'Quantity_Required' => 'required|integer|min:1',
        ]);

        $menuitem_inventoryitem->update($validated);

        return redirect()
            ->route('menuitem_inventoryitem.index')
            ->with('success', 'Record updated successfully.');
    }

    public function destroy(MenuItemInventoryItem $menuitem_inventoryitem): RedirectResponse
    {
        $menuitem_inventoryitem->delete();

        return redirect()
            ->route('menuitem_inventoryitem.index')
            ->with('success', 'Record deleted successfully.');
    }
}
