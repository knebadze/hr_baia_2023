<?php

namespace App\Repositories\Vacancy;

use App\Models\Vacancy;

use App\Models\Candidate;
use App\Models\VacancyInterest;

class FindVacancyRepository{
    public function data($code)
    {
        $data = Vacancy::where('code', $code)->with(['author','currency', 'category', 'workSchedule', 'status', 'vacancyInterest'])->first();
        $interest = VacancyInterest::where('vacancy_id', $data->id)
                    ->join('candidates', 'vacancy_interests.user_id', 'candidates.user_id')
                    ->join('users', 'vacancy_interests.user_id', 'users.id')
                    ->join('work_information', 'candidates.id', 'work_information.candidate_id')
                    ->join('categories', 'work_information.category_id', 'categories.id')
                    ->select('vacancy_interests.user_id', 'vacancy_interests.employer_answer', 'vacancy_interests.vacancy_id','vacancy_interests.id',
                            'candidates.address_ka', 'candidates.address_en', 'candidates.address_ru', 'candidates.id as candidate_id',
                            'users.name_ka as fullName_ka', 'users.name_en as fullName_en', 'users.name_ru as fullName_ru', 'users.avatar',
                            'categories.name_ka', 'categories.name_en', 'categories.name_ru',    )
                    ->get();

        return ['data' => $data, 'interest'=> $interest];
    }
}
