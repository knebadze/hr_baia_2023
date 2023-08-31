<?php

namespace App\Repositories\Candidate;

use App\Models\GlobalVariable;
use App\Models\User;
use App\Models\Salary;
use App\Models\userRegisterLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Stichoza\GoogleTranslate\GoogleTranslate;

class AddUserRepository
{
    function save($data) {
        try {
            $name_ka = $data['name_ka'];
            $name_en = GoogleTranslate::trans($data['name_ka'], 'en');
            $name_ru = GoogleTranslate::trans($data['name_ka'], 'ru');
            if ($data['gender_id'] == 1) {
                $avatar = 'default_male.jpg';
            }else{
                $avatar = 'default_female.jpg';
            }
            $user = User::create([
                'name_ka' => $name_ka,
                'name_en' => $name_en,
                'name_ru' => $name_ru,
                'email' => $data['email'],
                'date_of_birth' => $data['date_of_birth'],
                'gender_id' => $data['gender']['id'],
                'avatar' => $avatar,
                'number' => $data['number'],
                'password' => Hash::make($data['password']),
                'lang' => 'ka',
            ]);
            userRegisterLog::create([
                'creator_id' => Auth::id(),
                'user_id' => $user->id,
                'type' => $data['type']['id'],
                'money' => ($data['money'])?$data['money']:null,
                'enroll_date' => ($data['enroll_date'])?$data['enroll_date']:null,
            ]);

            if ($data['type']['id'] == 2) {
                $this->addBonus(Auth::id());
            }

            return $user;
        } catch (\Throwable $th) {
            throw new \Exception("An error occurred during enrollment agreement: " . $th->getMessage(), 500);
        }



    }

    function addBonus($id) {
        try {
            $user = User::where('id', $id)->first();
            $salary = Salary::where('hr_id', $user->hr->id)->where('hr_agree', 0)->first();
            $bonus = GlobalVariable::where('id', 4)->first();
            $salary->update([
                'hr_bonus_from_paid_registration' => $salary->hr_bonus_from_paid_registration + $bonus->meaning,
                'full_salary' => $salary->full_salary + $bonus->meaning
            ]);

            return $salary;
        } catch (\Throwable $th) {
            throw new \Exception("An error occurred during enrollment agreement: " . $th->getMessage(), 500);
        }
    }
}
