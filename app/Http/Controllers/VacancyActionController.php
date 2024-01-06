<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Models\RepeatHistory;
use Illuminate\Support\Facades\Auth;
use App\Services\VacancyStatusService;
use App\Services\VacancyUpdateService;
use App\Filters\Vacancy\Admin\VacancyFullFilters;
use App\Repositories\Vacancy\VacancyRedactedRepository;

class VacancyActionController extends Controller
{
    private VacancyUpdateService $vacancyUpdateService;
    private VacancyRedactedRepository $vacancyRedactedRepository;
    private VacancyStatusService $vacancyStatusService;
    public function __construct(VacancyUpdateService $vacancyUpdateService,
        VacancyRedactedRepository $vacancyRedactedRepository,
        VacancyStatusService $vacancyStatusService
    )
    {
        $this->vacancyUpdateService = $vacancyUpdateService;
        $this->vacancyRedactedRepository = $vacancyRedactedRepository;
        $this->vacancyStatusService = $vacancyStatusService;
    }
    public function update(Request $request) {
        $data = $request->data;
        $result = ['status' => 200];

        try {
            $result['data'] = $this->vacancyUpdateService->updateData($data);
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
            Vacancy::where('id', $data['id'])->update(['carry_in_head_date' => Carbon::now()->toDateTimeString()]);
            $result['data'] = $this->vacancyRedactedRepository->save($data['id'], $data['edit']);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);

    }

    function filter(VacancyFullFilters $filters){

        $vacancy = Vacancy::filter($filters)->orderby('carry_in_head_date', 'DESC')->with([
            'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer', 'currency','category', 'status',
            'workSchedule', 'vacancyInterest', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty',
            'employer.numberCode','deposit','hr.user', 'vacancyDrivingLicense'
            ])->when(Auth::user()->role_id != 1, function ($query) {
                $query->where('hr_id', '=', Auth::user()->hr->id);
            })->paginate(25);
            return response()->json($vacancy);

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

    function changeHr(Request $request) {
        // dd($request->all());
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


}
