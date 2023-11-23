<?php

namespace App\Http\Controllers\Admin\Vacancy;

use Exception;
use App\Models\Vacancy;
use App\Models\Candidate;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\VacancyDeposit;
use App\Models\RegistrationFee;
use App\Models\QualifyingCandidate;
use App\Http\Controllers\Controller;
use App\Services\Admin\VacancyDepositService;
use Illuminate\Support\Facades\Schema;

class VacancyDepositController extends Controller
{
    private VacancyDepositService $vacancyDepositService;
    public function __construct(VacancyDepositService $vacancyDepositService)
    {
        $this->vacancyDepositService = $vacancyDepositService;
    }
    function index($id) {
        if (VacancyDeposit::where('vacancy_id', $id)->exists()) {
            $data['deposit'] = VacancyDeposit::where('vacancy_id', $id)->first();
        }else{
            $filed = Schema::getColumnListing('vacancy_deposits');
            $data['deposit'] = array_map(function ($item) { return null; }, array_flip($filed));
            $data['deposit']['vacancy_id'] = $id;
        }

        $vacancy = Vacancy::where('id',$id)->first();
        $data['employer'] = $vacancy->employer->name_ka;
        $data['status'] = $vacancy->status_id;
        $qualifying = QualifyingCandidate::orderBy('id', 'DESC')->where('vacancy_id', $vacancy->id)->whereIn('qualifying_type_id', [5, 6, 7])->first();
        // dd($vacancy);
        // dd(Candidate::where('id', $qualifying->candidate->id)->where('registration_fee', 0)->exists());
        $data['register'] = ($qualifying && Candidate::where('id', $qualifying->candidate->id)->where('registration_fee', 0)->exists())? RegistrationFee::where('user_id', $qualifying->candidate->user_id)->first(): null;
        $data['enrollment'] = $qualifying && Enrollment::where('vacancy_id', $vacancy->id)->exists()? Enrollment::where('vacancy_id', $vacancy->id)->where('agree', 0)->get()->toArray(): null;

        return view('admin.vacancy_deposit', compact('data'));
    }

    function save(Request $request) {
        $data = $request->data;
        $result = ['status' => 200];

        try {
            $result['data'] = $this->vacancyDepositService->save($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function updateDeposit(Request $request) {
        $data = $request->data;
        $result = ['status' => 200];

        try {
            $result['data'] = $this->vacancyDepositService->update($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function updateDate(Request $request) {
        // dd($request->id);
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
