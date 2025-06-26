<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $primaryKey = 'Event_ID';

    // ✅ Allow mass assignment
    protected $fillable = [
        'Event_Type',
        'Date',
        'Location',
        'Client_Contact',
    ];

    public $timestamps = false; // ❗️Only include this if your table doesn't have created_at/updated_at

    public function orders()
    {
        return $this->hasMany(Order::class, 'Event_ID');
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_event', 'Event_ID', 'Employee_ID')
                    ->withPivot('Role_in_Event', 'Shift_Time');
    }
}
