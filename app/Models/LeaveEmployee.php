<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveEmployee extends Model
{
    use HasFactory;

    protected $fillable = ['annual_leave_id', 'user_id', 'user'];

    public function year()
    {
        return $this->belongsTo(AnnualLeave::class, 'annual_leave_id', 'id');
    }

    // public function annual_live_year()
    // {
    //     // return $this->hasOne(AnnualLeave::class, 'annual_leave_id', 'id');
    // }

    public function employee()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function detail()
    {
        return $this->hasOne(LeaveEmployeeDetail::class, 'leave_employee_id', 'id');
    }
}
