<?php

namespace App\Repositories\Candidate;

use App\Models\User;
use App\Models\Salary;
use App\Models\Vacancy;
use App\Events\hrDailyJob;
use App\Models\GlobalVariable;
use App\Models\RegistrationFee;
use App\Models\userRegisterLog;
use App\Models\VacancyReminder;
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
            } else {
                $avatar = 'default_female.jpg';
            }

            // Initialize a flag to track success/failure
            $allModelsCreated = true;

            // Create the User model
            $user = User::updateOrCreate(
                ['number' => $data['number']],
                [
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
            if ($user->wasRecentlyCreated) {
                // User record was just created
                // You can perform actions for a newly created user here
                $registerLog = userRegisterLog::create([
                    'creator_id' => Auth::id(),
                    'user_id' => $user->id,
                    'type' => $data['type']['id'],
                ]);

                $this->dailyWorkEvent(Auth::user()->hr->id);

                if (!$registerLog) {
                    $allModelsCreated = false;
                }

                if ($data['type']['id'] == 1) {
                    $fee = RegistrationFee::create([
                        'user_id' => $user->id,
                        'initial_amount' => ($data['money']) ? $data['money'] : null,
                        'money' => ($data['money']) ? $data['money'] : null,
                        'creator_id' => Auth::id(),
                        'enroll_date' => ($data['enroll_date']) ? $data['enroll_date'] : null,
                    ]);
                    //ვერ ვამატებ შეხსენებას რადგან მარტო ვაკანსიაზეა გათვლილი
                    // $this->addReminder(['vacancy_id' => $id, 'date' => $date.' 10:00:00', 'reason' =>  'ვაკანსიაზე უნდა მოხდეს თანხის ჩარიცხვა']);
                }

                // Check if RegistrationFee creation failed
                if (!$fee) {
                    $allModelsCreated = false;
                }
            } else {
                // dd('update');
                // User record already existed and was updated
                // You can perform actions for an updated user here
            }
            // Check if User creation failed
            if (!$user) {
                $allModelsCreated = false;
            }



            // Check if at least one model creation failed
            if (!$allModelsCreated) {
                throw new \Exception("An error occurred during enrollment agreement.", 500);
            }

            return $user;
        } catch (\Throwable $th) {
            throw new \Exception("An error occurred during enrollment agreement: " . $th->getMessage(), 500);
        }
    }

    function dailyWorkEvent($hr_id) {
        event(new hrDailyJob($hr_id, 'candidate_has_registered'));
    }

    // function addReminder($data) {
    //     $reminder = new VacancyReminder();
    //     $reminder->vacancy_id = $data['vacancy_id'];
    //     $auth = Auth::user();
    //     if ($auth->role_id == 2) {
    //         $hr_id = Auth::user()->hr->id;
    //     }else{
    //         $vacancy = Vacancy::where('id', $data['vacancy_id'])->select('id')->first();
    //         $hr_id = $vacancy->hr_id;
    //     }
    //     $reminder->hr_id = $hr_id;
    //     $reminder->date = $data['date'];
    //     $reminder->reason = $data['reason'];
    //     $reminder->save();
    // }

    // function addBonus($id) {
    //     try {
    //         $user = User::where('id', $id)->first();
    //         $salary = Salary::where('hr_id', $user->hr->id)->where('hr_agree', 0)->whereNull('disbursement_date')->first();
    //         $bonus = GlobalVariable::where('id', 4)->first();
    //         $salary->update([
    //             'hr_bonus_from_registration' => $salary->hr_bonus_from_registration + $bonus->meaning,
    //             'full_salary' => $salary->full_salary + $bonus->meaning
    //         ]);

    //         return $salary;
    //     } catch (\Throwable $th) {
    //         throw new \Exception("An error occurred during enrollment agreement: " . $th->getMessage(), 500);
    //     }
    // }
}
