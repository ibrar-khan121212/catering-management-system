<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventManager extends Model
{
    protected $primaryKey = 'Employee_ID';
    protected $fillable = ['Employee_ID', 'Managed_Events_Count'];
    public $timestamps = false;

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'Employee_ID');
    }
}
