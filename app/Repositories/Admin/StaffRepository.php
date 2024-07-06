<?php

namespace App\Repositories\Admin;

use App\Models\Hr;
use App\Models\User;
use App\Models\Staff;
use App\Models\Salary;
use App\Models\HrHasVacancy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Events\SmsNotificationEvent;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;

class StaffRepository
{

    public function storeAndUpdate($data)
    {
        try {
            list($staff, $isNew) = $this->createOrUpdateStaffUser($data);
            if ($isNew) {
                $this->createSalary($staff);
                if ($data['role_id'] == 2) {
                    $this->createHrHasVacancy($staff);
                }
                $this->sendSmsNotification($data);
            }

            return Staff::where('id', $staff->id)->first();
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['error' => 'An unexpected error occurred Repository store. Please try again later.'.$th], 500);
        }
    }
    private function createOrUpdateStaffUser($data)
    {
        try {
            $staff = Staff::where('number', $data['number'])->first();
            $isNew = false; // Flag to indicate if the staff is new

            if (!$staff) {
                $staff = new Staff();
                $isNew = true; // Set flag to true as this is a new staff
                // If creating a new staff, you might want to set additional attributes here
            }
            $parent = Staff::where('branch_id', $data['branch_id'])->where('role_id', 1)->first();
            // auth()->guard('staff')->id()
            $staff->fill([
                'role_id' => $data['role_id'],
                'parent_id' => $parent->id, // Assuming this is provided in $data
                'name_ka' => $data['name'],
                'name_en' => GoogleTranslate::trans($data['name'], 'en'),
                'name_ru' => GoogleTranslate::trans($data['name'], 'ru'),
                'email' => $data['email'],
                'number' => $data['number'],
                'date_of_birth' => $data['date_of_birth'],
                'gender_id' => $data['gender_id'],
                'avatar' => $this->getAvatarPath($data),
                'password' => Hash::make($data['password']),
                'person_number' => $data['person_number'],
                'mobile' => $data['mobile'],
                'inside_number' => $data['inside_number'],
                'bonus_percent' => $data['bonus_percent'],
                'fixed_salary' => $data['fixed_salary'],
                'branch_id' => $data['branch_id'],
                'internship' => isset($data['internship']) ? $data['internship'] : 0,
                'fb_link' => $data['fb_link'],
                'is_active' => isset($data['is_active']) ? $data['is_active'] : 1,
                'status' => isset($data['status']) ? $data['status'] : 0,
                // 'lang' => 'ka', // Assuming 'lang' is not part of the schema and should be removed or handled separately
            ]);
            $staff->save();

            return [$staff, $isNew];
        } catch (\Exception $e) {
            // Handle the exception or log it
            Log::error("Error creating staff user: " . $e->getMessage());
            // Optionally, return or throw a custom error message or exception
            throw new \Exception("Failed to create staff user.");
        }
    }

    private function getAvatarPath($data)
    {
        if (isset($data['avatar']) && $data['avatar']->isValid()) {
            $oldAvatar = $data['old_avatar'] ?? null; // Assuming you pass the old avatar path in $data
            $avatar = $data['avatar'];

            // Process and store the new avatar
            $image = Image::make($avatar)->fit(300, 300);
            $filePath = 'hr_avatar/' . $avatar->hashName();
            Storage::disk('public')->put($filePath, (string) $image->encode());

            // Delete the old avatar if it's not a default one
            if ($oldAvatar && !in_array($oldAvatar, ['hr_avatar/default_male.jpg', 'hr_avatar/default_female.jpg'])) {
                Storage::disk('public')->delete($oldAvatar);
            }

            return $filePath;
        }

        // Return default avatar based on gender ID
        return $data['gender_id'] == 1 ? 'hr_avatar/default_male.jpg' : 'hr_avatar/default_female.jpg';
    }

    // private function createHr($staffUser, $data)
    // {
    //     $hr = new Hr();
    //     $hr->fill([
    //         'user_id' => $staffUser->id,
    //         'person_number' => $data['person_number'],
    //         'mobile' => $data['mobile'],
    //         'inside_number' => $data['inside_number'],
    //         'branch_id' => $data['branch_id'],
    //         'bonus_percent' => $data['bonus_percent'],
    //         'internship' => $data['internship'] ? 1 : 0,
    //         'fixed_salary' => $data['fixed_salary'],
    //         'fb_link' => $data['fb_link'],
    //     ]);
    //     $hr->save();

    //     return $hr;
    // }
    private function createSalary($staff)
    {
        Salary::create([
            'staff_id' => $staff->id,
            'fixed_salary'=> $staff->fixed_salary,
            'full_salary' => $staff->fixed_salary
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

    // public function update($data)
    // {
    //     // $hrUser = User::findOrFail($data['id']);
    //     // return [$data, $hrUser];
    //     DB::beginTransaction();

    //     try {
    //         $hrUser = User::findOrFail($data['id']);

    //         $hrUserData = [
    //             'name_ka' => $data['name'],
    //             'name_en' => GoogleTranslate::trans($data['name'], 'en'),
    //             'name_ru' => GoogleTranslate::trans($data['name'], 'ru'),
    //             'email' => $data['email'],
    //             'number' => $data['k_mobile'],
    //             'date_of_birth' => $data['date_of_birth'],
    //             'gender_id' => $data['gender_id'],
    //         ];

    //         if ($data['password']) {
    //             $hrUserData['password'] = Hash::make($data['password']);
    //         }

    //         if ($data['avatar']) {
    //             $upload_path = public_path('images/hr');
    //             $file_name = $data['avatar']->getClientOriginalName();
    //             $generated_new_name = time() . '.' .$file_name;
    //             $data['avatar']->move($upload_path, $generated_new_name);
    //             $hrUserData['avatar'] = $generated_new_name;
    //         }

    //         $hrUser->update($hrUserData);

    //         $hr = Hr::findOrFail($data['hr_id']);

    //         $hrData = [
    //             'person_number' => $data['person_number'],
    //             'mobile' => $data['mobile'],
    //             'inside_number' => $data['inside_number'],
    //             'branch_id' => (int)$data['branch_id'],
    //             'bonus_percent' => $data['bonus_percent'],
    //             'internship' => $data['internship'] == 'true'?1:0,
    //             'fixed_salary' => $data['fixed_salary'],
    //             'fb_link' => $data['fb_link'],
    //         ];

    //         $hr->update($hrData);

    //         DB::commit();

    //         return 'ok';
    //     } catch (\Throwable $th) {
    //         DB::rollback();
    //         // Log the exception
    //         Log::error($th->getMessage());
    //         // Return a meaningful error message to the user
    //         return $th->getMessage();
    //     }
    // }
}
