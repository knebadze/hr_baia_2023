<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
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
            // 'number' => ['required', 'size:9'],
            'password' => ['required', 'string', 'min:8'],
        ],
        [
            'name_ka.required' => 'სახელი და გვარის შევსება სავალდებულოა',
            'email.required' => 'ემაილის შევსება სავალდებულოა',
            'email.email' => 'ემაილი აუცილებლად უნდა შეიცავდეს "@" სიმბოლოს'
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
        dd($data);
        // $tr= new GoogleTranslate();
        // $name_en = GoogleTranslate::trans($data['name_ka'], 'en');
        // $name_ru = GoogleTranslate::trans($data['name_ka'], 'ru');
        // dd();
        // GoogleTranslate::trans($data['name_ka'])
        return User::create([
            'user_type_id' =>$data['user_type_id'],
            'name_ka' => $data['name_ka'],
            // 'name_en' => $name_en,
            // 'name_ru' => $name_ru,
            'email' => $data['email'],
            'date_of_birth' => $data['date_of_birth'],
            'gender_id' => $data['gender_id'],
            'number' => $data['number'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
