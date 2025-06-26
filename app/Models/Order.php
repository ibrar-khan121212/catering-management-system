<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'Order_ID';
    public $timestamps = false; // Optional: only if you're not using created_at / updated_at

    // Allow mass assignment for these fields
    protected $fillable = [
        'Customer_ID',
        'Event_ID',
        'Order_Date',
        'Status',
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_ID');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'Event_ID');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'Order_ID');
    }

    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class, 'order_menuitem', 'Order_ID', 'MenuItem_ID')
                    ->withPivot('Quantity', 'Special_Notes');
    }
}
