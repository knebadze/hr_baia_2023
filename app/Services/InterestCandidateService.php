<?php

namespace App\Services;

use App\Models\Vacancy;
use App\Models\QualifyingCandidate;
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

        return ['type' => 's', 'qualifying' => $qualifying];
    }
}
