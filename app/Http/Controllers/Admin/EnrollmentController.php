<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\EnrollmentService;

class EnrollmentController extends Controller
{
    private EnrollmentService $enrollmentService;
    public function __construct(EnrollmentService $enrollmentService)
    {
        $this->enrollmentService = $enrollmentService;
    }
    function index() {
        $data = $this->enrollmentService->pageData();
        return view('admin.enrollment', compact('data'));
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
        $result = ['status' => 200];
        $data = $request->id;

        try {
            $result['data'] = $this->enrollmentService->agree($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
