<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItemInventoryItem extends Model
{
    use HasFactory;

    protected $table = 'menuitem_inventoryitem';

    protected $fillable = [
        'MenuItem_ID',
        'Inventory_ID',
        'Quantity_Required',
    ];

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, 'MenuItem_ID', 'MenuItem_ID');
    }

    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class, 'Inventory_ID', 'Inventory_ID');
    }
}