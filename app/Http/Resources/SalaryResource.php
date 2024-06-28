<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SalaryResource extends JsonResource
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
            'role' => $this->hr->user->role->name,
            'role_id' => $this->hr->user->role_id,
            'hr_id' => $this->hr_id,
            'staff' => $this->hr->user->name_ka,
            'fixed_salary' => $this->fixed_salary,
            'hr_agree' => $this->hr_agree,
            'hr_bonus_from_vacancy' => $this->hr_bonus_from_vacancy,
            'hr_bonus_from_registration' => $this->hr_bonus_from_registration,
            'supplement' => $this->supplement,
            'full_salary' => $this->full_salary,
            // 'status' => $this->status,
            'created_at' => $this->created_at ? Carbon::parse($this->created_at)->format('m-d-Y H:i') : null,
            'disbursement_date' => $this->disbursement_date ? Carbon::parse($this->disbursement_date)->format('m-d-Y H:i:s') : null,
            'updated_at' => $this->updated_at ? Carbon::parse($this->updated_at)->format('m-d-Y H:i') : null,
        ];
    }
}
