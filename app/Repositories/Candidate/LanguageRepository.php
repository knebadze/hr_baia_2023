<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;
use App\Models\CandidateLanguage;

class LanguageRepository
{
    function save($data, $user_id) {
        try{
            $candidate = Candidate::where('user_id', $user_id)->first();
            $language = new CandidateLanguage();
            $language->candidate_id = $candidate->id;
            $language->language_id = $data['language']['id'];
            $language->language_level_id = $data['level']['id'];
            $language->save();

            if($candidate->stage = 2){
                $candidate->update(['stage' => 3]);
            }
            $candidate = Candidate::where('user_id', $user_id)->with(['getLanguage.language', 'getLanguage.level'])->first();

            return [
                'success' => true,
                'data' => $candidate->getLanguage,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    function update($data){
        $candidate = Candidate::findOrFail($data[0]['candidate_id']);
        $selectLanguage = collect($data)->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[$item["language"]["id"]] = ["language_level_id" => $item["level"]["id"]];
            return $carry;
        }, []);
        $candidate->languages()->sync($selectLanguage);

        return $candidate;
    }
}
