<?php

namespace App\Http\Controllers\Admin;

use App\Models\Staff;
use App\Models\Vacancy;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\ClassificatoryService;
use App\Traits\HandlesAdminDataViewCaching;

class AdminVacancyController extends Controller
{
    use HandlesAdminDataViewCaching;
    private ClassificatoryService $classificatoryService;
    public function __construct( ClassificatoryService $classificatoryService)
    {
        $this->classificatoryService = $classificatoryService;
    }
    public function index()
    {
        $classificatoryArr = ['currency', 'workSchedule', 'educations', 'characteristic', 'educations','vacancy_profession','drivingLicense',
        'category', 'forWhoNeed', 'term', 'benefit', 'languages', 'languageLevels', 'duty', 'interviewPlace', 'status', 'hr', 'reasonForCancel'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $classificatory['specialties'] = $classificatory['vacancy_profession'];
        $role_id = Auth::guard('staff')->user()->role_id;
        if ($role_id == 1) {
            $data = ['classificatory' => $classificatory, 'roleId' => $role_id];
        }else{
            $hr_id = Auth::guard('staff')->user()->id;
            $data = ['classificatory' => $classificatory, 'roleId' => $role_id, 'hrId' => $hr_id];
        }

        return view('admin.vacancy', compact('data'));
    }

    public function getData() {
        $auth = Auth::guard('staff')->user();
        $authId = $auth->id;
        $role_id = $auth->role_id;

        // Simplified conditional logic
        $childView = false;
        $adminViewAndPermission = [];
        if ($role_id == 1) {
            $adminViewAndPermission = $this->getAdminDataViewByKeyAndUserId('Vacancy');
            $childView = $adminViewAndPermission->view == 'child';
        }

        // Load only necessary relationships and apply conditions efficiently
        $vacancyQuery = Vacancy::orderBy('carry_in_head_date', 'DESC')
            ->with([
                'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic',
                'employer', 'currency', 'category', 'status', 'workSchedule',
                'vacancyInterest', 'interviewPlace', 'term', 'demand',
                'demand.language', 'demand.education', 'demand.languageLevel',
                'demand.specialty', 'employer.numberCode', 'deposit', 'hr',
                'vacancyDrivingLicense', 'reasonForCancel', 'registrant'
            ])
            ->when($role_id == 2, function ($query) use ($authId) {
                $query->where('hr_id', $authId);
            })
            ->when($childView, function ($query) use ($authId) {
                $ids = $this->getStaffIds($authId);
                $query->whereIn('hr_id', $ids);
            });

        $vacancy = $vacancyQuery->paginate(20);
        $totalVacancies = $vacancy->total();

        return response()->json([
            'vacancy' => $vacancy,
            'count' => $totalVacancies,
            'adminViewAndPermission' => $adminViewAndPermission
        ]);
    }

    private function getStaffIds($parent_id) {
        return Staff::where('parent_id', $parent_id)->pluck('id');
    }

}
