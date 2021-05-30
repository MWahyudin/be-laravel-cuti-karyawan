<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnnualLeaveEmployeeResource extends JsonResource
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
            'year' => $this->year->annual_leave_year,
            'quota' => $this->detail->quota,
            'applied' => $this->detail->applied == null ? 0 : $this->detail->applied,
            'remaining' => $this->detail->quota - $this->detail->applied,
        ];
    }
}
