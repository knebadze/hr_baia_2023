<?php

namespace App\Repositories;

use App\Models\Candidate;

class CandidateRepository
{
    public function __construct()
    {

    }

    function array_to_object($array) {
        $obj = new \stdClass();

        foreach ($array as $k => $v) {
           if (strlen($k)) {
              if (is_array($v)) {
                 $obj->{$k} = $this->array_to_object($v); //RECURSION
              } else {
                 $obj->{$k} = $v;
              }
           }
        }

        return $obj;
     }

    public function save($data)
    {

        $objData = $this->array_to_object($data);
        // print_r($objData->candidate->personal_number);

        $candidate = Candidate::updateOrCreate(
            ['user_id' => $objData->candidate->user_id],
            [
                'personal_number' => $objData->candidate->personal_number,
                'nationality_id' => $objData->candidate->nationality_id,
                'religion_id' => $objData->candidate->religion_id,
                'education_id' => $objData->candidate->education_id,
                'marital_status_id' => $objData->candidate->marital_status_id,
                'children' => $objData->candidate->children,
                'children_age' => $objData->candidate->children_age,
                'spouse' => $objData->candidate->spouse,
            ]
        );
        foreach ($objData->citizenship as $key => $value) {
            // $citizenship = Candidate_citizenship::updateOrCreate(
            //     [
            //         'candidate_id' => $candidate->id,
            //         'citizenship_id' => $value
            //     ],
            // );
        }
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
