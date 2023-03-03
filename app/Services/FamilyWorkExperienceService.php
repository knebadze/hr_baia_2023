<?php

namespace App\Services;

use App\Models\User;
use App\Models\Candidate;
use Illuminate\Support\Facades\DB;
use App\Models\FamilyWorkExperience;
use Illuminate\Support\Facades\Auth;
use App\Repositories\FamilyWorkExperienceRepository;

class FamilyWorkExperienceService
{
    protected $familyWorkExperienceRepository;

    public function __construct(FamilyWorkExperienceRepository $familyWorkExperienceRepository)
    {
        $this->familyWorkExperienceRepository = $familyWorkExperienceRepository;
    }
    public function saveData($data)
    {
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->first();
        $candidate = Candidate::where('user_id', $user->id)->first();
        if (DB::table('family_work_experiences')->where('candidate_id', $candidate->id)->exists()) {
            $familyWorkExperience = FamilyWorkExperience::where('candidate_id', $candidate->id)->first();
            if ($familyWorkExperience->experience != $data['familyWorkExperience']['has_experience']['id']) {
                $familyWorkExperience->delete();
            }
        }
        if ($data['familyWorkExperience']['has_experience']['id'] == 1) {
            $result = $this->familyWorkExperienceRepository->saveExperience($data, $user);
            return $result;
        }
        $result = $this->familyWorkExperienceRepository->saveNoExperience($data['familyWorkExperience'], $user);
        return $result;
    }
}
