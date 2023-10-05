<?php

namespace App\Repositories\Vacancy;

use App\Models\VacancyDeposit;

class VacancyDepositRepository
{
    function save($data) {
        $save = VacancyDeposit::updateOrCreate(
            ['vacancy_id' => $data['vacancy_id']],
            [
                'employer_initial_amount' => $data['employer_initial_amount'] ? $data['employer_initial_amount'] : 0,
                'must_be_enrolled_employer' => $data['employer_initial_amount'] ? $data['employer_initial_amount'] : 0,
                'must_be_enrolled_employer_date' => $data['must_be_enrolled_employer_date'],
                'candidate_initial_amount' => $data['candidate_initial_amount'] ? $data['candidate_initial_amount'] : 0,
                'must_be_enrolled_candidate' => $data['candidate_initial_amount'] ? $data['candidate_initial_amount'] : 0,
                'must_be_enrolled_candidate_date' => $data['must_be_enrolled_candidate_date'],
            ]
        );
        return $save;
    }

    function update($data){
        $deposit = VacancyDeposit::findOrFail($data['id']);
        if ($deposit->employer_initial_amount != $data['employer_initial_amount']) {
            if ($deposit->employer_initial_amount > $data['employer_initial_amount']) {
                $mustEmployer = $deposit->must_be_enrolled_employer - ($deposit->employer_initial_amount - $data['employer_initial_amount']);
            }else{
                $mustEmployer = $deposit->must_be_enrolled_employer + ($data['employer_initial_amount'] - $deposit->employer_initial_amount);
            }
        }else{
            $mustEmployer = $data['must_be_enrolled_employer'];
        }

        if ($deposit->candidate_initial_amount != $data['candidate_initial_amount']) {
            if ($deposit->candidate_initial_amount > $data['candidate_initial_amount']) {
                $mustCandidate = $deposit->must_be_enrolled_candidate - ($deposit->candidate_initial_amount - $data['candidate_initial_amount']);
            }else{
                $mustCandidate = $deposit->must_be_enrolled_candidate + ($data['candidate_initial_amount'] - $deposit->candidate_initial_amount);
            }
        }else{
            $mustCandidate = $data['must_be_enrolled_employer'];
        }
        $deposit->employer_initial_amount = $data['employer_initial_amount'];
        $deposit->must_be_enrolled_employer = $mustEmployer;
        $deposit->must_be_enrolled_employer_date = $data['must_be_enrolled_employer_date'];
        $deposit->candidate_initial_amount = $data['candidate_initial_amount'];
        $deposit->must_be_enrolled_candidate = $mustCandidate;
        $deposit->must_be_enrolled_candidate_date = $data['must_be_enrolled_candidate_date'];
        $deposit->update();
    }
}
