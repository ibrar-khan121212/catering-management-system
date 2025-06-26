<?php

namespace App\Http\Controllers;

use App\Models\EventManager;
use Illuminate\Http\Request;

class EventManagerController extends Controller
{
    public function index()
    {
        $data = EventManager::all();
        return view('event_managers.index', ['event_managers' => $data]);
    }

    public function create()
    {
        return view('event_managers.create');
    }

    public function store(Request $request)
    {
        EventManager::create($request->all());
        return redirect()->route('event_managers.index');
    }

    public function show($id)
    {
        $item = EventManager::findOrFail($id);
        return view('event_managers.show', ['item' => $item]);
    }

    public function edit($id)
{
    $item = EventManager::findOrFail($id);
    return view('event_managers.edit', compact('item'));
}

    public function update(Request $request, $id)
    {
        $item = EventManager::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('event_managers.index');
    }

    public function destroy($id)
    {
        EventManager::destroy($id);
        return redirect()->route('event_managers.index');
    }
}
