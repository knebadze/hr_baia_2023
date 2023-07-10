<?php

namespace App\Repositories\Vacancy;

use App\Models\QualifyingCandidate;

class AddVacancyPersonalRepository
{
    function add($data) {
        // dd($data);
        $interest = new QualifyingCandidate();
        $interest->vacancy_id = $data['vacancy_id'];
        $interest->qualifying_type_id = $data['type']['id'];
        $interest->candidate_id = $data['candidate_id'];
        if ($data['type']['id'] == 3) {
            $interest->interview_date = $data['interview_date'];
            $interest->interview_place = $data['interview_place']['id'];
        }
        $interest->save();
        return $interest;
    }

    function update($data) {
        $interest = QualifyingCandidate::where('candidate_id', $data['candidate_id'])->where('vacancy_id', $data['vacancy_id'])->first();
        $interest->qualifying_type_id = $data['type']['id'];
        if ($data['type']['id'] == 3) {
            $interest->interview_date = $data['interview_date'];
            $interest->interview_place = $data['interview_place']['id'];
        }
        $interest->save();
        return $interest;
    }
}
