<?php

namespace App\Repositories\Candidate;

use App\Models\User;
use App\Models\Salary;
use App\Models\Vacancy;
use App\Events\hrDailyJob;
use App\Models\Enrollment;
use App\Models\GlobalVariable;
use App\Models\RegistrationFee;
use App\Models\userRegisterLog;
use App\Models\VacancyReminder;
use Illuminate\Support\Facades\DB;
use App\Events\SmsNotificationEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UnfinishedRegistration;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Repositories\Enrollment\EnrollmentAgreeRepository;

class AddUserRepository
{
    function save($data) {
        try {

            // return $data;
            DB::beginTransaction();

            $name_ka = $data['name_ka'];
            $name_en = GoogleTranslate::trans($data['name_ka'], 'en');
            $name_ru = GoogleTranslate::trans($data['name_ka'], 'ru');
            $avatar = $data['gender']['id'] == 1 ? 'user_avatar/default_male.jpg' : 'user_avatar/default_female.jpg';

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
                ]
            );

            if (!$user) {
                throw new \Exception("User creation failed.", 500);
            }
            $authUser = Auth::user();
            $author = $this->getAuthor($authUser, $data['was_assigned']);
            if ( !$author || !$authUser) {
                throw new \Exception("One or more required users are null.", 500);
            }
            // print_r($author);

            if ($user->wasRecentlyCreated) {
                // return $staff;
                $registerLog = userRegisterLog::create([
                    'creator_id' => $author->id,
                    'user_id' => $user->id,
                    'type' => $data['type']['id'],
                ]);

                if (!$registerLog) {
                    throw new \Exception("User register log creation failed.", 500);
                }

                $staffId = $author->staff->id;


                $this->dailyWorkEvent($staffId);
                $this->addRegistrationBonus($staffId);


                if ($data['type']['id'] == 1) {
                    $this->createRegistrationFee($data, $user->id, $author->id);

                }

                if ($data['was_assigned']) {
                    $wasAssigned = UnfinishedRegistration::create([
                        'user_id' => $user->id,
                        'was_assigned_id' => $author->id,
                        'author_id' => $authUser->id,
                        'status_id' => 2,
                    ]);

                    $baseUrl = url()->current();
                    $smsData = [
                        'to' => $author->number,
                        'name' => $data['name_ka'],
                        'number' => $data['number'],
                        'link' => "{$baseUrl}/admin/add_candidate",
                    ];

                    $this->sendSms($smsData, 'to_be_assigned_administrator');
                    if (!$wasAssigned) {
                        throw new \Exception("Unfinished Registration creation failed.", 500);
                    }
                }
            }

            DB::commit();

            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception("An error occurred during enrollment agreement: " . $th->getMessage(), 500);
        }
    }

    function createRegistrationFee ($data, $user_id, $author_id) {
        $fee = RegistrationFee::create([
            'user_id' => $user_id,
            'initial_amount' => $data['money'] ?? null,
            'money' => $data['money'] ?? null,
            'creator_id' => $author_id,
            'enroll_date' => $data['enroll_date'] ?? now(),
        ]);

        if (!$fee) {
            throw new \Exception("Registration fee creation failed.", 500);
        }
    }
    function getAuthor($authUser, $wasAssigned = false){
        if ($authUser->role_id !== 1 && !$wasAssigned) {
            return $authUser;
        }else{
            $randomAdministrator = User::where('role_id', 4)->where('is_active', 1)->inRandomOrder()->first();
            if (!$randomAdministrator) {
                $randomAdministrator = User::where('role_id', 4)->first();
            }
            return $randomAdministrator;
        }
    }
    function dailyWorkEvent($staff_id) {
        try {
            event(new hrDailyJob($staff_id, 'candidate_has_registered'));
        } catch (\Exception $e) {
            // Handle the exception
            throw new \Exception("dailyWorkEvent failed: ". $e, 500);
        }
    }

    function addRegistrationBonus($staff_id) {
        try {
            $addBonus = new EnrollmentAgreeRepository();
            $bonus = GlobalVariable::where('name', 'registration_bonus')->first();
            $addBonus->addHrBonus(1, $staff_id, $bonus->meaning/2);
        } catch (\Exception $e) {
            // Handle the exception
            throw new \Exception("addRegistrationBonus failed: ".$e, 500);
        }
    }
    public function update($data)
    {
        try {
            $user = User::findOrFail($data['id']);
            if ($data['lang'] == 'ka') {
                $user->name_ka = $data['name_ka'];
            } elseif ($data['lang'] == 'en') {
                $user->name_en = $data['name_en'];
            } elseif ($data['lang'] == 'ru') {
                $user->name_ru = $data['name_ru'];
            }
            $user->email = $data['email'];
            $user->number = $data['number'];
            $user->date_of_birth = $data['date_of_birth'];
            $user->gender_id = $data['gender']['id'];
            $user->update();

            return [
                'success' => true,
                'data' => $user,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    function sendSms($data, $name)
    {
        event(new SmsNotificationEvent($data, $name));
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
