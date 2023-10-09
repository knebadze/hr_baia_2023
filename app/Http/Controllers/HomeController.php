<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
        // dd(App::setLocale());
        // dd(app()->getLocale());
        $auth = Auth::User();
        $vacancyCount = Vacancy::whereIn('status_id', [2, 6, 7])->count();
        $view = 0;
        // $auth->candidate->view
        return view('home', compact('auth', 'vacancyCount', 'view'));
    }
}
