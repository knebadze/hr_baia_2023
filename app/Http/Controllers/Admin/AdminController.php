<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DailyTask;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\DailyTaskService;
use App\Services\Admin\DashboardService;
use Carbon\Carbon;

class AdminController extends Controller
{
    private DashboardService $dashboardService;
    private DailyTaskService $dailyTaskService;
    public function __construct(DashboardService $dashboardService, DailyTaskService $dailyTaskService)
    {
        $this->dashboardService = $dashboardService;
        $this->dailyTaskService = $dailyTaskService;
    }
   public function index()
   {
        return view('admin');
   }
   public function login(Request $request)
   {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (DailyTask::whereDate('date', '!=', Carbon::today())) {
                $this->dailyTaskService->task();
            }

            return redirect()->intended('ka/admin/dashboard')
                        ->withSuccess('Signed in');
        }

       return redirect("admin")->withSuccess('Login details are not valid');
   }
   public function dashboard()
   {
       if(Auth::check()){

            $dailyReminderData = $this->dashboardService->dailyReminder();
            $hrDailyWork = $this->dashboardService->hrDailyWork();
            $dailyReminder = ['data' => $dailyReminderData, 'role_id' => Auth::user()->role_id];

           return view('admin.dashboard', compact('dailyReminder'));
       }

       return redirect("admin")->withSuccess('are not allowed to access');
   }
}
