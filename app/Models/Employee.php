<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $primaryKey = 'Employee_ID';

    protected $fillable = [
        'Name',
        'Contact',
        'Salary',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'employee_event', 'Employee_ID', 'Event_ID')->withPivot('Role_in_Event', 'Shift_Time');
    }

    public function chef()
    {
        return $this->hasOne(Chef::class, 'Employee_ID');
    }

    public function server()
    {
        return $this->hasOne(Server::class, 'Employee_ID');
    }

    public function eventManager()
    {
        return $this->hasOne(EventManager::class, 'Employee_ID');
    }
}
