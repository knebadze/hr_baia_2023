<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    function index() {
        $data = Employer::orderBy('id', 'DESC')->paginate(25)->toArray();
        return view('admin.employer', compact('data'));
    }
}
