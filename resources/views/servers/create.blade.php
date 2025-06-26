@extends('layout')

@section('content')
    <div style="max-width: 700px; margin: auto; padding: 20px;">
        <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">Assign Server</h1>

        <form method="POST" action="{{ route('servers.store') }}">
            @csrf

            <label for="Employee_ID"><strong>Select Employee:</strong></label>
            <select name="Employee_ID" required
                    style="display:block; width: 100%; padding: 8px; margin-bottom: 15px;">
                <option value="">-- Choose Employee --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->Employee_ID }}">{{ $employee->Name }}</option>
                @endforeach
            </select>

            <label for="Assigned_Section"><strong>Assigned Section:</strong></label>
            <input type="text" name="Assigned_Section" required
                   style="display:block; width: 100%; padding: 8px; margin-bottom: 15px;" />

            <button type="submit"
                    style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px;">
                Save
            </button>
        </form>
    </div>
@endsection
