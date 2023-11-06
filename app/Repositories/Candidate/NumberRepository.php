<?php

namespace App\Repositories\Candidate;

use App\Models\Additional_number;
use App\Models\Candidate;

class NumberRepository
{
    function save($data, $user_id) {
        // dd($data);
        try{
            $candidate = Candidate::where('user_id', $user_id)->first();
            $number = new Additional_number();
            $number->candidate_id = $candidate->id;
            $number->number_code_id = $data['number_code']['id'];
            $number->number = $data['number'];
            $number->number_owner_id = $data['number_owner']['id'];
            $number->save();
            $candidate = Candidate::where('user_id', $user_id)->with(['number.numberCode', 'number.numberOwner'])->first();
            if($candidate->stage = 3){
                $candidate->update(['stage' => 4]);
            }
            return [
                'success' => true,
                'data' => $candidate->number,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
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
