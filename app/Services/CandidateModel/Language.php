<?php

namespace App\Services\CandidateModel;

use App\Models\Candidate;

class Language {
    function __invoke($user_id)
    {
        $query = Candidate::where('user_id', $user_id)
            ->with([
                'getLanguage.language',
                'getLanguage.level'
            ])
            ->first()->toArray();
        return ['id' => $query['id'], 'user_id' => $query['user_id'], 'get_language' => $query['get_language']];
    }
}
