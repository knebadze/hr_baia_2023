<?php

namespace App\Repositories\Admin\Dashboard;

use App\Models\Vacancy;
use App\Models\Candidate;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class InfoBoxRepository
{
    function data() {
        $auth = Auth::guard('staff')->user();
        $authId = $auth->id;
        $isAdmin = $auth->role_id === 1;
        $data['vacancyCount'] = Vacancy::when(!$isAdmin, function ($query) use($authId) {
                return $query->where('hr_id', $authId);
            })->when($isAdmin, function ($query) use ($authId) {
                return $query->whereHas('hr', function ($query) use ($authId) {
                    $query->where('parent_id', $authId);
                });
            })->count();

        $data['candidateCount'] = Candidate::count();

        $data['enRollmentCount'] = Enrollment::when(!$isAdmin, function ($query) use($authId) {
                return $query->where('author_id', $authId);
            })->when($isAdmin, function ($query) use ($authId) {
                return $query->whereHas('author', function ($query) use ($authId) {
                    $query->where('parent_id', $authId);
                });
            })
            ->where('agree', 0)
            ->count();

        $successVacancy = Vacancy::when(!$isAdmin, function ($query) use($authId) {
                return $query->where('hr_id', $authId);
            })->when($isAdmin, function ($query) use ($authId) {
                return $query->whereHas('hr', function ($query) use ($authId) {
                    $query->where('parent_id', $authId);
                });
            })
            ->whereIn('status_id', [ 3, 4, 13 ])
            ->count();

        $data['success'] = $successVacancy > 0 ? round(( $successVacancy / $data['vacancyCount'] ) * 100, 2): 0;
        return $data;
    }
}
