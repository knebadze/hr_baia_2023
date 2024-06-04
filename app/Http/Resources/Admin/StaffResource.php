<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
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
            'hr_id' => $this->staff->id,
            'name' => $this->name_ka,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'gender_id' => $this->gender_id,
            'k_mobile' => $this->number,
            'is_active' => $this->is_active,
            'mobile' => $this->staff->mobile,
            'inside_number' => $this->staff->inside_number,
            'date_of_birth' => $this->date_of_birth,
            'person_number' => $this->staff->person_number,
            'branch_id' => $this->staff->branch_id,
            'branch_name' => $this->staff->branch->name,
            'internship' => $this->staff->internship,
            'bonus_percent' => $this->staff->bonus_percent,
            'fixed_salary' => $this->staff->fixed_salary,
            'fb_link' => $this->staff->fb_link,
            // Add more fields as needed
        ];
    }
}
