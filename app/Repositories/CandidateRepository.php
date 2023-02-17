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
        $candidate->citizenship()->sync($objData->citizenship);
        $candidate->professions()->sync($objData->professions);
        $candidate->specialty()->sync($objData->specialty);
        // $candidate->languages()->sync($objData->language, ['language_level_id' => $objData->language->language_level_id]);
        $candidate->allergy()->sync($objData->allergy);
        // foreach ($candidate->notice as $key => $value) {

        // }
        // return $candidate->fresh();
        return $objData->language;
    }
}
