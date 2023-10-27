<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Http\Request;
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

        $data = $this->enrollmentService->pageData();
        $role_id = Auth::user()->role_id;
        return view('admin.enrollment', compact('data', 'role_id'));
    }

    function vacancyEnrollment(Request $request) {
        $data['data'] = json_decode($request->input('data'));
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file');
        }
        $result = ['status' => 200];

        try {
            // dd($data);
            $result['data'] = $this->enrollmentService->save('vacancy',$data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function registerEnrolment(Request $request) {
        $data['data'] = json_decode($request->input('data'));
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file');
        }
        $result = ['status' => 200];

        try {
            $result['data'] = $this->enrollmentService->save('register',$data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
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
