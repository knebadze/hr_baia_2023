<?php


namespace App\Filters\Vacancy;



class PaymentFilter
{
    function __invoke($query, $id)
    {

        if ($id == 1) {
            $price = 500;
        }elseif ($id == 2) {
            $price = 700;
        }elseif($id == 3){
            $price = 900;
        }
        return $query->whereHas('category', function ($query) use ( $price ) {
            $query->where('payment', '>=', $price );
        });

    }
}
