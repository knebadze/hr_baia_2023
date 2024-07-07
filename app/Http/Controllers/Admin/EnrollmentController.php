<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Staff;
use App\Models\Salary;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\VacancyDeposit;
use App\Models\RegistrationFee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Filters\Enrolled\EnrolledFilters;
use App\Services\Admin\EnrollmentService;
use App\Traits\HandlesAdminDataViewCaching;
use App\Filters\Enrollment\EnrollmentFilters;

class EnrollmentController extends Controller
{
    use HandlesAdminDataViewCaching;
    private EnrollmentService $enrollmentService;
    public function __construct(EnrollmentService $enrollmentService)
    {
        $this->enrollmentService = $enrollmentService;
    }
    function index() {
        list($authId, $childView, $childeFilter, $adminViewAndPermission) = $this->viewAndPermission();

        $salary = Salary::latest()->first();
        $data['hr'] = Staff::where('role_id', 2)->when($childeFilter, function ($query) use ($authId) {
            $ids = $this->getStaffIds($authId);
            return $query->whereIn('id', $ids);
        })->whereNot('is_active', 2)->get()->toArray();
        $data['start_date'] = $salary?$salary->created_at:null;
        $data['auth'] = Auth::guard('staff')->user();
        return view('admin.enrollment', compact( 'data'));
    }

    function enrollmentFetch() {
        list($authId, $childView, $childeFilter, $adminViewAndPermission) = $this->viewAndPermission();
        $staffUser = Auth::guard('staff')->user(); // Store the staff user for reuse

        $enrollmentsQuery = Enrollment::with(['vacancy:id,code', 'author:id,name_ka,parent_id']) // Assuming 'vacancy' and 'author' are the relationship names
            ->where('status_id', 17)
            ->when($staffUser->role_id !== 1, function ($query) use ($staffUser) {
                return $query->where('author_id', $staffUser->id);
            })
            ->when($childView, function ($query) use ($authId) {
                $ids = $this->getStaffIds($authId);
                return $query->whereIn('author_id', $ids);
            })
            ->orderBy('agree', 'ASC')
            ->paginate(20);

        $data = [
            'enrollment' => $enrollmentsQuery,
            'adminViewAndPermission' => $adminViewAndPermission,
        ];

        return response()->json($data);
    }


    function mustBeEnrollmentFetch() {
        list($authId, $childView, $childeFilter, $adminViewAndPermission) = $this->viewAndPermission();

        // Define the base queries for employer, candidate, and register
        $employer = $this->buildEmployerQuery();
        $candidate = $this->buildCandidateQuery();
        $register = $this->buildRegisterQuery();

        // Combine the queries using union
        $combinedQuery = $employer->union($candidate)->union($register);

        // Create a subquery from the combined queries and apply conditional filtering
        $query = VacancyDeposit::fromSub($combinedQuery, 'combined_query')
            ->when($childView, function ($query) use ($authId) {
                $ids = $this->getStaffIds($authId);
                // Assuming 'author_id' is a valid field in the combined result set
                return $query->whereIn('author_id', $ids);
            });
        $mustBeEnrollment = $query->paginate(20);
        $total = $query->count();
        $data = [
            'mustBeEnrollment' => $mustBeEnrollment,
            'total' => $total,
            'adminViewAndPermission' => $adminViewAndPermission,
        ];
        return response()->json($data);
    }

    // Example method for building the employer query part
    private function buildEmployerQuery() {
        return VacancyDeposit::whereNotNull('must_be_enrolled_employer_date')
        ->leftJoin('vacancies', 'vacancy_deposits.vacancy_id', '=', 'vacancies.id')
        ->join('staff', 'vacancies.hr_id', '=', 'staff.id')
        ->select(
            'vacancy_deposits.id as record_id',
            'vacancies.code as id',
            'must_be_enrolled_employer as money',
            'must_be_enrolled_employer_date as date',
            'bonus_percent',
            'vacancy_deposits.updated_at as updated_at',
            'staff.name_ka as author_name',
            'staff.id as author_id', // Add the author_id field
            'vacancy_deposits.created_at',
            DB::raw("'2' as type"),
            DB::raw("'2' as vacancy_type")
        );
    }

