<?php


namespace App\Filters\Candidate;



class CandidateUserPaymentFilter
{
    function __invoke($query, $id)
    {

        $priceMap = [
            1 => 500,
            2 => 700,
            3 => 900,
        ];

        // Check if the $id exists in the price map, and if so, get the corresponding price
        $price = $priceMap[$id] ?? null;
        if ($price !== null) {
            $query->whereHas('getWorkInformation', function ($query) use ($price) {
                $query->where('payment', '>=', $price);
            });
        }
    }
}
