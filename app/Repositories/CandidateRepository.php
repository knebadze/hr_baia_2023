<?php

namespace App\Repositories;

use stdClass;
use App\Models\Candidate;
use App\Models\CandidateRecommendation;
use App\Models\General_work_experience;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CandidateRepository
{
    public function __construct()
    {

    }

    function array_to_object($array) {
        $obj = new stdClass();

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
        // var_dump($objData);
        // exit;
        // if ($objData->driving_license) {
        //     $convertStringLicense = implode(",", $data['driving_license']);
        // }
        // print_r($objData);
        // exit;
        $candidate = Candidate::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'personal_number' => $objData->candidate->personal_number,
                'nationality_id' => $objData->candidate->nationality_id,
                'religion_id' => $objData->candidate->religion_id,
                'education_id' => $objData->candidate->education_id,
                'marital_status_id' => $objData->candidate->marital_status_id,
                'children' => $objData->candidate->children,
                'children_age' => $objData->candidate->children_age,
                'spouse' => $objData->candidate->spouse,
                'fb_link' => $objData->candidate->fb_link,
                'youtube_link' =>  $objData->candidate->youtube_link,
                'map_link' =>  $objData->candidate->map_link,
                'height' =>  $objData->candidate->height,
                'weight' =>  $objData->candidate->weight,
                'address' =>  $objData->candidate->address,
                'street' =>  $objData->candidate->street,
                'medical_info' =>  $objData->candidate->medical_info,
                'convection' => ($objData->candidate->convection == null)?0:$objData->candidate->convection,
                'smoke' =>  ($objData->candidate->smoke == null)?0:$objData->candidate->smoke,
                'work_abroad' =>  ($objData->candidate->work_abroad == null)?0:$objData->candidate->work_abroad,
                // 'driving_license' => $convertStringLicense,
            ]
        );
        $candidate->citizenship()->sync( $objData->candidateCitizenships );
        $candidate->professions()->sync($objData->candidateProfessions);
        $candidate->specialty()->sync($objData->candidateSpecialties);
        $candidate->allergy()->sync($objData->candidateAllergies);


        $selectLanguage = collect($data['candidateLanguages'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[$item["language"]["id"]] = ["language_level_id" => $item["level"]["id"]];
            return $carry;
        }, []);

        $candidate->languages()->sync($selectLanguage);
        if ($data['work_experience']['experience'] == 1) {
            $selectExperience = collect($data['work_experience'])->reduce(function ($carry, $item) {
                if($carry  == null) $carry = [];
                $carry[$item["experience"]["id"]] = ["position" => $item["position"], "object" => $item["object"]];
                return $carry;
            }, []);
            print_r($selectExperience);
            exit;
        }
        // $selectExperience = collect($data['work_experience'])->reduce(function ($carry, $item) {
        //     if($carry  == null) $carry = [];
        //     $carry[$item["experience"]["id"]] = ["position" => $item["position"], "object" => $item["object"]];
        //     return $carry;
        // }, []);
        // $candidate->generalWorkExperience()->attach($selectExperience);
        // print_r($objData->recommendation);
        // // if ($objData->recommendation->hasFile('file') ) {

        // }
        // $candidateRecommendation = CandidateRecommendation::updateOrCreate(
        //     ['candidate_id' => $candidate->id],
        //     [
        //         'recommendation_id' => $objData->recommendation_id,
        //         'recommendation_from_whom_id' => $objData->recommendation_from_whom_id,
        //         'position' => $objData->position,
        //         'number' => $objData->number,
        //     ]
        // );

        // return $candidate->fresh();

        return $candidate->id;
    }
}
