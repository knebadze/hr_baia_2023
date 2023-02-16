<?php

namespace App\Repositories;

use App\Models\Candidate;

class CandidateRepository
{
    public function __construct()
    {

    }
    public function save($data)
    {
        // $candidate = Candidate::updateOrCreate(
        //     ['user_id' => $data->candidate->user_id],
        //     [
        //         'personal_number' => $data->candidate->personal_number,
        //         'nationality_id' => $data->candidate->nationality_id,
        //         'religion_id' => $data->candidate->religion_id,
        //         'education_id' => $data->candidate->education_id,
        //         'marital_status_id' => $data->candidate->marital_status_id,
        //         'children' => $data->candidate->children,
        //         'children_age' => $data->candidate->children_age,
        //         'spouse' => $data->candidate->spouse,
        //     ]
        // );
        // foreach ($request->citizenship as $key => $value) {
        //     $citizenship = Candidate_citizenship::updateOrCreate(
        //         [
        //             'candidate_id' => $candidate->id,
        //             'citizenship_id' => $value
        //         ],
        //     );
        // }
        // foreach ($request->professions as $key => $value) {
        //     $profession = Candidate_profession::updateOrCreate(
        //         [
        //             'candidate_id' => $candidate->id,
        //             'profession_id' => $value
        //         ],
        //     );
        // }

        // foreach ($request->specialties as $key => $value) {
        //     $specialty = Candidate_specialty::updateOrCreate(
        //         [
        //             'candidate_id' => $candidate->id,
        //             'specialty_id' => $value
        //         ],
        //     );
        // }
        // return $candidate->fresh();
        return $data;
    }
}
