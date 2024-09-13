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
use Illuminate\Support\Facades\Cache;
use App\Models\EnrollmentCancelReason;
use Illuminate\Support\Facades\Schema;
use App\Http\Resources\DepositResource;
use App\Traits\HandlesAdminDataViewCaching;
use App\Services\Admin\VacancyDepositService;
use App\Http\Resources\RegistrationFeeResource;
use App\Repositories\Enrollment\EnrollmentAgreeRepository;

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

        // Retrieve or create a placeholder for the deposit
        $vacancyDeposit = VacancyDeposit::where('vacancy_id', $id)->first();
        if ($vacancyDeposit) {
            $data['deposit'] = new DepositResource($vacancyDeposit);
        } else {
            $fields = Schema::getColumnListing('vacancy_deposits');
            $data['deposit'] = array_fill_keys($fields, null);
            $data['deposit']['vacancy_id'] = $id;
            $data['deposit']['cancel_reason'] = null;
        }

        // Use Eloquent relationships to simplify data retrieval
        $vacancy = Vacancy::with(['employer', 'qualifyingCandidate', 'enrollments'])->findOrFail($id);
        $data['employer'] = $vacancy->employer->name_ka;
        $data['status'] = $vacancy->status_id;

        // Retrieve the latest qualifying candidate of specific types
        $qualifying = $vacancy->qualifyingCandidate()
                               ->whereIn('qualifying_type_id', [7, 8])
                               ->latest('id')
                               ->first();

        // Check if the qualifying candidate exists and has no registration fee
        $data['register'] = null;
        if ($qualifying && $qualifying->candidate->registration_fee == 0) {
            $registrationFee = RegistrationFee::where('user_id', $qualifying->candidate->user_id)->first();
            $data['register'] = $registrationFee ? new RegistrationFeeResource($registrationFee) : null;
        }

        // Retrieve enrollments that have not agreed
        $data['enrollment'] = $vacancy->enrollments()->where('agree', 0)->get()->toArray();

         // Cache the EnrollmentCancelReason data forever
        $data['reasonsCl'] = Cache::rememberForever('enrollment_cancel_reasons', function () {
            return EnrollmentCancelReason::all();
        });

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

    public function saveDepositCancel(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'data' => 'required|array',
                // Add other validation rules as needed
            ]);

            // Process the deposit cancellation
            $depositData = $validatedData['data'];
            if ($depositData['type'] == 'registration'){
                $register = RegistrationFee::find($depositData['id']);
                $register->cancel_other_reason = $depositData['cancel_reason'];
                $register->cancel_reason_id = $depositData['cancel_reason_id']['id'];
                $register->save();
                $candidate = Candidate::where('id', $register->candidate_id)->first();
                $candidate->registration_fee = 1;
                $candidate->save();
                $check = $this->checkDepositCancel($depositData['vacancy_id']);
                if($check){
                    $this->updateVacancyStatus($depositData['vacancy_id']);
                }

                return response()->json(['message' => 'Deposit cancellation saved successfully'], 200);
            }
            // Perform the necessary actions with $depositData
            $deposit = VacancyDeposit::find($depositData['id']);
            $check = false;
            if ($depositData['type'] == 'candidate') {
                $deposit->candidate_cancel_other_reason = $depositData['cancel_reason'];
                $deposit->candidate_cancel_reason_id = $depositData['cancel_reason_id']['id'];
                if($deposit->employer_cancel_reason_id !== null){
                    $check = true;
                    // $this->updateVacancyStatus($depositData['vacancy_id']);
                }
            } else {
                $deposit->employer_cancel_other_reason = $depositData['cancel_reason'];
                $deposit->employer_cancel_reason_id = $depositData['cancel_reason_id']['id'];
                if($deposit->candidate_cancel_reason_id !== null){
                    $check = true;
                }
            }

            $deposit->save();
            if($check){
                $checkRegisterFee = $this->checkRegisterFee($depositData['vacancy_id']);
                if($checkRegisterFee ){
                    $this->updateVacancyStatus($depositData['vacancy_id']);
                }
            }

            // Return a response
            return response()->json(['message' => 'Deposit cancellation saved successfully'], 200);
        } catch (\Exception $e) {
            // Handle the exception and return an error response
            return response()->json(['error' => 'An error occurred while saving the deposit cancellation', 'details' => $e->getMessage()], 500);
        }
    }

    private function checkDepositCancel($vacancy_id)
    {
        $deposit = VacancyDeposit::where('vacancy_id', $vacancy_id)->first();

        if ($deposit) {
            if ($deposit->candidate_cancel_reason_id || $deposit->employer_cancel_reason_id) {
                return true;
            }
        }else{
            return false;
        }
    }

    private function checkRegisterFee($vacancy_id)
    {
        $candidate = QualifyingCandidate::where('vacancy_id', $vacancy_id)->whereIn('qualifying_type_id', [7, 8])->first();
        if($candidate){
            $candidate_id = $candidate->candidate_id;
        }else{
            return false;
        }
        $candidate = Candidate::where('id', $candidate_id)->first();

        if ($candidate) {
            if ($candidate->user->registration_fee->cancel_reason_id !== null) {
                return true;
            }
        }else{
            return false;
        }
    }

    private function updateVacancyStatus($vacancy_id)
    {
        Vacancy::where('id', $vacancy_id)->update(['status_id' => 4]);

        $enrolmentFunction = new EnrollmentAgreeRepository();
        $enrolmentFunction->deleteReminder($vacancy_id);
        $enrolmentFunction->deleteDeposit($vacancy_id);
    }


}
