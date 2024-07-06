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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Http\Resources\DepositResource;
use App\Traits\HandlesAdminDataViewCaching;
use App\Services\Admin\VacancyDepositService;

class VacancyDepositController extends Controller
{
    use HandlesAdminDataViewCaching;
    private VacancyDepositService $vacancyDepositService;
    public function __construct(VacancyDepositService $vacancyDepositService)
    {
        $this->vacancyDepositService = $vacancyDepositService;
    }

    function index($id) {
        $auth = Auth::guard('staff')->user();
        $data = [
            'auth' => $auth,
            'adminViewAndPermission' => $auth->role_id == 1 ? $this->getAdminDataViewByKeyAndUserId('Deposit') : null,
        ];
    
        // Attempt to retrieve the deposit, or create a placeholder if it doesn't exist.
        if (VacancyDeposit::where('vacancy_id', $id)->exists()) {
            $data['deposit'] = new DepositResource(VacancyDeposit::where('vacancy_id', $id)->first());
        }else{
            $filed = Schema::getColumnListing('vacancy_deposits');
            $data['deposit'] = array_map(function ($item) { return null; }, array_flip($filed));
            $data['deposit']['vacancy_id'] = $id;
        }
    
        // Use Eloquent relationships to simplify data retrieval
        $vacancy = Vacancy::with(['employer', 'qualifyingCandidate', 'enrollments'])->findOrFail($id);
        $data['employer'] = $vacancy->employer->name_ka;
        $data['status'] = $vacancy->status_id;
    
        // Retrieve the latest qualifying candidate of specific types
        $qualifying = $vacancy->qualifyingCandidate()
                               ->whereIn('qualifying_type_id', [7, 8])
                               ->orderBy('id', 'DESC')
                               ->first();
    
        // Check if the qualifying candidate exists and has no registration fee
        $data['register'] = null;
        if ($qualifying && $qualifying->candidate->registration_fee == 0) {
            $data['register'] = RegistrationFee::where('user_id', $qualifying->candidate->user_id)->first();
        }
    
        // Retrieve enrollments that have not agreed
        $data['enrollment'] = $vacancy->enrollments()->where('agree', 0)->get()->toArray();
    
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
