<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;
use App\Models\WorkInformation;
use Illuminate\Support\Facades\Auth;
use Stichoza\GoogleTranslate\GoogleTranslate;

class WorkInformationRepository
{
    function translate($lang, $data)  {
        if ($lang == 'ka') {
            if ($data['additional_schedule_ka']) {
                $data['additional_schedule_en'] = GoogleTranslate::trans($data['additional_schedule_ka'], 'en');
                $data['additional_schedule_ru']  = GoogleTranslate::trans($data['additional_schedule_ka'], 'ru');
            }
        }elseif ($lang == 'en') {
            if ($data['additional_schedule_en']) {
                $data['additional_schedule_ka'] = GoogleTranslate::trans($data['additional_schedule_en'], 'ka');
                $data['additional_schedule_ru']  = GoogleTranslate::trans($data['additional_schedule_en'], 'ru');
            }

        }elseif ($lang == 'ru') {
            if ($data['additional_schedule_ru']) {
                $data['additional_schedule_ka'] = GoogleTranslate::trans($data['additional_schedule_ru'], 'ka');
                $data['additional_schedule_en']  = GoogleTranslate::trans($data['additional_schedule_ru'], 'en');
            }
        }

        return $data;
    }
    function updateOrCreate($data){
        // dd($dataqar);
        if (isset($data['additional_schedule_ka'])) {
            $lang = (isset($data['lang']))?$data['lang']:'ka';
            $data = $this->translate($lang, $data);
        }
        $candidate_id = $data['candidate_id'] ? $data['candidate_id']: Auth::user()->candidate->id;
        // dd($data);
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

        // if (Auth::user()->role_id == 3) {
            $this->candidateStatusUpdate($candidate_id);
        // }

        return [];
    }

    function delete($id)  {
        WorkInformation::findOrFail($id)->delete();
        return [];
    }

    public function candidateStatusUpdate($id)
    {
        $candidate = Candidate::find($id);
        if ($candidate->status_id == 1) {
            $candidate->update([
                'status_id' => 9,
                'updated_at' => now()
            ]);
        }
    }
}

