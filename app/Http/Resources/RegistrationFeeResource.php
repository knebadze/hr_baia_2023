<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationFeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    private function getReason($reason_id){
        if($reason_id === null) return null;
        if($reason_id == 1){
            return $this->cancel_other_reason;
        }else{
            return $this->cancelReason->name;
        }
    }
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'creator_id' => $this->creator_id,
            'user_id' => $this->user_id,
            'initial_amount' => $this->initial_amount,
            'money' => $this->money,
            'enroll_date' => $this->enroll_date,
            'cancel_reason_id' => $this->cancel_reason_id,
            'cancel_reason' => $this->getReason($this->cancel_reason_id),
        ];
    }
}
