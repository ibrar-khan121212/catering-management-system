<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chef extends Model
{
    protected $primaryKey = 'Employee_ID';

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'Employee_ID');
    }
}
