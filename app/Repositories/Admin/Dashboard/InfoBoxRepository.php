<?php

namespace App\Repositories\Admin\Dashboard;

use App\Models\Vacancy;
use App\Models\Candidate;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class InfoBoxRepository
{
    function data() {
        $data['vacancyCount'] = Vacancy::when(Auth::guard('staff')->user()->role_id !== 1, function ($query) {
                return $query->where('hr_id', Auth::guard('staff')->user()->id);
            })->count();
        $data['candidateCount'] = Candidate::count();
        $data['enRollmentCount'] = Enrollment::when(Auth::guard('staff')->user()->role_id !== 1, function ($query) {
                return $query->where('author_id', Auth::guard('staff')->id());
            })
            ->where('agree', 1)
            ->count();
        $successVacancy = Vacancy::when(Auth::guard('staff')->user()->role_id !== 1, function ($query) {
                return $query->where('hr_id', Auth::guard('staff')->user()->id);
            })
            ->whereIn('status_id', [3,4,13])
            ->count();
        $data['success'] = $successVacancy > 0 ? round(( $successVacancy / $data['vacancyCount'] ) * 100, 2): 0;
        return $data;
    }
}
