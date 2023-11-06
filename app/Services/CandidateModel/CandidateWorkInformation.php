<?php

namespace App\Services\CandidateModel;

use App\Models\Candidate;
use App\Models\WorkInformation;
use Illuminate\Support\Facades\Schema;

class CandidateWorkInformation
{
    function __invoke($user_id)
    {
        $candidate = Candidate::where('user_id', $user_id)->select('id')->first();
        $getWorkInformation = WorkInformation::where('candidate_id', $candidate->id)
            ->with(['category', 'workSchedule', 'currency'])
            ->get()
            ->toArray();
        $workInformationColumns = Schema::getColumnListing('work_information');
        $workInformation = array_merge(array_fill_keys($workInformationColumns, ''), [
            'category' => '',
            'currency' => '',
            'work_schedule' => '',
        ]);
        if(!$getWorkInformation){
            $getWorkInformation = [];

        }

        return ['getWorkInformation' => $getWorkInformation, 'workInformation' => $workInformation, 'candidate_id' => $candidate->id];
    }
}
