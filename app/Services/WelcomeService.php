<?php

namespace App\Services;

use App\Models\Vacancy;
use App\Models\Candidate;
use App\Models\Category;
use App\Models\WorkSchedule;
use Illuminate\Support\Facades\DB;

class WelcomeService
{
    function data() {
        $result = [];
        $slider = DB::table('vacancies as a')
            ->selectRaw('
                COUNT(CASE WHEN a.status_id != 5 THEN a.id ELSE NULL END) as vacancies,
                COUNT(DISTINCT CASE WHEN a.category_id != 8 AND b.for_who_need_id NOT IN (382, 385, 390) THEN a.ID ELSE NULL END) as familyVacancy,
                (SELECT COUNT(*) FROM candidates WHERE status_id IN (10, 11)) as candidateCount
            ')
            ->leftJoin('for_who_vacancies as b', 'a.id', 'b.vacancy_id')
            ->first();
        $result['slider'] = [
            'vacancies' => $slider->vacancies,
            'familyVacancy' => $slider->familyVacancy,
            'candidateCount' => $slider->candidateCount,
        ];
        $categoriesWithVacancies = DB::table('categories')
            ->leftJoin('vacancies', 'categories.id', '=', 'vacancies.category_id')
            ->select('categories.*', DB::raw('COUNT(CASE WHEN vacancies.status_id != 5 THEN vacancies.id ELSE NULL END) as count'))
            ->groupBy('categories.id')
            ->get()->toArray();
            $categoriesWithVacancies['type'] = 'vacancy';
        $result['categoriesWithVacancies'] = $categoriesWithVacancies;

        $categoriesWithCandidates = DB::table('categories')
            ->leftJoin('work_information', 'categories.id', '=', 'work_information.category_id')
            ->leftJoin('candidates', 'work_information.candidate_id', '=', 'candidates.id')
            ->select('categories.*', DB::raw('COUNT(CASE WHEN candidates.status_id NOT IN (8, 12) THEN candidates.id ELSE NULL END) as count'))
            ->groupBy('categories.id')
            ->get()->toArray();
        $categoriesWithCandidates['type'] = 'candidate';
        $result['categoriesWithCandidates'] = $categoriesWithCandidates;

        $popularCategories = DB::table('categories')
            ->select('categories.*', DB::raw('COUNT(CASE WHEN vacancies.status_id != 5 THEN vacancies.id ELSE NULL END)  as vacancy_count'))
            ->leftJoin('vacancies', 'categories.id', '=', 'vacancies.category_id')
            ->groupBy('categories.id') // Group by category columns
            ->orderByDesc('vacancy_count') // Order by vacancy count in descending order
            ->take(3) // Limit to the top 3 categories
            ->get();

        $result['popularCategories'] = $popularCategories;

        $popularVacancy = Vacancy::whereIn('status_id', [2, 6, 7])
                ->orderBy('view', 'DESC')
                ->with(['author','currency', 'category', 'workSchedule', 'vacancyForWhoNeed', 'vacancyBenefit', 'vacancyInterest', 'hr.user'])
                ->take(5)
                ->get()->toArray();

        $result['popularVacancy'] = $popularVacancy;

        $classificatory = [
            'category' => Category::all(),
            'work_schedule' => WorkSchedule::all()
        ];
        $result['classificatory'] = $classificatory;
        return $result;
    }
}
