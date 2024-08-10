<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminVacancyResource extends JsonResource
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
            'title_en' => $this->title_en,
            'title_ka' => $this->title_ka,
            'title_ru' => $this->title_ru,
            'category' => $this->category,
            'currency' => $this->currency,
            'demand' => $this->demand,
            'deposit' => $this->deposit,
            'employer' => $this->employer,
            'hr' => $this->hr,
            'interview_place' => $this->interviewPlace,
            'status' => $this->status,
            'term' => $this->term,
            'work_schedule' => $this->workSchedule,
            'vacancy_duty' => $this->vacancyDuty,
            'vacancy_benefit' => $this->vacancyBenefit,
            'vacancy_for_who_need' => $this->vacancyForWhoNeed,
            'vacancy_interest' => $this->vacancyInterest,
            'vacancy_driving_license' => $this->vacancyDrivingLicense,
            'reason_for_cancel' => $this->reasonForCancel,
            'registrant' => $this->registrant,
            'additional_schedule_en' => $this->additional_schedule_en,
            'additional_schedule_ka' => $this->additional_schedule_ka,
            'additional_schedule_ru' => $this->additional_schedule_ru,
            'author_id' => $this->author_id,
            'carry_in_head_date' => $this->carry_in_head_date,
            'code' => $this->code,
            'comment' => $this->comment,
            'created_at' => $this->created_at,
            'go_vacation' => $this->go_vacation,
            'hr_id' => $this->hr_id,
            'interview_date' => $this->interview_date,
            'interview_place_id' => $this->interview_place_id,
            'payment' => $this->payment,
            'photo' => $this->photo,
            'reason_for_cancel_id' => $this->reason_for_cancel_id,
            'registrant_id' => $this->registrant_id,
            'slug' => $this->slug,
            'start_date' => $this->start_date,
            'status_change_reason' => $this->status_change_reason,
            'status_id' => $this->status_id,
            'stay_night' => $this->stay_night,
            'term_id' => $this->term_id,
            'updated_at' => $this->updated_at,
            'view' => $this->view,
            'work_additional_hours' => $this->work_additional_hours,
            'work_schedule_id' => $this->work_schedule_id,
            'employed_candidate' => $this->employed_candidate,
        ];
    }
}
