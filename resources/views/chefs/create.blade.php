@extends('layout')

@section('content')
<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow">
    <h1 class="text-2xl font-semibold text-gray-700 mb-6">Create Chef</h1>

    <form method="POST" action="{{ route('chefs.store') }}" class="space-y-5">
        @csrf

        {{-- Select Employee --}}
        <div>
            <label for="employee_id" class="block mb-1 font-medium text-gray-700">Employee</label>
            <select name="employee_id" id="employee_id" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                <option value="">-- Select Employee --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->Employee_ID }}">{{ $employee->Name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Specialty --}}
        <div>
            <label for="specialty" class="block mb-1 font-medium text-gray-700">Specialty</label>
            <input type="text" name="specialty" id="specialty" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
