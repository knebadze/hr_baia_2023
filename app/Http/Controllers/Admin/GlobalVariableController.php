<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GlobalVariableController extends Controller
{
    function index() {
        return view('admin.global_variable');
    }

}
