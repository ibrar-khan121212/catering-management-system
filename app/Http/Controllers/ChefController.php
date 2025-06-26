<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use App\Models\Employee;
use Illuminate\Http\Request;



class ChefController extends Controller
{
    public function index()
    {
        $data = Chef::all();
        return view('chefs.index', ['chefs' => $data]);
    }

    public function create()
    {
        $employees = Employee::all();
        return view('chefs.create', compact('employees'));
    }


    public function store(Request $request)
    {
        Chef::create($request->all());
        return redirect()->route('chefs.index');
    }

    public function show($id)
        {
            $item = Chef::with('employee')->findOrFail($id);
            return view('chefs.show', compact('item'));
        }


    public function edit($id)
    {
        $item = Chef::with('employee')->findOrFail($id);
        return view('chefs.edit', compact('item'));
    }


    public function update(Request $request, $id)
    {
        $item = Chef::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('chefs.index');
    }

    public function destroy($id)
    {
        Chef::destroy($id);
        return redirect()->route('chefs.index');
    }
}
