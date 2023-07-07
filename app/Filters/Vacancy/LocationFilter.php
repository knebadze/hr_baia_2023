<?php


namespace App\Filters\Vacancy;



class LocationFilter
{
    function __invoke($query, $location)
    {
        // dd($location);
        if (app()->getLocale() == 'ka') {
            return $query->whereHas('category', function ($query) use ($location ) {
                $query->join('employers', 'author_id', 'employers.id')
                ->where('employers.address_ka', 'LIKE', '%'.$location.'%');
            });
        }elseif (app()->getLocale() == 'en') {
            return $query->whereHas('category', function ($query) use ($location ) {
                $query->join('employers', 'author_id', 'employers.id')
                ->where('employers.address_en', 'LIKE', '%'.$location.'%');
            });
        }elseif (app()->getLocale() == 'ru') {
            return $query->whereHas('category', function ($query) use ($location ) {
                $query->join('employers', 'author_id', 'employers.id')
                ->where('employers.address_ru', 'LIKE', '%'.$location.'%');
            });
        }

    }
}
