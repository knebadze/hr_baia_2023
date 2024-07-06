<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $auth = Auth::guard('web')->User();
        $vacancyCount = Vacancy::whereIn('status_id', [2, 6, 7])->count();
        $view = 0;
        
        return view('home', compact('auth', 'vacancyCount', 'view'));
    }
}
