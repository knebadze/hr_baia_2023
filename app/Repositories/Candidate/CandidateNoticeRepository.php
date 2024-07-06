<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;
use App\Models\CandidateNotice;

class CandidateNoticeRepository
{
    function save($data) {
        try{
            $candidate = Candidate::where('user_id', $data['data']->user_id)->first();
            $notice = new CandidateNotice();
            $notice->candidate_id = $candidate->id;
            $notice->notice_id = $data['data']->notice->id;
            if (isset($data['file'])) {
                $filePath = $data['file']->store('user_documentation', 'public');
            }
            if (isset($filePath)) {
                $notice->file_path = $filePath;
                $notice->file = $data['data']->file;
            }
            $notice->save();

            if($candidate->stage = 8){
                $candidate->update(['stage' => 9]);
            }
            $candidate = Candidate::where('user_id', $data['data']->user_id)->with('getNotice.notice')->first();
            return [
                'success' => true,
                'data' => $candidate->getNotice,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}
