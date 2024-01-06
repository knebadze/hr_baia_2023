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
        // არააქტიური
        $is_no_active = $hasVacancyControl->where('is_active', 0);
        // ვაკანსია მიიღო
        $has_vacancy  = $hasVacancyControl->where('has_vacancy', 1)->where('re_write', 0);
        // რიგშია
        $is_active = $hasVacancyControl->where('is_active', 1);
        $is_in_line = $is_active->where('re_write', '<', 0)->where('re_write', $is_active->min('re_write'))->first();
        if(!$is_in_line){
            $filter = $is_active->where('re_write', 0)->where('has_vacancy', 0);
            $is_in_line = $filter->where('id',$filter->min('id'))->first();
            // dd($is_in_line);
        }
        //გადაეწერა
        $les_re_write = $hasVacancyControl->where('re_write', '>', 0);
        $result = [
            'is_no_active' => $is_no_active,
            'has_vacancy' => $has_vacancy,
            'is_in_line' => $is_in_line,
            'les_re_write' => $les_re_write,
            'hasVacancyControl' => $hasVacancyControl
        ];
        // dd($result);
        return $result;
    }
}
