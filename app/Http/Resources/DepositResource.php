<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepositResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    private function getReason($reason_id, $cancel_other_reason, $cancelReason){
        if($reason_id === null) return null;
        if($reason_id == 1){
            return $cancel_other_reason;
        }else{
            return $cancelReason;
        }
    }
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'vacancy_id' => $this->vacancy_id,
            'hr_parent_id' => $this->vacancy->hr->parent_id,

            'candidate_initial_amount' => $this->candidate_initial_amount,
            'must_be_enrolled_candidate' => $this->must_be_enrolled_candidate,
            'must_be_enrolled_candidate_date' => $this->must_be_enrolled_candidate_date,

            'employer_initial_amount' => $this->employer_initial_amount,
            'must_be_enrolled_employer' => $this->must_be_enrolled_employer,
            'must_be_enrolled_employer_date' => $this->must_be_enrolled_employer_date,
            'candidate_cancel_reason_id' => $this->candidate_cancel_reason_id,
            'candidate_cancel_reason' => $this->getReason($this->candidate_cancel_reason_id, $this->candidate_cancel_other_reason, $this->candidateCancelReason?->name),
            'employer_cancel_reason_id' => $this->employer_cancel_reason_id,
            'employer_cancel_reason' => $this->getReason($this->employer_cancel_reason_id, $this->employer_cancel_other_reason, $this->employerCancelReason?->name),
        ];
    }
}
