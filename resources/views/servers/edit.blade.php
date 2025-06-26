@extends('layout')

@section('content')
    <div style="max-width: 700px; margin: auto; padding: 20px;">
        <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">Edit Server Assignment</h1>

        <form method="POST" action="{{ route('servers.update', $server->Employee_ID) }}">
            @csrf
            @method('PUT')

            <label for="Employee_ID"><strong>Employee Name:</strong></label>
            <input type="text" disabled value="{{ $server->employee->Name ?? 'N/A' }}" 
                   style="display:block; width: 100%; padding: 8px; margin-bottom: 15px;" />

            <label for="Assigned_Section"><strong>Assigned Section:</strong></label>
            <input type="text" name="Assigned_Section" value="{{ $server->Assigned_Section }}" required
                   style="display:block; width: 100%; padding: 8px; margin-bottom: 15px;" />

            <button type="submit"
                    style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 4px;">
                Update
            </button>
        </form>
    </div>
@endsection
