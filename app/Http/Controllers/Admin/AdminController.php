<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\DailyTask;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
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

            $user = User::where('number', $request->input('number'))->whereNot('role_id', 3)->first();
            $checkPass = null;
            if ($user) {
               $checkPass = Hash::check($request->input('password'), $user->password);
            }


            if ($checkPass) {
                $sendSms = new SmsService();
                $verificationCode = rand(10000, 99999);

                $user->update(['verify_code' => $verificationCode, 'verify_code_date' => now()]);
                $sendSms->sendSms($request->input('number'), 'verify code:'.$verificationCode);

                return redirect('ka/admin_verify?number='.$request->input('number'));
            }else{
                return redirect("ka/admin")->withErrors(['password'=>'პაროლი არასწორია']);
            }

        return redirect("ka/admin")->withErrors(['number'=>'ინფორმაცია არასწორია']);
    }

    function verifyPage()
    {
        $number = request('number');
        return view('admin_verify', compact('number'));
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|numeric',
        ]);

        $enteredCode = $request->input('verification_code');
        $number = $request->input('number');
        $user = User::where('number', $number)->whereNot('role_id', 3)->first();
        $code = $user->verify_code;

        // Check if the verification code has expired (2 minutes timeout)
        if (now()->diffInMinutes(session($user->verify_code_date)) > 2) {

            return back()->withErrors(['verification_code' => 'კოდი ვადაგასულია.']);
        }
        if ($enteredCode == $code) {

            if (Auth::loginUsingId($user->id)) {
                 // Redirect to the intended dashboard
                if (DailyTask::whereDate('date', '!=', Carbon::today())->exists()) {
                    $this->dailyTaskService->task();
                }
            return redirect()->intended('ka/admin/dashboard')
                    ->withSuccess('Signed in');
            }

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
