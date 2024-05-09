<?php


namespace App\Filters\Vacancy;



class PaymentFilter
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
            return $query->whereHas('category', function ($query) use ( $price ) {
                $query->where('payment', '>=', $price );
            });
        }else{
            return $query->whereHas('category', function ($query) {
                $query->where('payment', '<', 1000);
            });
        }


    }
}