    private function buildCandidateQuery(){
        return VacancyDeposit::whereNotNull('must_be_enrolled_candidate_date')
        ->leftJoin('vacancies', 'vacancy_deposits.vacancy_id', '=', 'vacancies.id')
        ->join('staff', 'vacancies.hr_id', '=', 'staff.id')
        ->select(
            'vacancy_deposits.id as record_id',
            'vacancies.code as id',
            'must_be_enrolled_candidate as money',
            'must_be_enrolled_candidate_date as date',
            'bonus_percent',
            'vacancy_deposits.updated_at as updated_at',
            'staff.name_ka as author_name',
            'staff.id as author_id', // Add the author_id field
            'vacancy_deposits.created_at',
            DB::raw("'2' as type"),
            DB::raw("'1' as vacancy_type")
        );
    }

    private function buildRegisterQuery(){
        return RegistrationFee::whereNot('money', 0)
        ->join('users', 'registration_fees.user_id', '=', 'users.id')
        ->join('candidates', 'users.id', '=', 'candidates.user_id')
        ->join('staff', 'registration_fees.creator_id', '=', 'staff.id')
        ->select(
            'registration_fees.id as record_id',
            'candidates.id as id',
            'money as money',
            'enroll_date as date',
            'creator_id',
            'registration_fees.updated_at as updated_at',
            'staff.name_ka as author_name', // Assuming 'name_ka' is the field name
            'staff.id as author_id', // Add the author_id field
            'registration_fees.created_at',
            DB::raw("'1' as type"),
            DB::raw("'0' as type")
        );
    }

    private function viewAndPermission(){
        $auth = Auth::guard('staff')->user();
        $authId = $auth->id;
        $role_id = $auth->role_id;
        $childView = false;
        $childeFilter = false;
        $adminViewAndPermission = [];
        if ($role_id == 1) {
            $adminViewAndPermission = $this->getAdminDataViewByKeyAndUserId('Enrollment');
            $childView = $adminViewAndPermission->view == 'child';
            $childeFilter = $adminViewAndPermission->filter == 'child';
        }
        return [$authId, $childView, $childeFilter, $adminViewAndPermission];
    }
    private function getStaffIds($parent_id) {
        return Staff::where('parent_id', $parent_id)->pluck('id');
    }
    function vacancyEnrollment(Request $request) {
        $data['data'] = json_decode($request->input('data'), true);
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file');
        }

        try {
            $result = $this->enrollmentService->save('vacancy',$data);
            return response()->json(['data' => $result], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    function registerEnrolment(Request $request) {
        $data['data'] = json_decode($request->input('data'), true); // Add true as the second argument

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file');
        }

        try {
            if (isset($data['data']['vacancy_id'])) {
                $result = $this->enrollmentService->save('register',$data);
            } else {
                $result = $this->enrollmentService->registerFee($data);
            }

            return response()->json(['data' => $result], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    function update(Request $request) {
        $result = ['status' => 200];
        $data = $request->model;

        try {
            $result['data'] = $this->enrollmentService->update($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function agree(Request $request) {

        try {
            $result = ['status' => 200];
            $data = $request->model;
            $result['data'] = $this->enrollmentService->agree($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function filter(EnrollmentFilters $filters)
    {
        list($authId, $childView, $childeFilter, $adminViewAndPermission) = $this->viewAndPermission();

        $query = Enrollment::filter($filters)
            ->orderBy('agree', 'ASC')
            ->leftJoin('vacancies', 'enrollments.vacancy_id', '=', 'vacancies.id')
            ->join('staff', 'enrollments.author_id', '=', 'staff.id')
            ->select('enrollments.*', 'vacancies.code', 'users.name_ka');

        // Apply condition based on the role_id
        $query->when(Auth::guard('staff')->user()->role_id != 1, function ($q) {
            return $q->where('enrollments.author_id', Auth::guard('staff')->id());
        });

        // Apply condition based on the child filter
        $query->when($childeFilter, function ($q) use ($authId) {
            $ids = $this->getStaffIds($authId);
            return $q->whereIn('enrollments.author_id', $ids);
        });

        return $query->paginate(25)->toArray();
    }
    public function enrolledFilter(EnrolledFilters $filters)
    {
        list($authId, $childView, $childeFilter, $adminViewAndPermission) = $this->viewAndPermission();
    }
    function getRegisterEnrollmentInfo(Request $request) {
        $data = null;
        $user = User::where('id', $request->data)->first();
        if (Enrollment::where('candidate_id', $user->candidate->id)->where('agree', 0)->exists()) {
            $data = Enrollment::where('candidate_id', $user->candidate->id)->where('agree', 0)->first();
        }
        return response($data);
    }
}
