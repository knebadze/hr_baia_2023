<?php


namespace App\Filters\Vacancy;

use Illuminate\Support\Carbon;


class TimeFilter
{
    function __invoke($query, $id)
    {


        if ($id == 1) {
            $time = Carbon::now()->subHours(3);
            $start = substr_replace($time->toDateTimeString(), '00:00', 14, 5);
            $end = substr_replace($time->toDateTimeString(), '59:59', 14, 5);
            // dd($start, $end );
            return $query->whereHas('category', function ($query) use ($start, $end) {
                $query->whereBetween('updated_at', [ $start, $end ]);
            });
        }

    }
}
