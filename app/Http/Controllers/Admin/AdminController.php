<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\DailyTask;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\DailyTaskService;
use App\Services\Admin\DashboardService;

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
                'number' => 'required',
                'password' => 'required',
            ]);

            $credentials = [
                'number' => $request->input('number'),
                'password' => $request->input('password'),
            ];
            if (Auth::attempt($credentials)) {
                $sendSms = new SmsService();
                $verificationCode = rand(10000, 99999);


                // Store the verification code in the user's session
                $sessionKey = 'verification_code_' . auth()->user()->id;
                session([
                    $sessionKey => $verificationCode,
                    $sessionKey . '_time' => now(),
                ]);
                $sendSms->sendSms($request->input('number'), 'verify code:'.$verificationCode);

                return redirect('ka/admin_verify');
            }

        return redirect("ka/admin")->withSuccess('ინფორმაცია არასწორია');
    }

    function verifyPage()
    {
        return view('admin_verify');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|numeric',
        ]);

        $enteredCode = $request->input('verification_code');
        $userId = auth()->user()->id;
        $sessionKey = 'verification_code_' . $userId;
        $sessionKeyTime = $sessionKey . '_time';

        // Check if the verification code has expired (2 minutes timeout)
        if (now()->diffInMinutes(session($sessionKeyTime)) > 2) {
            // Clear the verification code and timestamp from the session
            $request->session()->forget([$sessionKey, $sessionKeyTime]);

            return back()->withErrors(['verification_code' => 'კოდი ვადაგასულია.']);
        }

        if ($enteredCode == session($sessionKey)) {
            // Clear the verification code and timestamp from the session
            $request->session()->forget([$sessionKey, $sessionKeyTime]);
            // Redirect to the intended dashboard
            if (DailyTask::whereDate('date', '!=', Carbon::today())->exists()) {
                    $this->dailyTaskService->task();
                }
            return redirect()->intended('ka/admin/dashboard')
                    ->withSuccess('Signed in');
        }

        // Incorrect verification code
        return back()->withErrors(['verification_code' => 'არასწორი კოდი.']);
    }

    public function dashboard()
    {
        if(Auth::check()){
                $data = $this->dashboardService->getData();
                $role_id = Auth::user()->role_id;
            return view('admin.dashboard', compact('data', 'role_id'));
        }

        return redirect("admin")->withSuccess('are not allowed to access');
   }
}
