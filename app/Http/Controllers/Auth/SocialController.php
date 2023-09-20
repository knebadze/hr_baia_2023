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
        dd(Socialite::driver($provider)->user());
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        $providerUser = Socialite::driver($provider)->user();
        $user = User::where('email', $providerUser->email)->first();
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

        return redirect('/home');
    }
}
