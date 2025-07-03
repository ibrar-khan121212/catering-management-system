<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $primaryKey = 'Employee_ID';
    protected $fillable = ['Employee_ID', 'Assigned_Section'];
    public $timestamps = false;

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'Employee_ID');
    }
}
