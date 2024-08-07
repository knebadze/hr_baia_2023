<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;
use App\Models\FamilyWorkExperience;
use App\Services\TranslationService;
use Illuminate\Support\Facades\Auth;

class FamilyWorkExperienceRepository
{

    public function translate($lang, $data)
    {
        // Specify the fields you want to translate
        $fieldsToTranslate = ['no_reason_info'];

        // Use the TranslationService to translate the fields
        $translate = new TranslationService();
        $data = $translate->translateFields($lang, $data, $fieldsToTranslate);

        return $data;
    }
    function updateOrCreate($data){
        try{
            $candidate_id = $data['candidate_id'] ? $data['candidate_id']: Auth::guard('web')->user()->candidate->id;

            if ($data["has_experience"]['id'] == 1) {
                if (FamilyWorkExperience::where('candidate_id', $candidate_id)->exists() && FamilyWorkExperience::where('candidate_id', $candidate_id)->where('experience', 2)->exists()) {
                    FamilyWorkExperience::where('candidate_id', $candidate_id)->delete();
                }
                $familyWork = FamilyWorkExperience::updateOrCreate(
                    ['candidate_id' => $candidate_id],
                    [
                        'experience' => $data['has_experience']['id'],
                        'families_worked_count' => $data['families_worked_count'],
                        'longest_time' => $data['longest']['id'],
                        'work_experience_id' => $data['work_experience']['id'],
                    ],
                );


                $selectDutyId = collect($data['family_work_duty'])->reduce(function ($carry, $item) {
                    if($carry  == null) $carry = [];
                    $carry[] = $item["id"];
                    return $carry;
                }, []);
                $familyWork->familyWorkDuty()->sync($selectDutyId);

                $selectCategoryId = collect($data['family_work_category'])->reduce(function ($carry, $item) {
                    if($carry  == null) $carry = [];
                    $carry[] = $item["id"];
                    return $carry;
                }, []);
                $familyWork->familyWorkCategory()->sync($selectCategoryId);
            }else{
                if (FamilyWorkExperience::where('candidate_id', $candidate_id)->exists() && FamilyWorkExperience::where('candidate_id', $candidate_id)->where('experience', 1)->exists()) {
                    FamilyWorkExperience::where('candidate_id', $candidate_id)->delete();
                }
                if (isset($data['no_reason_info_ka'])) {
                    $lang = (isset($data['lang']))?$data['lang']:'ka';
                    $data = $this->translate($lang, $data);
                }
                FamilyWorkExperience::updateOrCreate(
                    ['candidate_id' => $candidate_id],
                    [
                        'experience' => $data["has_experience"]['id'],
                        'no_reason_id' => $data['no_reason']['id'],
                        'no_reason_info_ka' => $data['no_reason_info_ka'],
                        'no_reason_info_en' => $data['no_reason_info_en'],
                        'no_reason_info_ru' => $data['no_reason_info_ru'],
                    ]
                );
            }
            $candidate = Candidate::where('id', $candidate_id)->first();
            if($candidate->stage == 6){
                $candidate->update(['stage' => 7]);
            }
            return [
                'success' => true,
                'data' => [],
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

}
