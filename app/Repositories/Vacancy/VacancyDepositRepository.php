<?php

namespace App\Repositories\Vacancy;

use App\Models\VacancyDeposit;

class VacancyDepositRepository
{
    function save($data, $type) {
        // dd($type);
        if($type == 'employer'){
            $save = VacancyDeposit::updateOrCreate(
                ['vacancy_id' => $data['vacancy_id']],
                [
                    'employer_initial_amount' =>  $data['initial_amount'],
                    'must_be_enrolled_employer' => $data['initial_amount'] ,
                    'must_be_enrolled_employer_date' => $data['must_be_enrolled_date'] ,
                ]
            );
        }else if($type == 'candidate'){
            $save = VacancyDeposit::updateOrCreate(
                ['vacancy_id' => $data['vacancy_id']],
                [
                    'candidate_initial_amount' =>  $data['initial_amount'],
                    'must_be_enrolled_candidate' => $data['initial_amount'],
                    'must_be_enrolled_candidate_date' => $data['must_be_enrolled_date'],
                ]
            );
        }

        return $save;
    }

    function update($data, $type){
        // dd($data);
        $deposit = VacancyDeposit::findOrFail($data['id']);
        // კანდიდატის ჩარიცხვა
        if($type == 'candidate'){
            // როცა ბაზიდან  მოსული ციფრი არ უდრის რედაქტირების დროს გამოგზავნილს
            $mustCandidate = 0;
            if ($deposit->candidate_initial_amount != $data['initial_amount']) {
                if ($deposit->candidate_initial_amount > $data['initial_amount']) {
                    $mustCandidate = $deposit->must_be_enrolled_candidate - ($deposit->candidate_initial_amount - $data['initial_amount']);
                }else{
                    $mustCandidate = $deposit->must_be_enrolled_candidate + ($data['initial_amount'] - $deposit->candidate_initial_amount);
                }
            }else{
                $mustCandidate = $data['must_be_enrolled'];
            }
            $deposit->candidate_initial_amount = $data['initial_amount'];
            $deposit->must_be_enrolled_candidate = $mustCandidate;
            $deposit->must_be_enrolled_candidate_date = $data['must_be_enrolled_date'];
        }else{
            if ($deposit->employer_initial_amount != $data['initial_amount']) {
                if ($deposit->employer_initial_amount > $data['initial_amount']) {
                    $mustEmployer = $deposit->must_be_enrolled_employer - ($deposit->employer_initial_amount - $data['initial_amount']);
                }else{
                    $mustEmployer = $deposit->must_be_enrolled_employer + ($data['initial_amount'] - $deposit->employer_initial_amount);
                }
            }else{
                $mustEmployer = $data['must_be_enrolled'];
            }
            $deposit->employer_initial_amount = $data['initial_amount'];
            $deposit->must_be_enrolled_employer = $mustEmployer;
            $deposit->must_be_enrolled_employer_date = $data['must_be_enrolled_date'];
        }

        $deposit->update();
    }

}
