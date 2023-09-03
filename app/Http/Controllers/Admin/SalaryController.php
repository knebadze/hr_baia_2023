<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Salary;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\SalaryService;

class SalaryController extends Controller
{
    private SalaryService $salaryService;
    public function __construct(SalaryService $salaryService)
    {
        $this->salaryService = $salaryService;
    }
    function index() {
        $data = $this->salaryService->data();
        $role_id = Auth::user()->role_id;
        return view('admin.salary', compact('data', 'role_id'));
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
            // dd($request->all());
            $data = $request->all();
            $result['data'] = $this->salaryService->disbursement($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function hrAgreeSalary(Request $request) {
        // dd($request->id);
        try {
            $result = ['status' => 200];
            $result['data'] = Salary::where('id', $request->id)->update(['hr_agree' => 1]);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
