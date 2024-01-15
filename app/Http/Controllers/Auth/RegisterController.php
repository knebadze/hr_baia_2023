<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
        return Validator::make($data, [
            'name_ka' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'number' => ['required', 'size:9', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'agree' => ['required'],
            'date_of_birth' => ['required', 'date', 'before:-18 years'],
            'gender_id' => ['required']
        ],
        [
            'name_ka.required' => 'სახელი და გვარის შევსება სავალდებულოა',
            'email.required' => 'იმეილის შევსება სავალდებულოა',
            'email.email' => 'იმეილი აუცილებლად უნდა შეიცავდეს "@" სიმბოლოს',
            'email.unique' => 'იმეილი უკვე გამოყენებულია',
            'number.required' => 'ნომრის შევსება სავალდებულოა',
            'number.size' => 'ნომრის უნდა შეიცავდეს 9 ციფრს',
            'number.unique' => 'ნომერი უკვე გამოყენებულია',
            'password.required' => 'პაროლის შევსება სავალდებულოა',
            'password.min' => 'პაროლი უნდა შედგებოდეს მინიმუმ 8 სიმბოლოსგან',
            'password.confirmed' => 'პაროლი არასწორია',
            'agree.required' => 'საიტზე რეგისტრაციისთვი სავალდებულოა ეთანხმებოდეთ წესებს და პირობებს',
            'date_of_birth.required' => 'შევსება სავალდებულოა',
            'date_of_birth.before' => 'თქვენ არ ხართ სრულწლოვანი',
            'gender_id.required' => 'შევსება სავალდებულოა',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd($data);
        // $tr= new GoogleTranslate();
        $lang = app()->getLocale();
        if ($lang == 'ka') {
            $name_ka = $data['name_ka'];
            $name_en = GoogleTranslate::trans($data['name_ka'], 'en');
            $name_ru = GoogleTranslate::trans($data['name_ka'], 'ru');
        }elseif ($lang == 'en') {
            $name_ka = GoogleTranslate::trans($data['name_en'], 'ka');
            $name_en = $data['name_en'];
            $name_ru = GoogleTranslate::trans($data['name_en'], 'ru');
        }elseif ($lang == 'ru') {
            $name_ka = GoogleTranslate::trans($data['name_ru'], 'ka');
            $name_en = GoogleTranslate::trans($data['name_ru'], 'en');
            $name_ru = $data['name_ru'];
        }
        if ($data['gender_id'] == 1) {
            $defaultAvatar = 'user_avatar/default_male.jpg';
        } else {
            $defaultAvatar = 'user_avatar/default_female.jpg';
        }

        // dd();
        // GoogleTranslate::trans($data['name_ka'])
        $user = User::create([
            'role_id' => 3,
            'name_ka' => $name_ka,
            'name_en' => $name_en,
            'name_ru' => $name_ru,
            'email' => $data['email'],
            'date_of_birth' => $data['date_of_birth'],
            'gender_id' => $data['gender_id'],
            'avatar' => $defaultAvatar,
            'number' => $data['number'],
            'password' => Hash::make($data['password']),
            'lang' => $lang,
        ]);
        // $user->addMedia($defaultAvatar)
        //     ->toMediaCollection('user_avatar');
        // return view('user.userProfile' );
        return $user;
    }
}
