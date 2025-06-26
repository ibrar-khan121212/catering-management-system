<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index()
    {
        $data = MenuItem::all();
        return view('menu_items.index', ['menu_items' => $data]);
    }

    public function create()
    {
        return view('menu_items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required|string|max:100',
            'Price' => 'required|numeric|min:0',
            'Description' => 'required|string',
        ]);

        MenuItem::create($request->only('Name', 'Price', 'Description'));

        return redirect()->route('menu_items.index')->with('success', 'Menu item added successfully.');
    }
    public function show($id)
    {
        $item = MenuItem::findOrFail($id);
        return view('menu_items.show', compact('item'));
    }


    public function edit($id)
    {
        $item = MenuItem::findOrFail($id);
        return view('menu_items.edit', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Name' => 'required|string|max:100',
            'Price' => 'required|numeric|min:0',
            'Description' => 'required|string',
        ]);

        $item = MenuItem::findOrFail($id);
        $item->update($request->only('Name', 'Price', 'Description'));

        return redirect()->route('menu_items.index')->with('success', 'Menu item updated successfully.');
    }
    public function destroy($id)
    {
        MenuItem::destroy($id);
        return redirect()->route('menu_items.index');
    }
}
