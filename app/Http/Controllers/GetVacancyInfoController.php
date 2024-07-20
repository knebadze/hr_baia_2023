<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use App\Models\DrivingLicense;
use App\Models\Duty;
use App\Models\ForWhoNeed;
use App\Models\GeneralCharacteristic;
use App\Models\Status;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ClassificatoryService;
use Spatie\Activitylog\Models\Activity;

class GetVacancyInfoController extends Controller
{
    private ClassificatoryService $classificatoryService;
    public function __construct(ClassificatoryService $classificatoryService)
    {
        $this->classificatoryService = $classificatoryService;
    }

    public function getClassificatory(Request $request){

        $classificatoryArr = ['numberOwner', 'currency', 'workSchedule', 'educations', 'characteristic', 'numberCode',
        'category', 'forWhoNeed', 'term', 'benefit','vacancy_profession', 'languages', 'languageLevels', 'duty', 'interviewPlace', 'status', 'drivingLicense'];

        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $classificatory['specialties'] = $classificatory['vacancy_profession'];
        return response()->json($classificatory);
    }

    function getVacancyFilterClassificatory(){
        $classificatoryArr = ['currency', 'workSchedule', 'educations', 'characteristic',
        'category', 'forWhoNeed', 'term', 'benefit','specialties', 'languages', 'languageLevels', 'duty', 'interviewPlace', 'status'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        return response()->json($classificatory);
    }

    public function statusChangeInfo(Request $request) {
        $classificatory = $this->classificatoryService->get(['reasonForCancel']);
        $history = Activity::where('subject_id', $request->data)
            ->where('description', 'updated')
            ->where('event', 'updated')
            ->whereRaw("json_extract(properties, '$.old.status_id') IS NOT NULL")
            ->whereRaw("json_extract(properties, '$.attributes.status_id') IS NOT NULL")
            ->leftJoin('staff', 'staff.id', 'activity_log.causer_id')
            ->select('properties', 'activity_log.created_at', 'staff.name_ka')
            ->get()
            ->toArray();
        $data = [
            'history' => $history,
            'status' => Status::whereNotIn('id', [1, 4, 13])->where('status_type_id', 1)->get()->toArray(),
            'role_id' => Auth::guard('staff')->user()->role_id,
            'reasonForCancel' => $classificatory['reasonForCancel']];
        return response()->json($data);
    }



    function getVacancyFullInfo(Request $request)  {
        $vacancy = Vacancy::where('id', $request->data)
            ->orWhere('code', $request->data)
            ->with([
                'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer.additionalNumbers.numberCode', 'employer.additionalNumbers.numberOwner', 'currency','category', 'status',
                'workSchedule', 'vacancyInterest', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty',
                'employer.numberCode','deposit','hr', 'vacancyDrivingLicense', 'reasonForCancel', 'registrant'
            ])->first();

        $role_id = Auth::guard('staff')->user()->role_id;
        $hr_id = ($role_id == 2)?Auth::guard('staff')->user()->id:null;

        $data = ['vacancy' => $vacancy, 'hr_id' => $hr_id, 'role_id' => $role_id];

        return response()->json($data);
    }

    function vacancyRedactedHistory(Request $request) {
        $vacancy = Vacancy::with('employer', 'demand', 'deposit')
            ->where('id', $request->data)
            ->firstOrFail();

        $auditableIds = [
            $vacancy->id,
            optional($vacancy->employer)->id,
            optional($vacancy->demand)->id,
            optional($vacancy->deposit)->id,
        ];

        $data = Activity::orderBy('activity_log.id', 'DESC')
            // ->whereNot('event', 'created')
            ->whereIn('subject_id', array_filter($auditableIds))
            ->leftJoin('staff', 'staff.id', 'activity_log.causer_id')
            ->select('activity_log.*', 'staff.name_ka', 'staff.role_id')
            ->get()
            ->map(function ($value) {
                $models = [
                    'Sync_for_who_need' => [ForWhoNeed::class, 'name_ka'],
                    'Sync_duty' => [Duty::class, 'name_ka'],
                    'Sync_driving_license' => [DrivingLicense::class, 'name'],
                    'Sync_characteristic' => [GeneralCharacteristic::class, 'name_ka'],
                    'Sync_benefit' => [Benefit::class, 'name_ka'],
                ];

                if (isset($models[$value['description']])) {
                    [$model, $columnName] = $models[$value['description']];
                    $value['properties']['old'] = $model::whereIn('id', $value['properties']['old'])->pluck($columnName)->toArray();
                    $value['properties']['attributes'] = $model::whereIn('id', $value['properties']['attributes'])->pluck($columnName)->toArray();
                }

                return $value;
            })
            ->toArray();

        return response()->json($data);
    }
    // function vacancyRedactedHistory(Request $request) {
    //     $vacancy = Vacancy::where('id', $request->data)->first();
    //     $vacancyId = $vacancy->id;
    //     $employerId = $vacancy->employer->id;
    //     $demandId = $vacancy->demand->id ?? '';
    //     $depositId = $vacancy->deposit->id ?? '';
    //     $auditableIds = [$vacancyId, $employerId, $depositId, $demandId];

    //     $data = Activity::orderBy('activity_log.id', 'DESC')
    //         ->whereNot('event', 'created')
    //         ->whereIn('subject_id', $auditableIds)
    //         ->leftJoin('users', 'users.id', 'activity_log.causer_id')
    //         ->select('activity_log.*', 'users.name_ka', 'users.role_id')
    //         ->get()->toArray();
    //     foreach ($data as &$value) {
    //         switch ($value['description']) {
    //             case 'Sync_for_who_need':
    //                 $model = ForWhoNeed::class;
    //                 $columnName = 'name_ka';
    //                 break;
    //             case 'Sync_duty':
    //                 $model = Duty::class;
    //                 $columnName = 'name_ka';
    //                 break;
    //             case 'Sync_driving_license':
    //                 $model = DrivingLicense::class;
    //                 $columnName = 'name';
    //                 break;
    //             case 'Sync_characteristic':
    //                 $model = GeneralCharacteristic::class;
    //                 $columnName = 'name_ka';
    //                 break;
    //             case 'Sync_benefit':
    //                 $model = Benefit::class;
    //                 $columnName = 'name_ka';
    //                 break;
    //             default:
    //                 $model = null;
    //                 $columnName = null;
    //                 break;
    //         }

    //         if ($model !== null && $columnName !== null) {
    //             $value['properties']['old'] = $model::whereIn('id', $value['properties']['old'])->pluck($columnName)->toArray();
    //             $value['properties']['attributes'] = $model::whereIn('id', $value['properties']['attributes'])->pluck($columnName)->toArray();
    //         }
    //     }
    //     return response()->json($data);
    // }



    function findVacancy(Request $request) {
        $data = Vacancy::where('code', 'LIKE', $request->data.'%')
                ->where('status_id', 2)
                ->with(['employer', 'category', 'status', 'hr', 'interviewPlace'])
                ->get()->toArray();
        return response()->json($data);
    }

}
