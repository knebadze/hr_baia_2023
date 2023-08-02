<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;
use App\Models\WorkInformation;
use Stichoza\GoogleTranslate\GoogleTranslate;

class WorkInformationUpdateRepository
{
    function translate($data)  {
        if ($data['additional_schedule_ka']) {
            $data['additional_schedule_en'] = GoogleTranslate::trans($data['additional_schedule_ka'], 'en');
            $data['additional_schedule_ru']  = GoogleTranslate::trans($data['additional_schedule_ka'], 'ru');
        }
        return $data;
    }
    function updateOrCreate($data){
        if (isset($data['additional_schedule_ka'])) {
            $data = $this->translate($data);
        }
        $workInformation = WorkInformation::updateOrCreate(
            [
                'candidate_id' => $data['candidate_id'],
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

        return $workInformation;
    }

    function delete($id)  {
        WorkInformation::findOrFail($id)->delete();
        return [];
    }
}

