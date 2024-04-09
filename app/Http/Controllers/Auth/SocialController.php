<?php

namespace App\Http\Controllers\Auth;

use Throwable;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        try {
            $providerUser = Socialite::driver($provider)->user();
            $user = $providerUser->email?User::where('email', $providerUser->email)->first():null;
            if (!$user) {
                $user = User::updateOrCreate([
                    'email' => $providerUser->email,
                ], [
                    'name_en' => $providerUser->name,
                    'avatar' => $providerUser->avatar,
                    'password' => Hash::make(Str::random(8)),
                    'provider' => $provider,
                    'provider_id' => $providerUser->id,
                    'provider_token' => $providerUser->token,
                ]);
            }

            Auth::login($user);
            if ($user->whereHas('candidate')) {
                return redirect('/ka/home');
            }
            return redirect('/ka/user/userProfile');
        } catch (\Exception $e) {
            // Log the exception to investigate the error
            Log::error('Socialite Error: ' . $e->getMessage());
            // Handle the error gracefully, for example, by displaying a user-friendly error message
        }

    }
}
