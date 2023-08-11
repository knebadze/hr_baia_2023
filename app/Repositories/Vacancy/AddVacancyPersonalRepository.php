<?php

namespace App\Repositories\Vacancy;

use App\Models\QualifyingCandidate;

class AddVacancyPersonalRepository
{
    function add($data) {
        $qualifying = new QualifyingCandidate();
        $qualifying->vacancy_id = $data['vacancy_id'];
        $qualifying->qualifying_type_id = $data['type']['id'];
        $qualifying->candidate_id = $data['candidate_id'];
        if ($data['type']['id'] == 3) {
            $qualifying->interview_date = $data['interview_date'];
            $qualifying->interview_place_id = $data['interview_place']['id'];
        }
        if ($data['type']['id'] == 5) {
            $qualifying->start_date = $data['start_date'];
            $qualifying->end_date = $data['end_date'];
        }
        $qualifying->save();
        return $qualifying;
    }

    // function addOrUpdate($data) {
    //     // dd($data);
    //     if ($data['type']['id'] == 3) {
    //         $qualifying = QualifyingCandidate::updateOrCreate(
    //             ['vacancy_id' => $data['vacancy_id'], 'candidate_id' => $data['candidate_id']],
    //             [
    //                 'qualifying_type_id '=> $data['type']['id'],
    //                 'interview_date' => $data['interview_date'],
    //                 'interview_place' => $data['interview_place']['id']
    //             ]
    //         );
    //     }

    //     if ($data['type']['id'] == 5) {
    //         $qualifying = QualifyingCandidate::updateOrCreate(
    //             ['vacancy_id' => $data['vacancy_id'], 'candidate_id' => $data['candidate_id']],
    //             [
    //                 'qualifying_type_id '=> $data['type']['id'],
    //                 'start_date' => $data['start_date'],
    //                 'end_date' => $data['end_date'],
    //             ]
    //         );
    //     }
    //     // dd($data['type']['id']);
    //     $qualifying = QualifyingCandidate::updateOrCreate(
    //         ['vacancy_id' => $data['vacancy_id'], 'candidate_id' => $data['candidate_id']],
    //         [
    //             'qualifying_type_id '=> $data['type']['id']
    //         ]
    //     );
    //     return $qualifying;
    // }
    function addArr($data) {
        foreach ($data['candidate_id'] as $key => $value) {
            $qualifying = new QualifyingCandidate();
            $qualifying->vacancy_id = $data['vacancy_id'];
            $qualifying->qualifying_type_id = $data['type']['id'];
            $qualifying->candidate_id = $value;
            if ($data['type']['id'] == 3) {
                $qualifying->interview_date = $data['interview_date'];
                $qualifying->interview_place_id = $data['interview_place']['id'];
            }
            $qualifying->save();

        }
        return $qualifying;
    }

    function update($data) {
        $qualifying = QualifyingCandidate::where('candidate_id', $data['candidate_id'])->where('vacancy_id', $data['vacancy_id'])->first();
        $qualifying->qualifying_type_id = $data['type']['id'];
        if ($data['type']['id'] == 3) {
            $qualifying->interview_date = $data['interview_date'];
            $qualifying->interview_place_id = $data['interview_place']['id'];
        }
        if ($data['type']['id'] == 5) {
            $qualifying->start_date = $data['start_date'];
            $qualifying->end_date = $data['end_date'];
        }
        $qualifying->update();
        return $qualifying;
    }
    function updateArr($data) {
        foreach ($data['candidate_id'] as $key => $value) {
            $qualifying = QualifyingCandidate::where('candidate_id', $value)->where('vacancy_id', $data['vacancy_id'])->first();
            $qualifying->qualifying_type_id = $data['type']['id'];
            if ($data['type']['id'] == 3) {
                $qualifying->interview_date = $data['interview_date'];
                $qualifying->interview_place_id = $data['interview_place']['id'];
            }
            if ($data['type']['id'] == 5) {
                $qualifying->start_date = $data['start_date'];
                $qualifying->end_date = $data['end_date'];
            }
            $qualifying->update();
        }

        return $qualifying;
    }
    function delete($data) {
        if (gettype($data['candidate_id']) == 'array') {
            $qualifying = QualifyingCandidate::whereIn('candidate_id', $data['candidate_id'])->where('vacancy_id', $data['vacancy_id'])->delete();
            return $qualifying;
        }
        $qualifying = QualifyingCandidate::where('candidate_id', $data['candidate_id'])->where('vacancy_id', $data['vacancy_id'])->delete();
        return $qualifying;
    }

    function wasEmployed($data){
        // dd($data);
        $qualifying = QualifyingCandidate::updateOrCreate(
            ['candidate_id' => $data['candidate_id'], 'vacancy_id' => $data['vacancy_id']],
            ['qualifying_type_id' => 6]
        );
        return $qualifying;
    }
}
