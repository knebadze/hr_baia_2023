<?php

namespace App\Http\Controllers\Candidate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WorkInformationController extends Controller
{
    public function index(){
        $data = [];
        $auth = Auth::user();
        $data = [
            'auth', $auth
        ];

        return view('user.work_information', compact('data'));
    }
}
