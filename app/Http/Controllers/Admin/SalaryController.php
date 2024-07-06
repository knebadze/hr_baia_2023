<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Salary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Filters\Salary\SalaryFilters;
use App\Models\Staff;
use App\Services\Admin\SalaryService;
use App\Traits\HandlesAdminDataViewCaching;

class SalaryController extends Controller
{
    use HandlesAdminDataViewCaching;
    private SalaryService $salaryService;
    public function __construct(SalaryService $salaryService)
    {
        $this->salaryService = $salaryService;
    }
    function index() {
        list($authId, $childView, $childeFilter, $adminViewAndPermission) = $this->viewAndPermission();

        $data = $this->salaryService->data($childView);
        $role_id = Auth::guard('staff')->user()->role_id;
        $staff = Staff::whereIn('role_id', [2, 4])->when($childeFilter, function ($query) use ($authId) {
            $ids = $this->getStaffIds($authId);
            return $query->whereIn('id', $ids);
        })->whereNot('is_active', 2)->get();
        return view('admin.salary', compact('data', 'role_id', 'staff'));
    }

    private function getStaffIds($parent_id) {
        return Staff::where('parent_id', $parent_id)->pluck('id');
    }
    private function viewAndPermission(){
        $auth = Auth::guard('staff')->user();
        $authId = $auth->id;
        $role_id = $auth->role_id;
        $childView = false;
        $childeFilter = false;
        $adminViewAndPermission = [];
        if ($role_id == 1) {
            $adminViewAndPermission = $this->getAdminDataViewByKeyAndUserId('Salary');
            $childView = $adminViewAndPermission->view == 'child';
            $childeFilter = $adminViewAndPermission->filter == 'child';
        }
        return [$authId, $childView, $childeFilter, $adminViewAndPermission];
    }
    function supplement(Request $request) {
        try {
            $data = $request->model;
            $result = Salary::where('id', $data['id'])->update(['supplement' => $data['supplement'], 'full_salary' => $data['total_salary']]);

            if ($result) {
                // Update successful
                return response()->json(['message' => 'Update successful']);
            } else {
                // Update failed
                return response()->json(['error' => 'Update failed'], 500); // Use an appropriate HTTP status code (e.g., 500 for Internal Server Error)
            }
        } catch (\Throwable $th) {
            // Handle any exceptions if needed
            return response()->json(['error' => $th->getMessage()], 500); // Use an appropriate HTTP status code
        }
    }

    function disbursementOfSalary(Request $request)  {
        try {
            $result = ['status' => 200];
            $data = $request->all();
            list($authId, $childView, $childeFilter, $adminViewAndPermission) = $this->viewAndPermission();
            $result['data'] = $this->salaryService->disbursement($data, $childView);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function staffAgreeSalary(Request $request) {
        try {
            $result = ['status' => 200];
            $result['data'] = Salary::where('id', $request->id)->update(['staff_agree' => 1]);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function filter(SalaryFilters $filters) {
        list($authId, $childView, $childeFilter, $adminViewAndPermission) = $this->viewAndPermission();
        $auth = Auth::guard('staff')->user();
        $threeMonthsAgo = Carbon::now()->subMonths(3);
        return Salary::filter($filters)
            ->when($auth->role_id !== 1, function ($query) use($auth) {
                return $query->where('staff_id', $auth->id);
            })->when($childeFilter, function ($query) use ($authId) {
                $ids = $this->getStaffIds($authId);
                return $query->whereIn('staff_id', $ids);
            })
            ->orderBy('created_at', 'ASC')
            ->With('staff')
            ->get()->toArray();
    }
}
