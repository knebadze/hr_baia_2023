<?php

namespace App\Repositories\Candidate;

use App\Models\FamilyWorkExperience;
use Stichoza\GoogleTranslate\GoogleTranslate;

class FamilyWorkExperienceUpdateRepository
{
    function translate($data) {
        if (isset($data['no_reason_info_ka'])) {
            $data['no_reason_info_en'] = GoogleTranslate::trans($data['no_reason_info_ka'], 'en');
            $data['no_reason_info_ru']  = GoogleTranslate::trans($data['no_reason_info_ka'], 'ru');
        }
        return $data;
    }
    function update($data){
        $candidate_id = $data['candidate_id'];

        if ($data["has_experience"]['id'] == 1) {
            if (FamilyWorkExperience::where('candidate_id', $candidate_id)->exists() && FamilyWorkExperience::where('candidate_id', $candidate_id)->where('experience', 2)->exists()) {
                FamilyWorkExperience::where('candidate_id', $candidate_id)->delete();
            }
            $familyWork = FamilyWorkExperience::updateOrCreate(
                ['candidate_id' => $candidate_id],
                [
                    'experience' => $data['has_experience']['id'],
                    'families_worked_count' => $data['families_worked_count'],
                    'longest_time' => $data['longest']['id'],
                    'work_experience_id' => $data['work_experience']['id'],
                ],
            );


            $selectDutyId = collect($data['family_work_duty'])->reduce(function ($carry, $item) {
                if($carry  == null) $carry = [];
                $carry[] = $item["id"];
                return $carry;
            }, []);
            $familyWork->familyWorkDuty()->sync($selectDutyId);
        }else{
            if (FamilyWorkExperience::where('candidate_id', $candidate_id)->exists() && FamilyWorkExperience::where('candidate_id', $candidate_id)->where('experience', 1)->exists()) {
                FamilyWorkExperience::where('candidate_id', $candidate_id)->delete();
            }
            if (isset($data['no_reason_info_ka'])) {
                $data = $this->translate($data);
            }
            FamilyWorkExperience::updateOrCreate(
                ['candidate_id' => $candidate_id],
                [
                    'experience' => $data["has_experience"]['id'],
                    'no_reason_id' => $data['no_reason']['id'],
                    'no_reason_info_ka' => $data['no_reason_info_ka'],
                    'no_reason_info_en' => $data['no_reason_info_en'],
                    'no_reason_info_ru' => $data['no_reason_info_ru'],
                ]
            );
        }
    }

}
