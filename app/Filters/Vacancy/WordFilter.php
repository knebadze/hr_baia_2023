<?php


namespace App\Filters\Vacancy;



class WordFilter
{
    function __invoke($query, $word)
    {

        if (app()->getLocale() == 'ka') {
            return $query->whereHas('category', function ($query) use ($word ) {
                $query->where('title_ka', 'LIKE', '%'.$word.'%');
            });
        }elseif (app()->getLocale() == 'en') {
            return $query->whereHas('category', function ($query) use ($word ) {
                $query->where('title_en', 'LIKE', '%'.$word.'%');
            });
        }elseif (app()->getLocale() == 'ru') {
            return $query->whereHas('category', function ($query) use ($word ) {
                $query->where('title_ru', 'LIKE', '%'.$word.'%');
            });
        }

    }
}
