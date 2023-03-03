<?php

namespace App\Repositories;

use App\Models\Candidate;
use App\Models\FamilyWorkExperience;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FamilyWorkExperienceRepository
{
    public function saveExperience($data, $user)
    {
        // print_r($data);
        // exit;

        $candidate = Candidate::where('user_id', $user->id)->first();
        $selectSkillId = collect($data['candidateFamilyWorkSkill'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item["id"];
            return $carry;
        }, []);
        $candidate->familyWorkSkill()->sync($selectSkillId);

        FamilyWorkExperience::updateOrCreate(
            [
                'candidate_id' => $candidate->id,
            ],
            [
                'experience' => $data['familyWorkExperience']['has_experience']['id'],
                'families_worked_count' => $data['familyWorkExperience']['families_worked_count'],
                'longest_time' => $data['familyWorkExperience']['longest']['id'],
                'work_experience_id' => $data['familyWorkExperience']['work_experience']['id'],
            ]
        );

        // if ($data['familyWorkExperience']['has_experience']['id'] == 2) {
        //     $user->update([
        //         'is_active' => 3,
        //         'updated_at' => now()
        //     ]);
        // }

        return $data['familyWorkExperience']['has_experience']['id'];
    }

    public function saveNoExperience($data, $user)
    {
        $candidate = Candidate::where('user_id', $user->id)->first();
        FamilyWorkExperience::updateOrCreate(
            [
                'candidate_id' => $candidate->id,
            ],
            [
                'experience' => $data['has_experience']['id'],
                'no_reason_id' => ($data['no_reason'])?$data['no_reason']['id']:$data['no_reason'],
                'no_reason_info' => $data['no_reason_info'],
            ]
        );
        $user->update([
            'is_active' => 3,
            'updated_at' => now()
        ]);
        return $data['has_experience']['id'];
    }
}
