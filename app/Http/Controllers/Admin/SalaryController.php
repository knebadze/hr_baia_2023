<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
        $data = $this->salaryService();
        $role_id = Auth::user()->role_id;
        return view('admin.salary', compact('data', 'role_id'));
    }
}
