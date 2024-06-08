<?php

namespace App\Http\Resources\Staff;

use Illuminate\Http\Resources\Json\JsonResource;

class AdministratorDailyWorkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'staff_id' => $this->hr_id,
            'hr_id' => $this->candidate_has_registered,
            'name' => $this->has_enrollment_register,
            // Add more fields as needed
        ];
    }
}
