@extends('layout')

@section('content')
{{-- Success Flash Message --}}
@if(session('success'))
    <div id="flash-message" class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow z-50">
        {{ session('success') }}
    </div>
@endif

<div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white py-10 px-4">
    <div class="max-w-7xl mx-auto mb-8 flex justify-between">
        <a href="{{ route('home') }}" class="text-blue-600 hover:underline dark:text-blue-400 text-lg font-semibold dark:bg-gray-800 px-4 py-2 rounded shadow">
            ← Home
        </a>
        <button onclick="toggleDark()" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded shadow font-semibold transition">
            Toggle Dark Mode
        </button>
    </div>

    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Place Your Order</h1>
        <p class="mb-6 text-center text-gray-600 dark:text-gray-300">Only logged-in customers can place orders. Your information is shown below.</p>

        <form method="POST" action="{{ route('client.orders.store') }}">
            @csrf

            {{-- Hidden customer_id --}}
            <input type="hidden" name="customer_id" value="{{ $customer->Customer_ID }}">

            {{-- Show customer info --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Customer:</label>
                <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded">
                    {{ $customer->Name }} ({{ $customer->Email }})
                </div>
            </div>

            {{-- Contact --}}
            @if(empty($customer->Contact))
                <div class="mb-4">
                    <label class="block font-medium mb-1">Contact <span class="text-red-500">*</span></label>
                    <input type="text" name="contact" value="{{ old('contact') }}" placeholder="Enter contact number" class="w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2" required>
                    @error('contact') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            @else
                <input type="hidden" name="contact" value="{{ $customer->Contact }}">
            @endif

            {{-- New Event Fields --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Event Type <span class="text-red-500">*</span></label>
                <input type="text" name="event_type" value="{{ old('event_type') }}" class="w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-medium mb-1">Event Date <span class="text-red-500">*</span></label>
                <input type="date" name="event_date" value="{{ old('event_date') }}" class="w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-medium mb-1">Event Location <span class="text-red-500">*</span></label>
                <input type="text" name="event_location" value="{{ old('event_location') }}" class="w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-medium mb-1">Client Contact <span class="text-red-500">*</span></label>
                <input type="text" name="client_contact" value="{{ old('client_contact') }}" class="w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2" required>
            </div>

            {{-- Order Date --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Order Date <span class="text-red-500">*</span></label>
                <input type="date" name="order_date" value="{{ old('order_date', date('Y-m-d')) }}" class="w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2" required />
                @error('order_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Menu Items --}}
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-3">Menu Items <span class="text-red-500">*</span></h2>
                <div id="menu-items-list">
                    <div class="flex space-x-2 mb-2">
                        <select name="menu_items[0][id]" class="flex-1 rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2" required>
                            <option value="">Select...</option>
                            @foreach($menuItems as $mi)
                                <option value="{{ $mi->MenuItem_ID }}">{{ $mi->Name }} (${{ number_format($mi->Price, 2) }})</option>
                            @endforeach
                        </select>
                        <input type="number" name="menu_items[0][qty]" min="1" value="1" class="w-24 rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2" required />
                        <button type="button" class="remove-menu-item text-red-500 font-bold px-2 hidden">×</button>
                    </div>
                </div>
                <button type="button" id="add-menu-item" class="text-sm text-blue-600 hover:underline mt-2">+ Add Item</button>
                @error('menu_items') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Payment Section --}}
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-3">Payment Information <span class="text-red-500">*</span></h2>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1">Payment Method <span class="text-red-500">*</span></label>
                    <select name="payment_method" class="w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2" required>
                        <option value="">Select Payment Method...</option>
                        <option value="Cash" {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>Cash</option>
                        <option value="Credit Card" {{ old('payment_method') == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                        <option value="Debit Card" {{ old('payment_method') == 'Debit Card' ? 'selected' : '' }}>Debit Card</option>
                        <option value="Bank Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="Digital Wallet" {{ old('payment_method') == 'Digital Wallet' ? 'selected' : '' }}>Digital Wallet</option>
                    </select>
                    @error('payment_method') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Payment Date <span class="text-red-500">*</span></label>
                    <input type="date" name="payment_date" value="{{ old('payment_date', date('Y-m-d')) }}" class="w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2" required />
                    @error('payment_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Payment Amount <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3 top-2 text-gray-500">$</span>
                        <input type="number" name="payment_amount" value="{{ old('payment_amount') }}" step="0.01" min="0" placeholder="0.00" class="w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2 pl-8" required />
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Enter the total amount to be paid</p>
                    @error('payment_amount') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Submit --}}
            <div class="text-center">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded shadow">
                    Submit Order
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Scripts --}}
<script>
    if(localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
    }

    function toggleDark() {
        const root = document.documentElement;
        const isDark = root.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const flash = document.getElementById('flash-message');
        if (flash) {
            setTimeout(() => flash.remove(), 2000);
        }

        let menuIndex = 1;
        const menuItemsList = document.getElementById('menu-items-list');
        const addBtn = document.getElementById('add-menu-item');

        addBtn.addEventListener('click', function () {
            const row = document.createElement('div');
            row.className = 'flex space-x-2 mb-2';
            row.innerHTML = `
                <select name="menu_items[${menuIndex}][id]" class="flex-1 rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2" required>
                    <option value="">Select...</option>
                    @foreach($menuItems as $mi)
                        <option value="{{ $mi->MenuItem_ID }}">{{ $mi->Name }} (${{ number_format($mi->Price, 2) }})</option>
                    @endforeach
                </select>
                <input type="number" name="menu_items[${menuIndex}][qty]" min="1" value="1" class="w-24 rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2" required />
                <button type="button" class="remove-menu-item text-red-500 font-bold px-2">×</button>
            `;
            menuItemsList.appendChild(row);
            menuIndex++;
        });

        menuItemsList.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-menu-item')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>
@endsection
