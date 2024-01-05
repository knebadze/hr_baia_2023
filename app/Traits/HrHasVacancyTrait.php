<?php
namespace App\Traits;

use Illuminate\Support\Facades\DB;


trait HrHasVacancyTrait
{
    public function getHasVacancyControl()
    {

        $hasVacancyControl = DB::table('hr_has_vacancies as a')
            ->orderBy('a.id', 'DESC')
            ->join('hrs as b', 'a.hr_id', 'b.id')
            ->join('users as c', 'b.user_id', 'c.id')
            ->select('a.*', 'c.name_ka as hr_name')
            ->get();
        // dd($hasVacancyControl);
        return $hasVacancyControl;
    }
}
