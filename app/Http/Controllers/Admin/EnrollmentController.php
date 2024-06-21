<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Salary;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\VacancyDeposit;
use App\Models\RegistrationFee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\EnrollmentService;
use App\Filters\Enrollment\EnrollmentFilters;

class EnrollmentController extends Controller
{
    private EnrollmentService $enrollmentService;
    public function __construct(EnrollmentService $enrollmentService)
    {
        $this->enrollmentService = $enrollmentService;
    }
    function index() {

        $salary = Salary::latest()->first();
        $data['hr'] = User::where('role_id', 2)->whereNot('is_active', 2)->get()->toArray();
        $data['start_date'] = $salary?$salary->created_at:null;
        $data['role_id'] = Auth::user()->role_id;
        return view('admin.enrollment', compact( 'data'));
    }

    function enrollmentFetch() {
        $data = Enrollment::where('enrollments.status_id', 17)
            ->when(Auth::user()->role_id !== 1, function ($query) {
                return $query->where('enrollments.author_id', Auth::id());
            })
            ->orderBy('agree', 'ASC')
            ->leftJoin('vacancies', 'enrollments.vacancy_id', '=', 'vacancies.id')
            ->join('users', 'enrollments.author_id', '=', 'users.id')
            ->select('enrollments.*', 'vacancies.code', 'users.name_ka')
            ->paginate(20);

        return response()->json($data);
    }

    function mustBeEnrollmentFetch(){

        $employer = VacancyDeposit::whereNotNull('must_be_enrolled_employer_date')
            ->leftJoin('vacancies', 'vacancy_deposits.vacancy_id', '=', 'vacancies.id')
            ->join('hrs', 'vacancies.hr_id', '=', 'hrs.id')
            ->select(
                'vacancy_deposits.id as record_id',
                'vacancies.code as id',
                'must_be_enrolled_employer as money',
                'must_be_enrolled_employer_date as date',
                'bonus_percent',
                'vacancy_deposits.updated_at as updated_at',
                DB::raw("'2' as type"),
                DB::raw("'2' as vacancy_type")
            );

        $candidate = VacancyDeposit::whereNotNull('must_be_enrolled_candidate_date')
            ->leftJoin('vacancies', 'vacancy_deposits.vacancy_id', '=', 'vacancies.id')
            ->join('hrs', 'vacancies.hr_id', '=', 'hrs.id')
            ->select(
                'vacancy_deposits.id as record_id',
                'vacancies.code as id',
                'must_be_enrolled_candidate as money',
                'must_be_enrolled_candidate_date as date',
                'bonus_percent',
                'vacancy_deposits.updated_at as updated_at',
                DB::raw("'2' as type"),
                DB::raw("'1' as vacancy_type")
            );

        $register = RegistrationFee::whereNot('money', 0)
            ->join('users', 'registration_fees.user_id', '=', 'users.id')
            ->join('candidates', 'users.id', '=', 'candidates.user_id')
            ->select(
                'registration_fees.id as record_id',
                'candidates.id as id',
                'money as money',
                'enroll_date as date',
                'creator_id',
                'registration_fees.updated_at as updated_at',
                DB::raw("'1' as type"),
                DB::raw("'0' as type")
            );

        $combinedQuery = $employer->union($candidate)->union($register);

        $data = VacancyDeposit::fromSub($combinedQuery, 'combined_query')
            ->paginate(20);


        return response()->json($data);
    }


    function vacancyEnrollment(Request $request) {
        $data['data'] = json_decode($request->input('data'));
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
        if (Auth::user()->role_id == 1) {
            return Enrollment::filter($filters)
                ->orderBy('agree', 'ASC')
                ->leftJoin('vacancies', 'enrollments.vacancy_id', '=', 'vacancies.id')
                ->join('users', 'enrollments.author_id', '=', 'users.id')
                ->select('enrollments.*', 'vacancies.code', 'users.name_ka')
                ->paginate(25)->toArray();
        } else {
            return Enrollment::filter($filters)
                ->where('enrollments.author_id', Auth::id())
                ->orderBy('agree', 'ASC')
                ->leftJoin('vacancies', 'enrollments.vacancy_id', '=', 'vacancies.id')
                ->join('users', 'enrollments.author_id', '=', 'users.id')
                ->select('enrollments.*', 'vacancies.code', 'users.name_ka')
                ->paginate(25)->toArray();
        }


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
