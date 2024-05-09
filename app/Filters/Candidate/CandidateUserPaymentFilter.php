<?php


namespace App\Filters\Candidate;



class CandidateUserPaymentFilter
{
    function __invoke($query, $id)
    {

        $priceMap = [
            1 => 1000,
            2 => 1500,
            3 => 1800,
            4 => null,
        ];

        // Check if the $id exists in the price map, and if so, get the corresponding price
        $price = $priceMap[$id] ?? null;
        if ($price !== null) {
            $query->whereHas('getWorkInformation', function ($query) use ($price) {
                $query->where('payment', '>=', $price);
            });
        }else{
            $query->whereHas('getWorkInformation', function ($query) {
                $query->where('payment', '<', 1000);
            });
        }
    }
}
