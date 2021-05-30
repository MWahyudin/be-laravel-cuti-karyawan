<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnnualLeaveDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'employee_name' => $this->leave_employee->employee->name,
            'year' => $this->leave_employee->year->annual_leave_year,
            'quota' => $this->quota,
            'applied' => $this->applied,
            'remaining' => $this->quota - $this->applied
        ];
    }
}
