<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;
use App\Models\Employee;

class ServerController extends Controller
{
    public function index()
    {
        $data = Server::all();
        return view('servers.index', ['servers' => $data]);
    }

    public function create()
    {
        $employees = Employee::all();
        return view('servers.create', compact('employees'));
    }

    public function store(Request $request)
    {
        Server::create($request->all());
        return redirect()->route('servers.index');
    }

    public function show($id)
    {
        $server = Server::with('employee')->findOrFail($id);
        return view('servers.show', compact('server'));
    }


    public function edit($id)
    {
        $server = Server::with('employee')->findOrFail($id);
        return view('servers.edit', compact('server'));
    }

    public function update(Request $request, $id)
    {
        $item = Server::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('servers.index');
    }

    public function destroy($id)
    {
        Server::destroy($id);
        return redirect()->route('servers.index');
    }
}
