<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Event_Type' => 'required|string|max:50',
            'Date' => 'required|date',
            'Location' => 'required|string|max:100',
            'Client_Contact' => 'required|string|max:15',
        ]);

        Event::create($request->only('Event_Type', 'Date', 'Location', 'Client_Contact'));

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Event_Type' => 'required|string|max:50',
            'Date' => 'required|date',
            'Location' => 'required|string|max:100',
            'Client_Contact' => 'required|string|max:15',
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->only('Event_Type', 'Date', 'Location', 'Client_Contact'));

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        try {
            Event::destroy($id);
            return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('events.index')->with('error', 'Cannot delete event. It may be linked to other data.');
        }
    }
}
