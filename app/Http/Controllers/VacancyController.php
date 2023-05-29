<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Services\VacancyService;
use Illuminate\Support\Facades\Auth;
use App\Filters\Vacancy\VacancyFilters;
use App\Services\ClassificatoryService;

class VacancyController extends Controller
{
    private ClassificatoryService $classificatoryService;
    private VacancyService $vacancyService;
    public function __construct(ClassificatoryService $classificatoryService, VacancyService $vacancyService)
    {
        $this->classificatoryService = $classificatoryService;
        $this->vacancyService = $vacancyService;
    }

    public function index()
    {

        $classificatoryArr = ['category', 'workSchedule'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $data = [
            'classificatory' => $classificatory
        ];
        return view ('individual', compact('data'));
    }
    public function data(Request $request)
    {

        $vacancy = Vacancy::orderby('updated_at', 'DESC')->with(['author','currency', 'category', 'workSchedule', 'vacancyForWhoNeed', 'vacancyBenefit'])->paginate(20)->toArray();
        $countVacancy = Vacancy::orderby('updated_at', 'DESC')->count();
        $auth = Auth::user();
        $data = [
            'vacancy' => $vacancy,
            'count' => $countVacancy,
            'auth' => $auth
        ];
        return response($data);
    }

    public function filter(VacancyFilters $filters)
    {
        $vacancy = Vacancy::filter($filters)->orderby('updated_at', 'DESC')->with(['author','currency', 'category', 'workSchedule'])->paginate(20);
        $countVacancy = Vacancy::filter($filters)->count();
        $data = [
            'vacancy' => $vacancy,
            'count' => $countVacancy
        ];
        return $data;
    }


}
