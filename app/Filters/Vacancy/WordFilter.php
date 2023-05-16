<?php


namespace App\Filters\Vacancy;


class WordFilter
{
    function __invoke($query, $word)
    {

        // dd($word);
        return $query->whereHas('category', function ($query) use ($word ) {
            // dd($query->where('title_ka', 'LIKE', '%'.$word.'%'));
            $query->where('title_ka', 'LIKE', '%'.$word.'%');
        });
    }
}
