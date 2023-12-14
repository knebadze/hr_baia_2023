<?php

namespace App\Repositories\Vacancy;

use App\Models\Vacancy;

use App\Models\Candidate;
use App\Models\Employer;
use App\Models\VacancyInterest;

class FindVacancyRepository{
    public function data($number)
    {
        $data = Employer::where('number', $number)
            ->whereHas('vacancy', function ($query) {
                return $query->whereNotIn('status_id', [4, 5, 13]);
            })
            ->with(['vacancy', 'vacancy.category', 'vacancy.currency',  'vacancy.workSchedule', 'vacancy.status', 'vacancy.vacancyInterest'])
            ->first();


        return $data->vacancy;
    }
}
