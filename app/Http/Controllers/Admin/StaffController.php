<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\HrHasVacancy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HrRequest;
use App\Http\Requests\StaffRequest;
use App\Models\Hr;
use App\Models\Staff;
use App\Services\Admin\StaffService;

class StaffController extends Controller
{
    protected $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }


    public function isActiveUpdate(Request $request)
    {
        try {
            $user = Staff::find($request->id);
            if ($user) {
                $user->update(['is_active' => $request->is_active]);
                $user->refresh(); // Refresh the user instance to get the updated is_active status

                if ($user->role_id == 2) {
                    HrHasVacancy::where('hr_id', $request->hr_id)->update(['is_active' => $request->is_active]);
                }
                $result['is_active'] = $user->is_active;
                $result['message'] = ($user->is_active == 1) ? $user->name_ka . ' აქტიურია' : $user->name_ka . ' არა აქტიურია';
                return response()->json($result);
            }

            return response()->json('User not found', 404);
        } catch (\Exception $e) {
            // Log the exception or return a response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function store(StaffRequest $request)
    {
        try {
            $data = $request->validated();
            // $data = $request->all();
            $result = $this->staffService->addOrUpdateStaff($data);

            return response()->json([
                'status' => 200,
                'data' => $result,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    function update(Request $request)  {
        // $data = $request->all();
        // return response()->json([
        //     'status' => 200,
        //     'data' => $data['internship'],
        // ]);
        try {
            $data = $request->all();
            $result = $this->staffService->addOrUpdateStaff($data);

            return response()->json([
                'status' => 200,
                'data' => $result,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    function dismissalFormService(Request $request) {
        try {
            $data = $request->all();
            // $result = $this->staffService->dismissalFormService($data);

            return response()->json([
                'status' => 200,
                // 'data' => $result,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
