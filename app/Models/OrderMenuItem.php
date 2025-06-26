<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMenuitem extends Model
{
    use HasFactory;

    protected $table = 'order_menuitem';

    protected $fillable = [
        'Order_ID',
        'MenuItem_ID',
        'Quantity',
        'Special_Notes',
    ];

    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo(Order::class, 'Order_ID', 'Order_ID');
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, 'MenuItem_ID', 'MenuItem_ID');
    }
}
