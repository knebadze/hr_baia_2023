<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\WelcomeService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    private WelcomeService $welcomeService;
    public function __construct(WelcomeService $welcomeService)
    {
        $this->welcomeService = $welcomeService;
    }
    public function index()
    {
        // dd(app()->getLocale());
        $data = $this->welcomeService->data();
        $auth = User::where('id', Auth::id())->with('candidate')->first();
        return view ('welcome', compact('data', 'auth'));
    }

}
