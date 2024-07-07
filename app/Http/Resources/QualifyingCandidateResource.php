<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
        return [
            'id' => $this->id,
            'vacancy_id' => $this->vacancy_id,
            'qualifying_type_id' => $this->qualifying_type_id,
            'candidate_id' => optional($this->candidate)->id,
            'employer_answer' => $this->employer_answer,
            'interview_date' => $this->interview_date ? $this->interview_date->format('m-d-Y H:i') : null,
            'interview_place_id' => $this->interview_place_id,
            'status_id' => $this->status_id,
            'start_date' => $this->start_date ? $this->start_date->format('m-d-Y') : null,
            'end_date' => $this->end_date ? $this->end_date->format('m-d-Y') : null,
            'created_at' => $this->created_at ? $this->created_at->format('m-d-Y H:i') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('m-d-Y H:i') : null,
            'candidate_name' => optional($this->candidate->user)->name_ka,
            'qualifying_type' => optional($this->qualifyingType)->name,
            'interview_place' => $this->vacancy->interviewPlace->name_ka,
            'vacancy_status_id' => optional($this->vacancy)->status_id,
            'vacancy_code' => optional($this->vacancy)->code,
            'vacancy_start_date' => $this->vacancy->start_date,
            'vacancy_interview_place_id' => optional($this->vacancy)->interview_place_id,
            'vacancy_interview_date' => optional($this->vacancy)->interview_date ? Carbon::parse($this->vacancy->interview_date)->format('m-d-Y H:i') : null,
            'vacancy_hr_id' => optional($this->vacancy)->hr_id,
            'hr_parent_id' => optional($this->vacancy)->hr->parent_id,
            'end_work_reason_id' => optional($this->endWork)->no_reason_id,
            'end_work_reason' => optional(optional($this->endWork)->reason)->name_ka,
            'status' => optional($this->status)->name_ka,
            'status_color' => optional($this->status)->color,
        ];
    }
}
