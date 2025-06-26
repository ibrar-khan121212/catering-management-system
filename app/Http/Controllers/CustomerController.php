<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $data = Customer::all();
        return view('customers.index', ['customers' => $data]);
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required|string|max:100',
            'Email' => 'required|email|max:100',
            'Contact' => 'required|string|max:15',
        ]);

        Customer::create($request->only('Name', 'Email', 'Contact'));

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }



    
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.show', compact('customer'));
    }


    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        try {
            Customer::destroy($id);
            return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
        } catch (QueryException $e) {
            return redirect()->route('customers.index')
                ->with('error', 'Cannot delete: This customer has related orders.');
        }
    }
}
