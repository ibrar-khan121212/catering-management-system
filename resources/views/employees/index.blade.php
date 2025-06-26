@extends('layout')

@section('content')
    <div style="max-width: 900px; margin: auto; padding: 20px;">
        <h1 style="font-size: 28px; font-weight: bold; margin-bottom: 20px;">All Employees</h1>
        <a href="{{ route('employees.create') }}" 
           style="display: inline-block; margin-bottom: 20px; padding: 10px 15px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">
           + Add New Employee
        </a>

        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead style="background-color: #f2f2f2;">
                <tr>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">ID</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Name</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Contact</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Salary</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $item)
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $item->Employee_ID }}</td>
                    <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $item->Name }}</td>
                    <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $item->Contact }}</td>
                    <td style="padding: 10px; border-bottom: 1px solid #eee;">${{ number_format($item->Salary, 2) }}</td>
                    <td style="padding: 10px; border-bottom: 1px solid #eee;">
                        <a href="{{ route('employees.show', $item->Employee_ID) }}" style="color: blue; margin-right: 10px;">View</a>
                        <a href="{{ route('employees.edit', $item->Employee_ID) }}" style="color: orange; margin-right: 10px;">Edit</a>
                        <form method="POST" action="{{ route('employees.destroy', $item->Employee_ID) }}" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" 
                                    style="color: red; background: none; border: none; cursor: pointer;">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
