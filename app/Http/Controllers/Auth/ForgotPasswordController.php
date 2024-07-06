<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    function index() {
        return view('auth.passwords.forgot_password');
    }

    function sendCode(Request $request) {

        // Trim the input before validation
        $request->merge([
            'number' => trim($request->input('number'))
        ]);
        $number = $request->number;
         // Validate the request data
        $validator = Validator::make($request->all(), [
            'number' => ['required', 'numeric','digits:9'] // Adjust validation rules as needed
        ],
        [
            'number.required' => 'შევსება სავალდებულოა',
            'number.digits' => 'ნომრის უნდა შეიცავდეს 9 ციფრს',
            'number.numeric' => 'ნომერი უნდა შეიცავდეს მხოლოდ ციფრებს',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        // Generate a random 6-digit code
        $code = rand(10000, 99999);
        // Assuming you have an SMS service provider, send the SMS message
        $sendSms = new SmsService();

        $response = $sendSms->sendSms($number, 'verify code:'.$code);
        // Check if the SMS was successfully sent
        if ($response === 200) {
            // Store the code in the session or database for later verification
            // session(['sms_code' => $code]); // Store in session for example
            $user = User::where('number', $number)->first();
            if ($user) {
               $user->update(['verify_code' => $code]);
            }else{
                return back()->withErrors(['number' => 'ნომერი არასწორია.']);
            }

            // Redirect the user to a page to enter the code
            return redirect()->route('auth.password.check_code', ['id' => $user->id, 'locale' => App()->getLocale()]);
        } else {
            // Handle the case where SMS sending failed
            return back()->withErrors(['number' => 'სმს კოდის გაგზავნა ვერ მოხერხდა, სცადეთ მოგვიანებით.']);
        }
    }
    function check_code($lang, $id) {
        return view('auth.passwords.check_code', compact('id'));
    }

    function checkCodeInBase( Request $request ) {


        $code = $request->code;
         // Validate the request data
        $validator = Validator::make($request->all(), [
            'code' => ['required', 'numeric','digits:5'] // Adjust validation rules as needed
        ],
        [
            'code.required' => 'შევსება სავალდებულოა',
            'code.digits' => 'უნდა შეიცავდეს 5 ციფრს',
            'code.numeric' => 'უნდა შეიცავდეს მხოლოდ ციფრებს',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('id', $request->id)->first();
        if ($user && $code == $user->verify_code) {
            return redirect()->route('auth.password.change_password_guest', ['id' => $user->id, 'code' => $code, 'locale' => App()->getLocale()]);
        }else{
            return back()->withErrors(['code' => 'კოდი არასწორია!!!']);
        }

    }
    function changePassword($lang, $id, $code) {
        $user = User::where('id', $id)->where('verify_code', $code)->first();
        if ($user) {
            return view('auth.passwords.change_password_guest', compact('id'));
        }
        return redirect()->route('auth.password.forgot_password', App()->getLocale());
    }

    function updatePassword(Request $request) {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],// Adjust validation rules as needed
        ],
        [
            'password.required' => 'პაროლის შევსება სავალდებულოა',
            'password.min' => 'პაროლი უნდა შედგებოდეს მინიმუმ 8 სიმბოლოსგან',
            'password.confirmed' => 'პაროლი არასწორია',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('id', $request->id)->first();
        if ($user) {
            $password = Hash::make($request->password);
            $user->update(['password' => $password, 'verify_code' => null]);
            return redirect()->route('login', App()->getLocale());
        }
    }
}
