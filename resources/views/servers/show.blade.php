@extends('layout')

@section('content')
    <div style="max-width: 700px; margin: auto; padding: 20px;">
        <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">Server Details</h1>

        <p><strong>Employee ID:</strong> {{ $server->Employee_ID }}</p>
        <p><strong>Name:</strong> {{ $server->employee->Name ?? 'N/A' }}</p>
        <p><strong>Assigned Section:</strong> {{ $server->Assigned_Section }}</p>

        <a href="{{ route('servers.index') }}"
           style="padding: 8px 16px; background-color: #007bff; color: white; text-decoration: none; border-radius: 4px;">
            Back to List
        </a>
    </div>
@endsection
