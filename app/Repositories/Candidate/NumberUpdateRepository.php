<?php

namespace App\Repositories\Candidate;

use App\Models\Additional_number;
use App\Models\Candidate;

class NumberUpdateRepository
{
    function update($data){
        foreach ($data as $key => $value) {
            Additional_number::updateOrCreate(
                [
                    'candidate_id' => $value['candidate_id'],
                    'number_owner_id' => $value['number_owner']['id']
                ],
                [
                    'number_code_id' => $value['number_code']['id'],
                    'number' => $value['number']
                ]
            );
        }

        return [];
    }
}
