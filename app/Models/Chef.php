<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chef extends Model
{
    protected $primaryKey = 'Employee_ID';
    protected $fillable = [
        'Employee_ID',
        'Specialty',
    ];

    public $timestamps = false;

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'Employee_ID');
    }
}
