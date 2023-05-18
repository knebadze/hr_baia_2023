<?php

namespace App\Repositories\Vacancy;

use App\Models\Vacancy;

use App\Models\Candidate;

class FindVacancyRepository{
    public function data($code)
    {
        $data = Vacancy::where('code', $code)->with(['author','currency', 'category', 'workSchedule', 'status'])->first();
        $interest = [];

        if ($data->vacancyInterest) {
            $interest = $this->interest($data->vacancyInterest);
        }
        return ['data' => $data, 'interest'=> $interest];
    }
    public function interest($data)
    {

        $ids = [];
        foreach ($data as $key => $value) {
            $ids[] = $value->user_id;
        }

        return Candidate::whereIn('user_id', $ids)->with(['user', 'workInformation'])->get();
    }
}
