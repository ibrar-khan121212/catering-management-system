<?php
// app/Models/EmployeeEvent.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeEvent extends Model
{
    protected $table = 'employee_events';

    protected $fillable = [
        'Employee_ID',
        'Event_ID',
        'Role_in_Event',
        'Shift_Time',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'Employee_ID');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'Event_ID');
    }
}
