@extends('layout')

@section('content')
    <div style="max-width: 900px; margin: auto; padding: 20px;">
        <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">All Servers</h1>

        <a href="{{ route('servers.create') }}"
           style="padding: 8px 16px; background-color: #28a745; color: white; text-decoration: none; border-radius: 4px;">
            + Create New
        </a>

        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 20px; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f8f9fa;">
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Assigned Section</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($servers as $item)
                    <tr>
                        <td>{{ $item->Employee_ID }}</td>
                        <td>{{ $item->employee->Name ?? 'N/A' }}</td>
                        <td>{{ $item->Assigned_Section }}</td>
                        <td>
                            <a href="{{ route('servers.show', $item->Employee_ID) }}">View</a> |
                            <a href="{{ route('servers.edit', $item->Employee_ID) }}">Edit</a> |
                            <form method="POST" action="{{ route('servers.destroy', $item->Employee_ID) }}" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
