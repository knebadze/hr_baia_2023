<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;

class LanguageUpdateRepository
{
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
