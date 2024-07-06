<?php

namespace App\Services;

use App\Models\Vacancy;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\WorkSchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class WelcomeService
{
    function data() {
        $result = [];
        $slider = Cache::remember('slider_data', 5 * 60, function () {
            return DB::table('vacancies as a')
                ->selectRaw('
                    COUNT(CASE WHEN a.status_id != 5 THEN a.id ELSE NULL END) as vacancies,

                    (SELECT COUNT(*) FROM candidates ) as candidateCount
                ')
                ->leftJoin('for_who_vacancies as b', 'a.id', 'b.vacancy_id')
                ->first();
        });
            // COUNT(DISTINCT CASE WHEN a.category_id != 8 AND b.for_who_need_id NOT IN (382, 385, 390) THEN a.ID ELSE NULL END) as familyVacancy,
        $result['slider'] = [
            'vacancies' => $slider->vacancies,
            // 'familyVacancy' => $slider->familyVacancy,
            'candidateCount' => $slider->candidateCount,
        ];
        $categoriesWithVacancies = DB::table('categories')
            ->leftJoin('vacancies', 'categories.id', '=', 'vacancies.category_id')
            ->select('categories.*', DB::raw('COUNT(CASE WHEN vacancies.status_id in (2) THEN vacancies.id ELSE NULL END) as count'))
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

        $testimonials = Cache::rememberForever('testimonials', function () {
            return Testimonial::where('active', 1)->get()->toArray();
        });
        $result['testimonial'] = $testimonials;

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
                ->with(['author','currency', 'category', 'workSchedule', 'vacancyForWhoNeed', 'vacancyBenefit', 'vacancyInterest', 'hr', 'qualifyingCandidate'])
                ->take(5)
                ->get()->toArray();

        $result['popularVacancy'] = $popularVacancy;

        $classificatoryArr = [
            'category',
            'workSchedule'
        ];
        $classificatoryService = new ClassificatoryService();
        $classificatory = $classificatoryService->get($classificatoryArr);
        $result['classificatory'] = $classificatory;
        return $result;
    }
}
