<?php

namespace App\Http\Controllers\Admin\Vacancy;

use Exception;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Models\VacancyDeposit;
use App\Http\Controllers\Controller;
use App\Services\Admin\EnrollmentService;
use App\Services\VacancyUpdateService;

class VacancyDepositController extends Controller
{
    private VacancyUpdateService $vacancyUpdateService;
    private EnrollmentService $enrollmentService;
    public function __construct(VacancyUpdateService $vacancyUpdateService, EnrollmentService $enrollmentService)
    {
        $this->vacancyUpdateService = $vacancyUpdateService;
        $this->enrollmentService = $enrollmentService;
    }
    function index($id) {
        $data['deposit'] = VacancyDeposit::where('vacancy_id', $id)->first();
        $vacancy = Vacancy::where('id',$id)->first();
        $data['employer'] = $vacancy->employer;
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
        // dd((int)$request->enrolled);
        $result = ['status' => 200];

        try {
            if ($request->type == 1) {
                $result['data'] = VacancyDeposit::where('id', $request->id)->update(['must_be_enrolled_candidate' => (int)$request->enrolled, 'must_be_enrolled_candidate_date' => $request->date]);
            }else{
                $result['data'] = VacancyDeposit::where('id', $request->id)->update(['must_be_enrolled_employer' => (int)$request->enrolled, 'must_be_enrolled_employer_date' => $request->date]);
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function vacancyEnrollment(Request $request) {
        $data['data'] = json_decode($request->input('data'));
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file');
        }
        $result = ['status' => 200];

        try {
            $result['data'] = $this->enrollmentService->save('vacancy',$data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
    function registerEnrolment(Request $request) {
        $data['data'] = json_decode($request->input('data'));
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file');
        }
        $result = ['status' => 200];

        try {
            $result['data'] = $this->enrollmentService->save('register',$data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
