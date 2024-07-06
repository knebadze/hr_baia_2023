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
                'registerLog' => $this->user->registerLog,
                'registerFee' => $this->user->registerFee,
            ],
           'workInformation' => $this->getWorkInformation->map(function ($workInformation) {
                // Check if getWorkSchedule is a method and call it accordingly
                $workSchedule = method_exists($workInformation, 'getWorkSchedule') ? $workInformation->getWorkSchedule() : null;

                return [
                    'category' => optional($workInformation->category)->name,
                    'currency' => $workInformation->currency_id,
                    // Now, handle $workSchedule based on what it actually returns (object, collection, etc.)
                    'workSchedule' => optional($workSchedule)->workSchedule, // Adjust this line based on the actual structure of the work schedule data
                    // Include other fields from WorkInformation as needed
                ];
            }),
            'nationality' => $this->nationality,
            'citizenship' => $this->citizenship,
            'religion' => $this->religion,
            'education' => $this->education,
            'languages' => $this->getLanguage,
            'professions' => $this->professions,
            'specialty' => $this->specialty,
            'recommendation' => $this->recommendation,
            'generalWorkExperience' => $this->generalWorkExperience,
            'familyWorkExperience' => $this->familyWorkExperience,
            'characteristic' => $this->characteristic,
            'allergy' => $this->allergy,
            'maritalStatus' => $this->maritalStatus,
            'drivingLicense' => $this->drivingLicense,
            'status' => $this->status,
            'number' => $this->number->map(function ($numberInstance) {
                return [
                    'numberOwner' => $numberInstance->numberOwner,
                    // Include other fields from the number instance as needed
                ];
            }),
        ];
    }
}
