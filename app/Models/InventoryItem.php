<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $primaryKey = 'Inventory_ID';
    protected $fillable = [
        'Name',
        'Quantity_Available',
        'Unit',
    ];

    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class, 'menuitem_inventoryitem', 'Inventory_ID', 'MenuItem_ID')->withPivot('Quantity_Required');
    }
}
