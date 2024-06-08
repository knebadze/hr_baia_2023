<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnfinishedRegistration extends Controller
{
    function index() {
        return view('admin.unfinished_registration');
    }
}
