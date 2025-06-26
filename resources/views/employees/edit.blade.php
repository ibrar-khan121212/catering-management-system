@extends('layout')

@section('content')
    <div style="max-width: 600px; margin: auto; padding: 20px;">
        <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">Edit Employee</h1>

        <form method="POST" action="{{ route('employees.update', $item->Employee_ID) }}">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 15px;">
                <label for="Name">Name:</label><br>
                <input type="text" name="Name" id="Name" value="{{ $item->Name }}" required
                       style="width: 100%; padding: 8px; margin-top: 5px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="Contact">Contact:</label><br>
                <input type="text" name="Contact" id="Contact" value="{{ $item->Contact }}" required
                       style="width: 100%; padding: 8px; margin-top: 5px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="Salary">Salary:</label><br>
                <input type="number" name="Salary" id="Salary" step="0.01" value="{{ $item->Salary }}" required
                       style="width: 100%; padding: 8px; margin-top: 5px;">
            </div>

            <button type="submit"
                    style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px;">
                Update
            </button>
        </form>
    </div>
@endsection
