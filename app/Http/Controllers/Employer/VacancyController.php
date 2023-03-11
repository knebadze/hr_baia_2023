<?php

namespace App\Http\Controllers\Employer;

use Exception;
use Illuminate\Http\Request;
use App\Services\VacancyService;
use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{
    private VacancyService $vacancyService;
    public function __construct(VacancyService $vacancyService)
    {
        $this->vacancyService = $vacancyService;
    }
    public function index()
    {
        $vacancy = Vacancy::where('author_id', Auth::id())->with(['category', 'status', 'workSchedule'])->get();
        $data = [
            'model' => [
                'vacancy' => $vacancy
            ],
            'classificator' => [

            ]
        ];
        return view('user.vacancy', compact('data'));
    }
    public function store(Request $request)
    {

        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->vacancyService->saveData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
