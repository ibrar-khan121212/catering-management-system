@extends('layout')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Mapping Details</h2>

    <p><strong>Menu Item:</strong> {{ $menuitem_inventoryitem->menuItem->name ?? 'N/A' }}</p>
    <p><strong>Inventory Item:</strong> {{ $menuitem_inventoryitem->inventoryItem->name ?? 'N/A' }}</p>
    <p><strong>Quantity Required:</strong> {{ $menuitem_inventoryitem->Quantity_Required }}</p>

    <div class="mt-6">
        <a href="{{ route('menuitem_inventoryitem.index') }}" class="text-blue-600 underline">← Back to List</a>
    </div>
</div>
@endsection
