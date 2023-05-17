<?php


namespace App\Filters\Vacancy;

use Illuminate\Support\Carbon;


class TimeFilter
{
    function __invoke($query, $id)
    {

        if ($id == 1) {
            $subHours = 3;
        }elseif ($id == 2) {
            $subHours = 7;
        }elseif($id == 3){
            $subHours = 24;
        }

        $start = Carbon::now()->subHours($subHours)->toDateTimeString();
        $end = Carbon::now()->toDateTimeString();
        return $query->whereHas('category', function ($query) use ( $start, $end ) {
            $query->whereBetween('updated_at', [$start, $end]);
        });

    }
}
