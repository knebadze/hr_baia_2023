<?php

namespace App\Http\Resources\Admin;

use Carbon\Carbon;
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
            'parent_id' => $this->parent_id,
            'name' => $this->name_ka,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'gender_id' => $this->gender_id,
            'number' => $this->number,
            'is_active' => $this->is_active,
            'mobile' => $this->mobile,
            'inside_number' => $this->inside_number,
            'date_of_birth' => Carbon::parse($this->date_of_birth)->format('m-d-Y'),
            'person_number' => $this->person_number,
            'branch_id' => $this->branch_id,
            'branch_name' => $this->branch->name,
            'internship' => $this->internship,
            'bonus_percent' => $this->bonus_percent,
            'fixed_salary' => $this->fixed_salary,
            'fb_link' => $this->fb_link,
            // Add more fields as needed
        ];
    }
}
