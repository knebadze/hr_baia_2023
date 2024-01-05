<?php

namespace App\Repositories\Admin;

use App\Models\Hr;
use App\Models\User;
use App\Models\Salary;
use App\Models\HrHasVacancy;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Stichoza\GoogleTranslate\GoogleTranslate;

class HrRepository
{
   public function store($data)
   {
    // dd($data);
    try {
        $validate = Validator::make($data, [
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
        dd($validate);
        
        $hrUser = new User();
        $hrUser->role_id = 2;
        $hrUser->name_ka = $data['name'];
        $hrUser->name_en = GoogleTranslate::trans($data['name'], 'en');
        $hrUser->name_ru = GoogleTranslate::trans($data['name'], 'ru');
        $hrUser->email = $data['email'];
        $hrUser->number = $data['k_mobile'];
        $hrUser->date_of_birth = $data['date_of_birth'];
        $hrUser->gender_id = $data['gender'];
        $hrUser->lang = 'ka';
        $hrUser->password = Hash::make($data['password']);

        if ($data['avatar']) {
            $upload_path = public_path('images/hr');

            $file_name = $data['avatar']->getClientOriginalName();
            $generated_new_name = time() . '.' .$file_name;
            $data['avatar']->move($upload_path, $generated_new_name);
            $hrUser->avatar = $generated_new_name;
        }else{
            if ($data['gender'] == 1) {
                $hrUser->avatar = 'default_male.jpg';
            }else{
                $hrUser->avatar = 'default_female.jpg';
            }
        }

        $hrUser->save();
        $hr = new Hr();
        $hr->user_id = $hrUser->id;
        $hr->person_number = $data['person_number'];
        $hr->mobile = $data['mobile'];
        $hr->inside_number = $data['inside_number'];
        $hr->bonus_percent = $data['bonus_percent'];
        $hr->fixed_salary = $data['fixed_salary'];
        $hr->fb_link = $data['fb_link'];
        $hr->save();

        //ვქმნი ხელფასის ჩანაწერს
        $this->salary($hr->id, $hr->fixed_salary);

        $hr_has_vacancy = new HrHasVacancy();
        $hr_has_vacancy->hr_id = $hr->id;
        $hr_has_vacancy->save();
        return User::where('id', $hrUser->id)->with('hr')->first();
    } catch (\Throwable $th) {
        //throw $th;
        dd($th);
    }

   }

   public function update($data)
   {

        $hrUser = User::findOrFail($data['id']);

        $hrUser->name_ka = $data['name'];
        $hrUser->name_en = GoogleTranslate::trans($data['name'], 'en');
        $hrUser->name_ru = GoogleTranslate::trans($data['name'], 'ru');
        $hrUser->email = $data['email'];
        $hrUser->number = $data['k_mobile'];
        $hrUser->date_of_birth = $data['date_of_birth'];
        $hrUser->gender_id = $data['gender'];
        if ($data['password']) {
            $hrUser->password = Hash::make($data['password']);
        }


        if ($data['avatar']) {
            $upload_path = public_path('images/hr');

            $file_name = $data['avatar']->getClientOriginalName();
            $generated_new_name = time() . '.' .$file_name;
            $data['avatar']->move($upload_path, $generated_new_name);
            $hrUser->avatar = $generated_new_name;
        }

        $hrUser->update();
        $hr = Hr::findOrFail($data['hr_id']);
        $hr->person_number = $data['person_number'];
        $hr->mobile = $data['mobile'];
        $hr->inside_number = $data['inside_number'];
        $hr->mobile = $data['bonus_percent'];
        $hr->mobile = $data['fixed_salary'];
        $hr->fb_link = $data['fb_link'];
        $hr->update();

        return 'ok';
   }

   function salary($id, $salary) {
        Salary::create(
            ['hr_id' => $id],
            ['fixed_salary'=> $salary],
            ['full_salary' => $salary]
        );
   }
}
