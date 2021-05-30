<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveEmployeeDetail extends Model
{
    use HasFactory;

    protected $fillable = ['leave_employee_id', 'quota', 'applied'];

    public function leave_employee()
    {
        return $this->belongsTo(LeaveEmployee::class, 'leave_employee_id', 'id');
    }
}
