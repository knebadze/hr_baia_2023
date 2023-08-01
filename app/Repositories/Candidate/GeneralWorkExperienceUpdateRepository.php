<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;
use App\Models\General_work_experience;
use Stichoza\GoogleTranslate\GoogleTranslate;

class GeneralWorkExperienceUpdateRepository
{
    function translate($data) {
        foreach ($data as $key => $value) {
            if (isset($value['position_ka'])) {
                $data[$key]['position_en'] = GoogleTranslate::trans($value['position_ka'], 'en');
                $data[$key]['position_ru']  = GoogleTranslate::trans($value['position_ka'], 'ru');
            }
            if (isset($value['object_ka'])) {
                $data[$key]['object_en'] = GoogleTranslate::trans($value['object_ka'], 'en');
                $data[$key]['object_ru']  = GoogleTranslate::trans($value['object_ka'], 'ru');
            }
            if (isset($value['no_reason_info_ka'])) {
                $data[$key]['no_reason_info_en'] = GoogleTranslate::trans($value['no_reason_info_ka'], 'en');
                $data[$key]['no_reason_info_ru']  = GoogleTranslate::trans($value['no_reason_info_ka'], 'ru');
            }
        }
        return $data;
    }
    function update($data){
        // dd($data);
        $candidate_id = $data[0]['candidate_id'];
        $candidate = Candidate::findOrFail($candidate_id);
        if (General_work_experience::where('candidate_id', $candidate_id)->exists()) {
            General_work_experience::where('candidate_id', $candidate_id)->delete();
        }
        $data = $this->translate($data);
        if ($data[0]["has_experience"]['id'] == 1) {
            $selectExperience = collect($data)->reduce(function ($carry, $item) {
                if($carry  == null) $carry = [];
                $carry[$item["work_experience"]['id']] = ["experience" => $item["has_experience"]['id'], "position_ka" => $item["position_ka"], "position_en" => $item["position_en"], "position_ru" => $item["position_ru"],
                "object_ka" => $item["object_ka"],"object_en" => $item["object_en"],"object_ru" => $item["object_ru"],];
                return $carry;
            }, []);
            $candidate->generalWorkExperience()->attach($selectExperience);
        }else{
            General_work_experience::updateOrCreate(
                ['candidate_id' => $candidate_id],
                [
                    'experience' => $data[0]["has_experience"]['id'],
                    'no_reason_id' => $data[0]['no_reason']['id'],
                    'no_reason_info_ka' => $data[0]['no_reason_info_ka'],
                    'no_reason_info_en' => $data[0]['no_reason_info_en'],
                    'no_reason_info_ru' => $data[0]['no_reason_info_ru'],
                ]
            );
        }
    }

}
