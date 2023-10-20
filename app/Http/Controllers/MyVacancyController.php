<?php

namespace App\Http\Controllers;


use App\Models\QualifyingCandidate;
use Exception;
use Illuminate\Http\Request;
use App\Services\VacancyService;
use Illuminate\Support\Facades\DB;

class MyVacancyController extends Controller
{
    private VacancyService $vacancyService;

    public function __construct( VacancyService $vacancyService)
    {
        $this->vacancyService = $vacancyService;

    }
    public function index()
    {
        return view ('my_vacancy');
    }

    public function find(Request $request)
    {
        $code = $request->code;

        try {
            $result = $this->vacancyService->find($code);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }



        return response()->json($result);
    }



    public function getInterestData(Request $request)
    {
        $result = QualifyingCandidate::where('vacancy_id', $request->id)->where('qualifying_type_id', 2)
                ->with([ 'candidate.user'])
        // ->join('candidates', 'vacancy_interests.user_id', 'candidates.user_id')
        //             ->join('users', 'vacancy_interests.user_id', 'users.id')
        //             ->join('work_information', 'candidates.id', 'work_information.candidate_id')
        //             ->join('categories', 'work_information.category_id', 'categories.id')
        //             ->select('vacancy_interests.user_id', 'vacancy_interests.employer_answer', 'vacancy_interests.vacancy_id','vacancy_interests.id',
        //                     'candidates.address_ka', 'candidates.address_en', 'candidates.address_ru', 'candidates.id as candidate_id',
        //                     'users.name_ka as fullName_ka', 'users.name_en as fullName_en', 'users.name_ru as fullName_ru', 'users.avatar',
        //                     'categories.name_ka', 'categories.name_en', 'categories.name_ru',    )
                            ->get();
                            // dd($result);
        return response()->json($result);
    }

    public function doNotLike(Request $request)
    {

        try {
            QualifyingCandidate::where('id', $request['id'])->update(['employer_answer' => 0]);
            $result = '';
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }



        return response()->json($result);
    }



    public function like(Request $request)
    {
        try {
            QualifyingCandidate::where('id', $request['id'])->update(['employer_answer' => 1, 'qualifying_type_id' => 4]);

            $result = '';
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }
}
