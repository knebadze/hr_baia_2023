<?php

namespace App\Repositories;

use App\Models\Candidate;
use App\Models\FamilyWorkExperience;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FamilyWorkExperienceRepository
{
    public function save($data)
    {
        // print_r($data);
        // exit;
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->first();
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
                'experience' => $data['familyWorkExperience']['experience']['id'],
                'families_worked_count' => $data['familyWorkExperience']['families_worked_count'],
                'longest_time' => $data['familyWorkExperience']['longest']['id'],
                'work_experience_id' => $data['familyWorkExperience']['work_experience']['id'],
                'no_reason_id' => ($data['familyWorkExperience']['no_reason'])?$data['familyWorkExperience']['no_reason']['id']:$data['familyWorkExperience']['no_reason'],
                'no_reason_info' => $data['familyWorkExperience']['no_reason_info'],
            ]
        );

        if ($data['familyWorkExperience']['experience']['id'] == 2) {
            $user->update([
                'is_active' => 3,
                'updated_at' => now()
            ]);
        }

        return $data['familyWorkExperience']['experience']['id'];
    }
}
