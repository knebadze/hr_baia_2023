<?php

namespace App\Services;

use App\Models\Vacancy;
use App\Models\QualifyingCandidate;
use Illuminate\Support\Facades\App;
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

        $this->sendSms($id, $qualifying->id);
        return ['type' => 's', 'qualifying' => $qualifying];
    }

    function sendSms($id, $qualifying_id = null)
    {
        $vacancy = Vacancy::where('id', $id)->first();
        $hrSmsData = ['to' => $vacancy->hr->user->number, 'code' => $vacancy->code, 'name' => Auth::user()->name_ka, 'id' => Auth::user()->candidate->id];

        $employerSmsData = ['to' => $vacancy->employer->number, 'link' =>route('candidate.photo.questionnaire', ['locale' => App::getLocale(), 'id' => $qualifying_id])];

        event(new SmsNotificationEvent($employerSmsData, 'interested_candidate_employer'));

        event(new SmsNotificationEvent($hrSmsData, 'interested_candidate_hr'));
    }

}
