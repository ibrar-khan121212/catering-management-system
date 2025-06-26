@extends('layout')

@section('content')
    <div style="max-width: 600px; margin: auto; padding: 20px;">
        <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">Employee Details</h1>

        <p><strong>ID:</strong> {{ $item->Employee_ID }}</p>
        <p><strong>Name:</strong> {{ $item->Name }}</p>
        <p><strong>Contact:</strong> {{ $item->Contact }}</p>
        <p><strong>Salary:</strong> ${{ number_format($item->Salary, 2) }}</p>

        <a href="{{ route('employees.index') }}" 
           style="display: inline-block; margin-top: 20px; padding: 10px 15px; background-color: #3490dc; color: white; text-decoration: none; border-radius: 5px;">
            ← Back to Employees
        </a>
    </div>
@endsection
