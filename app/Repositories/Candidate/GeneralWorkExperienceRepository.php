<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;
use App\Models\General_work_experience;
use Stichoza\GoogleTranslate\GoogleTranslate;

class GeneralWorkExperienceRepository
{
    function saveTranslate($data) {
        if (isset($data['position_ka'])) {
            $data['position_en'] = GoogleTranslate::trans($data['position_ka'], 'en');
            $data['position_ru']  = GoogleTranslate::trans($data['position_ka'], 'ru');
        }
        if (isset($data['object_ka'])) {
            $data['object_en'] = GoogleTranslate::trans($data['object_ka'], 'en');
            $data['object_ru']  = GoogleTranslate::trans($data['object_ka'], 'ru');
        }
        if (isset($data['no_reason_info_ka'])) {
            $data['no_reason_info_en'] = GoogleTranslate::trans($data['no_reason_info_ka'], 'en');
            $data['no_reason_info_ru']  = GoogleTranslate::trans($data['no_reason_info_ka'], 'ru');
        }
        return $data;
    }

    function save($data, $user_id) {
        // dd($data);
        try{
            $data = $this->saveTranslate($data);
            $candidate = Candidate::where('user_id', $user_id)->first();
            if (General_work_experience::where('candidate_id', $candidate->id)->exists()) {
                $work = General_work_experience::where('candidate_id', $candidate->id)->first();
                if ($work->experience != $data['has_experience']['id']) {
                    General_work_experience::where('candidate_id', $candidate->id)->delete();
                }

            }
            $generalWork = new General_work_experience();
            $generalWork->candidate_id = $candidate->id;
            $generalWork->experience = $data['has_experience']['id'];
            if ($data['has_experience']['id'] == 1) {
                $generalWork->work_experience_id = $data['work_experience']['id'];
                $generalWork->position_ka = $data['position_ka'];
                $generalWork->position_en = $data['position_en'];
                $generalWork->position_ru = $data['position_ru'];
                $generalWork->object_ka = $data['object_ka'];
                $generalWork->object_en = $data['object_en'];
                $generalWork->object_ru = $data['object_ru'];
            }elseif ($data['has_experience']['id'] == 2) {
                $generalWork->no_reason_id = $data['no_reason']['id'];
                $generalWork->no_reason_info_ka = isset($data['no_reason_info_ka'])?$data['no_reason_info_ka']:null;
                $generalWork->no_reason_info_en = isset($data['no_reason_info_en'])?$data['no_reason_info_en']:null;
                $generalWork->no_reason_info_ru = isset($data['no_reason_info_ru'])?$data['no_reason_info_ru']:null;
            }
            $generalWork->save();
            $candidate = Candidate::where('id', $candidate->id)->with(['getGeneralWorkExperience.workExperience', 'getGeneralWorkExperience.noReason', 'getGeneralWorkExperience.hasExperience'])->first();
            if($candidate->stage = 4){
                $candidate->update(['stage' => 5]);
            }
            return [
                'success' => true,
                'data' => $candidate->getGeneralWorkExperience,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    function updateTranslate($data) {
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
        $data = $this->updateTranslate($data);
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
