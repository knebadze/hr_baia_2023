<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Staff;
use App\Models\DailyTask;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Models\AdminDataView;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use App\Services\Admin\DailyTaskService;
use App\Services\Admin\DashboardService;

class AdminController extends Controller
{
    private DashboardService $dashboardService;
    private DailyTaskService $dailyTaskService;
    protected $smsService;
    public function __construct(DashboardService $dashboardService, DailyTaskService $dailyTaskService, SmsService $smsService)
    {
        $this->dashboardService = $dashboardService;
        $this->dailyTaskService = $dailyTaskService;
        $this->smsService = $smsService;
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

        $user = Staff::where('number', $request->input('number'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return redirect("ka/admin")->withErrors(['number' => 'პაროლი ან ნომერი არასწორია']);
        }

        $this->sendVerificationCode($user);

        return redirect('ka/admin_verify?number=' . $request->input('number'));
    }

    protected function sendVerificationCode($user)
    {
        $verificationCode = random_int(10000, 99999);
        $user->update(['verify_code' => $verificationCode, 'verify_code_date' => now()]);
        $this->smsService->sendSms($user->number, 'verify code:' . $verificationCode);
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
            'number' => 'required',
        ]);

        $user = Staff::where('number', $request->input('number'))
                    ->first(['id', 'verify_code', 'verify_code_date']);

        if (!$user) {
            Log::info("User not found with number: " . $request->input('number'));
            return back()->withErrors(['verification_code' => 'მომხმარებელი ვერ მოიძებნა.']);
        }

        if ($this->isCodeExpired($user)) {
            Log::info("Code expired for user: " . $user->id);
            return back()->withErrors(['verification_code' => 'კოდი ვადაგასულია.']);
        }

        if (!$this->isValidCode($request, $user)) {
            Log::info("Invalid code entered for user: " . $user->id);
            return back()->withErrors(['verification_code' => 'კოდი არასწორიაა.']);
        }
        return $this->loginUser($user);
    }

    protected function isCodeExpired($user)
    {
        return Carbon::parse($user->verify_code_date)->diffInMinutes(now()) > 2;
    }

    protected function isValidCode($request, $user)
    {
        $enteredCode = $request->input('verification_code');
        $expectedCode = $user->verify_code;
        $isValid = $enteredCode == $expectedCode;

        if (!$isValid) {
            Log::info("Invalid code entered for user: {$user->id}. Entered: {$enteredCode}, Expected: {$expectedCode}");
        }

        return $isValid;
    }

    // protected function loginUser($user)
    // {
    //     Auth::loginUsingId($user->id);
    //     $this->checkAndHandleDailyTasks();
    //     return redirect()->intended('ka/admin/dashboard')->withSuccess(__('Signed in'));
    // }

    protected function loginUser(Staff $user)
    {
        Auth::guard('staff')->loginUsingId($user->id);
        $this->checkAndHandleDailyTasks();
        return redirect()->intended('ka/admin/dashboard')->withSuccess(__('Signed in'));
    }

    protected function checkAndHandleDailyTasks()
    {
        if (DailyTask::whereDate('date', '!=', Carbon::today())->exists()) {
            $this->dailyTaskService->task();
        }
        $adminDataViews = Cache::remember('admin_data_view', 60, function () {
            return AdminDataView::all();
        });
    }


    public function dashboard()
    {
        if(Auth::check()){
                $data = $this->dashboardService->getData();
                $role_id = Auth::guard('staff')->user()->role_id;
            return view('admin.dashboard', compact('data', 'role_id'));
        }

        return redirect("admin")->withSuccess('are not allowed to access');
   }
}
