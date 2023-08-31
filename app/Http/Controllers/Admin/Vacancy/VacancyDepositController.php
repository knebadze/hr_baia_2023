<?php

namespace App\Http\Controllers\Admin\Vacancy;

use Exception;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Models\VacancyDeposit;
use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Services\VacancyUpdateService;

class VacancyDepositController extends Controller
{
    private VacancyUpdateService $vacancyUpdateService;
    public function __construct(VacancyUpdateService $vacancyUpdateService)
    {
        $this->vacancyUpdateService = $vacancyUpdateService;
    }
    function index($id) {
        $data['deposit'] = VacancyDeposit::where('vacancy_id', $id)->first();
        $vacancy = Vacancy::where('id',$id)->first();
        $data['employer'] = $vacancy->employer;
        if (Enrollment::where('vacancy_id', $vacancy->id)->exists()) {
            $data['enrollment'] = Enrollment::where('vacancy_id', $vacancy->id)->where('agree', 0)->get()->toArray();
        } else {
            $data['enrollment'] = null;
        }
        
        return view('admin.vacancy_deposit', compact('data'));
    }

    public function updateDeposit(Request $request) {
        $data = $request->data;
        $result = ['status' => 200];

        try {
            $result['data'] = $this->vacancyUpdateService->updateDepositData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function updateDate(Request $request) {
        $result = ['status' => 200];

        try {
            if ($request->type == 1) {
                $result['data'] = VacancyDeposit::where('id', $request->id)->update(['must_be_enrolled_candidate_date' => $request->date]);
            }else{
                $result['data'] = VacancyDeposit::where('id', $request->id)->update(['must_be_enrolled_employer_date' => $request->date]);
                // 'must_be_enrolled_employer' => (int)$request->enrolled, 
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    
}
