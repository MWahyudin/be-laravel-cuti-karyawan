<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
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
            'employee' => $this->leave_employee->employee->name,
            'year' => $this->leave_employee->year->annual_leave_year,
            'request_annual_leave' => $this->total_leave,
            'quota' => $this->leave_employee->detail->quota,
            'applied' => $this->leave_employee->detail->applied,
            'remaining' => $this->leave_employee->detail->quota - $this->leave_employee->detail->applied,
            'status' => $this->status
        ];
    }
}
