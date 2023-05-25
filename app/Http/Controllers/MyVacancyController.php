<?php

namespace App\Http\Controllers;

use App\Models\InterviewPlace;
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
        $message = '';
        if (DB::table('vacancy_interests')->where('vacancy_id', $request['id'])->exists()) {
            $message = 'თქვენ უკვე გააგზავნეთ დაინტერესება ამ ვაკანსიაზე';
        }else {
            DB::table('vacancy_interests')->insert([
                'vacancy_id' => $request['id'],
                'user_id' => Auth::id()
            ]);
            $message = 'თქვენ გააგზავნეთ დაინტერესება ვაკანისაზე';
        }

        return response()->json($message);
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

    public function getInterviewClassificatory()
    {
        $result = InterviewPlace::all();
        return response()->json($result);
    }

    public function like(Request $request)
    {
        $dateTime = $request['date'].' '.$request['time'];
        DB::table('vacancy_interests')->where('id', $request['id'])->update([
            'employer_answer' => 1,
            'interview_date' => $dateTime,
            'interview_place_id' => $request['place']['id'],
        ]);
    }
}
