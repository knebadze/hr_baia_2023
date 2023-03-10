<?php

namespace App\Http\Controllers\Employer;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\EmployerService;

class EmployerInfoController extends Controller
{
    private EmployerService $employerService;
    public function __construct(EmployerService $employerService)
    {
        $this->employerService = $employerService;
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->employerService->saveData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
