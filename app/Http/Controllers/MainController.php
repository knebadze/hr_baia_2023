<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MainController extends Controller
{
    public function index()
    {
        // dd(app()->getLocale());
        return view ('welcome');
    }

}
