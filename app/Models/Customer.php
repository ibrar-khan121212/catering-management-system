<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'Customer_ID';
    public $timestamps = false;

    // Allow mass assignment for these fields
    protected $fillable = ['Name', 'Email', 'Contact'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'Customer_ID');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'Customer_ID');
    }
}
