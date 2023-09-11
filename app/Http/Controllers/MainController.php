<?php

namespace App\Http\Controllers;

use App\Services\WelcomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
        return view ('welcome', compact('data'));
    }

}
