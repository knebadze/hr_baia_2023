<?php


namespace App\Filters\Vacancy;


class CategoryFilter
{
    function __invoke($query, $category)
    {
        $ids = [];
        foreach ($category as $key => $value) {
            $ids[] = $value['id'];
        }
        return $query->whereHas('category', function ($query) use ($ids ) {
            $query->whereIn('category_id', $ids);
        });
    }
}
