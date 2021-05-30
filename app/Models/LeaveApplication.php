<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    use HasFactory;
    protected $fillable = ['status', 'leave_employee_id', 'total_leave'];

    public function leave_employee()
    {
        return $this->hasOne(LeaveEmployee::class, 'id', 'leave_employee_id');
    }
}
