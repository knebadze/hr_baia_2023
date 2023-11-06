<?php

namespace App\Services\CandidateModel;

use App\Models\Candidate;

class Address {
    function __invoke($user_id)
    {

        $query = Candidate::where('user_id', $user_id)->select('id', 'user_id', 'address_ka', 'address_en', 'address_ru', 'street_ka', 'street_en', 'street_ru', 'latitude', 'longitude')->first();

        return $query;
    }
}
