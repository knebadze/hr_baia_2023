<?php

namespace App\Repositories\Admin;

use App\Models\Hr;
use App\Models\HrHasVacancy;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Stichoza\GoogleTranslate\GoogleTranslate;

class HrRepository
{
   public function store($data)
   {

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
        $hr->mobile = $data['bonus_percent'];
        $hr->mobile = $data['fixed_salary'];
        $hr->fb_link = $data['fb_link'];
        $hr->save();

        //ვქმნი ხელფასის ჩანაწერს
        $this->salary($hr->id, $hr->fixed_salary);

        $hr_has_vacancy = new HrHasVacancy();
        $hr_has_vacancy->hr_id = $hr->id;
        $hr_has_vacancy->save();
        return User::where('id', $hrUser->id)->with('hr')->first();
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
