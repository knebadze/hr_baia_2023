<?php

namespace App\Http\Controllers\Admin\Vacancy;

use Exception;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Models\VacancyDeposit;
use App\Http\Controllers\Controller;
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
}
