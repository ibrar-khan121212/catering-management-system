<?php
// app/Http/Controllers/EmployeeEventController.php

namespace App\Http\Controllers;

use App\Models\EmployeeEvent;
use App\Models\Employee;
use App\Models\Event;
use Illuminate\Http\Request;

class EmployeeEventController extends Controller
{
    public function index()
    {
        $employee_events = EmployeeEvent::with(['employee', 'event'])->get();
        return view('employee_events.index', compact('employee_events'));
    }

    public function create()
    {
        $employees = Employee::all();
        $events = Event::all();
        return view('employee_events.create', compact('employees', 'events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Employee_ID' => 'required|exists:employees,Employee_ID',
            'Event_ID' => 'required|exists:events,Event_ID',
            'Role_in_Event' => 'required|string|max:50',
            'Shift_Time' => 'required|string|max:20',
        ]);

        EmployeeEvent::create($request->all());
        return redirect()->route('employee_events.index')->with('success', 'Record added.');
    }

    public function show(EmployeeEvent $employee_event)
    {
        return view('employee_events.show', compact('employee_event'));
    }

    public function edit(EmployeeEvent $employee_event)
    {
        $employees = Employee::all();
        $events = Event::all();
        return view('employee_events.edit', compact('employee_event', 'employees', 'events'));
    }

    public function update(Request $request, EmployeeEvent $employee_event)
    {
        $request->validate([
            'Employee_ID' => 'required|exists:employees,Employee_ID',
            'Event_ID' => 'required|exists:events,Event_ID',
            'Role_in_Event' => 'required|string|max:50',
            'Shift_Time' => 'required|string|max:20',
        ]);

        $employee_event->update($request->all());
        return redirect()->route('employee_events.index')->with('success', 'Record updated.');
    }

    public function destroy(EmployeeEvent $employee_event)
    {
        $employee_event->delete();
        return redirect()->route('employee_events.index')->with('success', 'Record deleted.');
    }
}
