<?php

namespace App\Services;

use App\Models\Vacancy;
use App\Models\QualifyingCandidate;
use App\Events\SmsNotificationEvent;
use Illuminate\Support\Facades\Auth;

class InterestCandidateService
{

    function service($data)  {
        $result = [];
        if(!$data['check']){
            $result = $this->check($data['id']);
        }else{
            $result = $this->add($data['id']);

        }
        return $result;
    }
    function check($id) {
        $candidateCategory = Auth::user()->candidate->getWorkInformation->toArray();
        $vacancy = Vacancy::where('id', $id)->first();
        $containsId = collect($candidateCategory)->contains(function ($item) use($vacancy) {
            return $item['category_id'] === $vacancy->category_id;
        });
        if ($containsId) {
            return $this->add($id);
        } else {
            return ['type' => 'w'];
        }


        // dd($candidateCategory);
    }
    function add($id) {
        $qualifying = new QualifyingCandidate();
        $qualifying->vacancy_id = $id;
        $qualifying->qualifying_type_id = 2;
        $qualifying->candidate_id = Auth::user()->candidate->id;
        $qualifying->save();
        
        $this->sendSms($id);
        return ['type' => 's', 'qualifying' => $qualifying];
    }

    function sendSms($data)
    {
        event(new SmsNotificationEvent(['to' => auth()->user()->number], 'interested_candidate'));
        // event(new SmsNotificationEvent($data, 'interested_candidate_hr'));
    }

}
