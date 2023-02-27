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
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->first();
        $candidate = Candidate::where('user_id', $user->id)->first();
        $candidate->familyWorkSkill()->sync($data['candidateFamilyWorkSkill']);

        FamilyWorkExperience::updateOrCreate(
            [
                'candidate_id' => $candidate->id,
            ],
            [
                'experience' => $data['familyWorkExperience']['experience'],
                'families_worked_count' => $data['familyWorkExperience']['families_worked_count'],
                'longest_time' => $data['familyWorkExperience']['longest_time'],
                'work_experience_id' => $data['familyWorkExperience']['work_experience_id'],
                'no_reason_id' => $data['familyWorkExperience']['no_reason_id'],
                'no_reason_info' => $data['familyWorkExperience']['no_reason_info'],
            ]
        );


        $user->update([
            'is_active' => 3,
            'updated_at' => now()
        ]);
        return $data;
    }
}
