<?php

namespace App\Repositories\Admin;

use App\Models\Hr;
use App\Models\User;
use App\Models\Salary;
use App\Models\HrHasVacancy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Events\SmsNotificationEvent;
use Illuminate\Support\Facades\Hash;
use Stichoza\GoogleTranslate\GoogleTranslate;

class StaffRepository
{

    public function store($data)
    {
        try {
            $staffUser = $this->createStaffUser($data);
            $hr = $this->createHr($staffUser, $data);
            $this->createSalary($hr);
            if($data['role_id'] == 2){
                $this->createHrHasVacancy($hr);
            }

            $this->sendSmsNotification($data);

            return User::where('id', $staffUser->id)->with('hr')->first();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    private function createStaffUser($data)
    {
        $staffUser = new User();
        $staffUser->fill([
            'role_id' => $data['role_id'],
            'name_ka' => $data['name'],
            'name_en' => GoogleTranslate::trans($data['name'], 'en'),
            'name_ru' => GoogleTranslate::trans($data['name'], 'ru'),
            'email' => $data['email'],
            'number' => $data['number'],
            'date_of_birth' => $data['date_of_birth'],
            'gender_id' => $data['gender_id'],
            'lang' => 'ka',
            'password' => Hash::make($data['password']),
            'avatar' => $this->getAvatarPath($data),
        ]);
        $staffUser->save();

        return $staffUser;
    }

    private function getAvatarPath($data)
    {
        if ($data['avatar']) {
            return $data['avatar']->store('hr_avatar', 'public');
        }

        return $data['gender_id'] == 1 ? 'hr_avatar/default_male.jpg' : 'hr_avatar/default_female.jpg';
    }

    private function createHr($staffUser, $data)
    {
        $hr = new Hr();
        $hr->fill([
            'user_id' => $staffUser->id,
            'person_number' => $data['person_number'],
            'mobile' => $data['mobile'],
            'inside_number' => $data['inside_number'],
            'branch_id' => $data['branch_id'],
            'bonus_percent' => $data['bonus_percent'],
            'internship' => $data['internship'] ? 1 : 0,
            'fixed_salary' => $data['fixed_salary'],
            'fb_link' => $data['fb_link'],
        ]);
        $hr->save();

        return $hr;
    }
    private function createSalary($hr)
    {
        Salary::create([
            'hr_id' => $hr->id,
            'fixed_salary'=> $hr->fixed_salary,
            'full_salary' => $hr->fixed_salary
        ]);
    }
    private function createHrHasVacancy($hr)
    {
        $hr_has_vacancy = new HrHasVacancy();
        $hr_has_vacancy->hr_id = $hr->id;
        $hr_has_vacancy->save();
    }

    private function sendSmsNotification($data)
    {
        $smsData = [
            'to' => $data['number'],
            'number' => $data['number'],
            'password' => $data['password'],
            'link'=> route('admin', ['locale' => App::getLocale()]),
        ];
        event(new SmsNotificationEvent($smsData, 'add_hr'));
    }

    public function update($data)
    {
        // $hrUser = User::findOrFail($data['id']);
        // return [$data, $hrUser];
        DB::beginTransaction();

        try {
            $hrUser = User::findOrFail($data['id']);

            $hrUserData = [
                'name_ka' => $data['name'],
                'name_en' => GoogleTranslate::trans($data['name'], 'en'),
                'name_ru' => GoogleTranslate::trans($data['name'], 'ru'),
                'email' => $data['email'],
                'number' => $data['k_mobile'],
                'date_of_birth' => $data['date_of_birth'],
                'gender_id' => $data['gender_id'],
            ];

            if ($data['password']) {
                $hrUserData['password'] = Hash::make($data['password']);
            }

            if ($data['avatar']) {
                $upload_path = public_path('images/hr');
                $file_name = $data['avatar']->getClientOriginalName();
                $generated_new_name = time() . '.' .$file_name;
                $data['avatar']->move($upload_path, $generated_new_name);
                $hrUserData['avatar'] = $generated_new_name;
            }

            $hrUser->update($hrUserData);

            $hr = Hr::findOrFail($data['hr_id']);

            $hrData = [
                'person_number' => $data['person_number'],
                'mobile' => $data['mobile'],
                'inside_number' => $data['inside_number'],
                'branch_id' => (int)$data['branch_id'],
                'bonus_percent' => $data['bonus_percent'],
                'internship' => $data['internship'] == 'true'?1:0,
                'fixed_salary' => $data['fixed_salary'],
                'fb_link' => $data['fb_link'],
            ];

            $hr->update($hrData);

            DB::commit();

            return 'ok';
        } catch (\Throwable $th) {
            DB::rollback();
            // Log the exception
            Log::error($th->getMessage());
            // Return a meaningful error message to the user
            return $th->getMessage();
        }
    }
}
