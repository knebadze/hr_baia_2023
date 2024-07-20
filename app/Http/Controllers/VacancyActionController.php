<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Models\RepeatHistory;
use Illuminate\Support\Facades\Auth;
use App\Services\VacancyStatusService;
use App\Services\VacancyUpdateService;
use App\Traits\HandlesAdminDataViewCaching;
use App\Filters\Vacancy\Admin\VacancyFullFilters;
use App\Models\EmployerAdditionalNumber;

class VacancyActionController extends Controller
{
    use HandlesAdminDataViewCaching;
    private VacancyUpdateService $vacancyUpdateService;
    private VacancyStatusService $vacancyStatusService;
    public function __construct(VacancyUpdateService $vacancyUpdateService,
        VacancyStatusService $vacancyStatusService
    )
    {
        $this->vacancyUpdateService = $vacancyUpdateService;
        $this->vacancyStatusService = $vacancyStatusService;
    }
    public function update(Request $request) {
        $data = $request->data;
        $result = ['status' => 200];

        try {
            $result['data'] = $this->vacancyUpdateService->updateData($data, $request->ip());
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }



    public function updateStatus(Request $request){
        $data = $request->data;
        $result = ['status' => 200];

        try {
            $result['data'] = $this->vacancyStatusService->service($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }




    function carryInHead(Request $request){
        $data = $request->data;
        $result = ['status' => 200];

        try {
            $result['data'] = Vacancy::where('id', $data['id'])->update(['carry_in_head_date' => Carbon::now()->toDateTimeString()]);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);

    }

    function filter(VacancyFullFilters $filters){

        $auth = Auth::guard('staff')->user();
        $authId = $auth->id;
        $role_id = $auth->role_id;

        // Simplified conditional logic
        $childFilter = false;
        $adminViewAndPermission = [];
        if ($role_id == 1) {
            $adminViewAndPermission = $this->getAdminDataViewByKeyAndUserId('Vacancy');
            $childFilter = $adminViewAndPermission->filter == 'child';
        }
        $vacancy = Vacancy::filter($filters)->orderby('carry_in_head_date', 'DESC')->with([
            'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer.additionalNumbers.numberCode', 'employer.additionalNumbers.numberOwner', 'currency','category', 'status',
            'workSchedule', 'vacancyInterest', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty',
            'employer.numberCode','deposit','hr', 'vacancyDrivingLicense', 'reasonForCancel', 'registrant'
            ])->when($role_id != 1, function ($query) use($authId) {
                $query->where('hr_id', '=', $authId);
            })
            ->when($childFilter, function ($query) use ($authId) {
                $ids = $this->getStaffIds($authId);
                $query->whereIn('hr_id', $ids);
            })->paginate(25);

        $totalVacancies = $vacancy->total();

        return response()->json(['vacancy' => $vacancy, 'count' => $totalVacancies]);

    }
    private function getStaffIds($parent_id) {
        return Staff::where('parent_id', $parent_id)->pluck('id');
    }
    function delete(Request $request)  {

        $result = ['status' => 200];

        try {
            if($request->check){
                $result['data'] = RepeatHistory::where('old_vacancy_id', $request->id)->exists();
            }else{
                RepeatHistory::where('old_vacancy_id', $request->id)->delete();
                Vacancy::where('id', $request->id)->delete();
                $result['data'] = [];
            }

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function deleteAdditionalNumber($id) {
        $result = ['status' => 200];

        try {
            $result['data'] = EmployerAdditionalNumber::find($id)->delete();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function changeHr(Request $request) {
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->vacancyUpdateService->updateHr($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function vacancyDashboardFilter(VacancyFullFilters $filters) {
        $vacancy = Vacancy::filter($filters)->orderby('carry_in_head_date', 'DESC')->with([
            'employer', 'currency','category', 'status', 'hr'
            ])->paginate(25);

        $totalVacancies = $vacancy->total();

        return response()->json(['vacancy' => $vacancy, 'count' => $totalVacancies]);
    }

}
