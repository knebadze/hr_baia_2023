<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HrVacancyController extends Controller
{
    public function index()
    {
        return view('hr.hr_vacancy');
    }
}
