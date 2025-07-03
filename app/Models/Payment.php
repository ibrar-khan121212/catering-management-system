<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'Payment_ID';
    protected $fillable = [
        'Customer_ID',
        'Order_ID',
        'Payment_Date',
        'Amount',
        'Method',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_ID');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'Order_ID');
    }
}