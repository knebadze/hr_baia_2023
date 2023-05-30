<?php

namespace App\Http\Controllers;

use App\Models\InterviewPlace;
use App\Models\VacancyInterest;
use Exception;
use Illuminate\Http\Request;
use App\Services\VacancyService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MyVacancyController extends Controller
{
    private VacancyService $vacancyService;
    public function __construct( VacancyService $vacancyService)
    {

        $this->vacancyService = $vacancyService;
    }
    public function index()
    {
        return view ('vacancy_detail');
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


    public function interest(Request $request)
    {
            DB::table('vacancy_interests')->insert([
                'vacancy_id' => $request['id'],
                'user_id' => Auth::id()
            ]);

        $interest = new VacancyInterest();
        $interest->vacancy_id = $request['id'];
        $interest->user_id = Auth::id();
        $interest->save();
        $data = VacancyInterest::where('id', $interest->id)->first();

        return response()->json($data);
    }
    public function getInterestData(Request $request)
    {
        $result = VacancyInterest::where('vacancy_id', $request->id)
        ->join('candidates', 'vacancy_interests.user_id', 'candidates.user_id')
                    ->join('users', 'vacancy_interests.user_id', 'users.id')
                    ->join('work_information', 'candidates.id', 'work_information.candidate_id')
                    ->join('categories', 'work_information.category_id', 'categories.id')
                    ->select('vacancy_interests.user_id', 'vacancy_interests.employer_answer', 'vacancy_interests.vacancy_id','vacancy_interests.id',
                            'candidates.address_ka', 'candidates.address_en', 'candidates.address_ru', 'candidates.id as candidate_id',
                            'users.name_ka as fullName_ka', 'users.name_en as fullName_en', 'users.name_ru as fullName_ru', 'users.avatar',
                            'categories.name_ka', 'categories.name_en', 'categories.name_ru',    )->get();
        return response()->json($result);
    }

    public function doNotLike(Request $request)
    {

        try {
            DB::table('vacancy_interests')->where('id', $request['id'])->update(['employer_answer' => 0]);
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
            DB::table('vacancy_interests')->where('id', $request['id'])->update(['employer_answer' => 1]);
            $result = '';
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }
}
