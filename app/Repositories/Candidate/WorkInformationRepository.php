<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;
use App\Models\WorkInformation;
use App\Services\TranslationService;
use Illuminate\Support\Facades\Auth;
use Stichoza\GoogleTranslate\GoogleTranslate;

class WorkInformationRepository
{
    public function translate($lang, $data)
    {
        // Specify the fields you want to translate
        $fieldsToTranslate = ['additional_schedule'];

        // Use the TranslationService to translate the fields
        $translate = new TranslationService();
        $data = $translate->translateFields($lang, $data, $fieldsToTranslate);

        return $data;
    }
    function updateOrCreate($data){
        try{
            if (isset($data['additional_schedule_ka']) || isset($data['additional_schedule_en']) || isset($data['additional_schedule_ru'])) {
                $lang = (array_key_exists('lang', $data))?$data['lang']:app()->getLocale();
                $data = $this->translate($lang, $data);
            }
            $candidate_id = $data['candidate_id'] ? $data['candidate_id']: Auth::guard('web')->user()->candidate->id;
            $workInformation = WorkInformation::updateOrCreate(
                [
                    'candidate_id' => $candidate_id,
                    'category_id' => $data['category']['id']
                ],
                [
                    'payment' => $data['payment'],
                    'currency_id' => $data['currency']['id'],
                    'stay_night' => ($data['stay_night'] == true)?1:$data['stay_night'],
                    'go_vacation' => ($data['go_vacation'] == true)?1:$data['go_vacation'],
                    'work_additional_hours' => ($data['work_additional_hours'] == true)?1:$data['work_additional_hours'],
                ]
            );

            $selectSchedule = collect($data['work_schedule'])->reduce(function ($carry, $item) {
                if($carry  == null) $carry = [];
                $carry[] = $item['id'];
                return $carry;
            }, []);
            $workInformation->workSchedule()->sync( $selectSchedule );


            // $this->candidateStatusUpdate($candidate_id);

            $candidate = Candidate::where('id', $candidate_id)->with(['getWorkInformation.category', 'getWorkInformation.currency', 'getWorkInformation.workSchedule'])->first();

            if($candidate->stage == 5){
                $candidate->update(['stage' => 6, 'status_id' => 9]);
            }
            return [
                'success' => true,
                'data' => $candidate->getWorkInformation,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    function delete($id)  {
        WorkInformation::findOrFail($id)->delete();
        return [];
    }

    public function candidateStatusUpdate($id)
    {
        $candidate = Candidate::where('id', $id)->first();
        if ($candidate->status_id == 1) {
            $candidate->update([
                'status_id' => 9,
                'updated_at' => now()
            ]);
        }
    }
}

