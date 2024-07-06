<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Blacklist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Validate the user login request.
     *
     * @param \Illuminate\Http\Request $request
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'number' => 'required|string',
            'password' => 'required|string|min:8',
        ], [
            'password.min' => __('password_min'),
        ]);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return [
            'number' => $request->get('number'),
            'password' => $request->get('password'),
        ];
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        // Use the User model to find the user by email or number
        $user = User::where('number', $request->get('number'))->first();

        // Check if the user does not exist
        if (!$user) {
            throw ValidationException::withMessages([
                'number' => [trans('auth.failed')], // Use a different message for user not found
            ]);
        }

        // Check if the user is blacklisted
        if ($this->isUserBlacklisted($user)) {
            throw ValidationException::withMessages([
                'number' => [trans('auth.blacklisted')],
            ]);
        }

        // Attempt to log the user in
        if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
            return true;
        }

        // If login attempt fails for reasons other than being blacklisted or not found
        throw ValidationException::withMessages([
            'number' => [trans('auth.failed')], // Use a generic failure message or a specific one if needed
        ]);

        return false;
    }
    protected function isUserBlacklisted($user)
    {
        // Implement your logic to check if the user is blacklisted
        return Blacklist::where('user_id', $user->id)->exists();
    }
    /**
     * Get the path the user should be redirected to after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return property_exists($this, 'redirectTo') ? app()->getLocale().$this->redirectTo : app()->getLocale().'/home';
        }
        return property_exists($this, 'redirectTo') ? app()->getLocale().$this->redirectTo : app()->getLocale().'/home';
    }
}
