@extends('layout')

@section('content')
<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow">
    <h1 class="text-2xl font-semibold text-gray-700 mb-6">Edit Chef</h1>

    <form method="POST" action="{{ route('chefs.update', $item->Employee_ID) }}" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Employee Name (Read Only) --}}
        <div>
            <label class="block mb-1 font-medium text-gray-700">Employee Name</label>
            <input type="text" value="{{ $item->employee->Name ?? 'N/A' }}" readonly
                   class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-gray-600 cursor-not-allowed">
        </div>

        {{-- Specialty (Editable) --}}
        <div>
            <label for="specialty" class="block mb-1 font-medium text-gray-700">Specialty</label>
            <input type="text" name="specialty" id="specialty" value="{{ $item->Specialty }}" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection

