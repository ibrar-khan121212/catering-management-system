<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class MenuItem extends Model
{
    protected $primaryKey = 'MenuItem_ID';

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_menuitem', 'MenuItem_ID', 'Order_ID')->withPivot('Quantity', 'Special_Notes');
    }

    public function inventoryItems()
    {
        return $this->belongsToMany(InventoryItem::class, 'menuitem_inventoryitem', 'MenuItem_ID', 'Inventory_ID')->withPivot('Quantity_Required');
    }
}