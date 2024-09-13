<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminCandidateResource extends JsonResource
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
            'user' => [
                'gender' => $this->user->gender,
                'registerLog' => $this->user->registerLog->creator,
                'registerFee' => $this->user->registerFee,
                'blacklist' => $this->user->blacklist->ground,
            ],
            'workInformation' => [
                'category' => $this->getWorkInformation->category,
                'currency' => $this->getWorkInformation->currency,
                'workSchedule' => $this->getWorkInformation->getWorkSchedule->workSchedule,
            ],
            'nationality' => $this->nationality,
            'citizenship' => $this->citizenship,
            'religion' => $this->religion,
            'education' => $this->education,
            'languages' => $this->getLanguage->map(function ($language) {
                return [
                    'language' => $language->language,
                    'level' => $language->level,
                ];
            }),
            'professions' => $this->professions,
            'specialty' => $this->specialty,
            'recommendation' => $this->recommendation,
            'generalWorkExperience' => $this->generalWorkExperience,
            'familyWorkExperience' => [
                'noReason' => $this->familyWorkExperience->noReason,
                'familyWorkDuty' => $this->familyWorkExperience->familyWorkDuty,
            ],
            'characteristic' => $this->characteristic,
            'allergy' => $this->allergy,
            'maritalStatus' => $this->maritalStatus,
            'drivingLicense' => $this->drivingLicense,
            'status' => $this->status,
            'number' => [
                'numberOwner' => $this->number->numberOwner,
            ],
            'qualifyingCandidate' => $this->qualifyingCandidate,
        ];
    }
}
