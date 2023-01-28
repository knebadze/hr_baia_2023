<?php

namespace App\Http\Controllers\Auth;

use Throwable;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
            // dd($providerUser);

            // $user = User::updateOrCreate([
            //     'provider' => $provider,
            //     'provider_id' => $providerUser->id,
            // ], [
            //     'name' => $providerUser->name,
            //     'email' => $providerUser->email,
            //     'avatar' => $providerUser->avatar,
            //     'provider_token' => $providerUser->token,
            //     'password' => Hash::make(Str::random(8)),

            //     // 'google_token' => $googleUser->token,
            //     // 'github_refresh_token' => $googleUser->refreshToken,
            // ]);
            // dd($user);
            $user = User::where([
                'provider' => $provider,
                'provider_id' => $providerUser->id,
            ])->first();

            if (!$user) {
                $user = User::create([
                    'name' => $providerUser->name,
                    'email' => $providerUser->email,
                    'avatar' => $providerUser->avatar,
                    'password' => Hash::make(Str::random(8)),
                    'provider' => $provider,
                    'provider_id' => $providerUser->id,
                    'provider_token' => $providerUser->token,

                ]);

            }
            // dd($user);
            Auth::login($user);

            return redirect()->route('home');
        }catch(Throwable $e){
            // return redirect()->route('login')->withErrors('error');
        }
    }
}
