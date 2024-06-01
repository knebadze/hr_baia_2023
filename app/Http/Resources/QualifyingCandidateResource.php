<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QualifyingCandidateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($this);
        return [
            'id' => $this->id,
            'vacancy_id' => $this->vacancy_id,
            'qualifying_type_id' => $this->qualifying_type_id,
            'candidate_id' => $this->candidate->id,
            'employer_answer' => $this->employer_answer,
            'interview_date' => $this->interview_date,
            'interview_place_id' => $this->interview_place_id,
            'status_id' => $this->status_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
            'candidate_name' => $this->candidate->user->name_ka,
            // 'qualifying_type' => $this->qualifying_type,
            // 'interview_place' => $this->interview_place,
            // 'vacancy_status_id' => $this->vacancy_status_id,
            // 'vacancy_code' => $this->vacancy_code,
            // 'vacancy_start_date' => $this->vacancy_start_date,
            // 'vacancy_interview_place_id' => $this->vacancy_interview_place_id,
            // 'vacancy_interview_date' => $this->vacancy_interview_date,
            // 'vacancy_hr_id' => $this->vacancy_hr_id,
            // 'end_work_reason_id' => $this->end_work_reason_id,
            // 'end_work_reason' => $this->end_work_reason,
            // 'status' => $this->status,
            // 'status_color' => $this->status_color,
        ];
    }
}
