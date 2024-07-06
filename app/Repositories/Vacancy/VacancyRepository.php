<?php

namespace App\Repositories\Vacancy;

use App\Models\Hr;
use App\Models\User;
use App\Models\Vacancy;
use App\Models\Employer;
use App\Events\hrDailyJob;
use App\Models\HrHasVacancy;
use App\Models\RepeatHistory;
use App\Models\VacancyDemand;
use Illuminate\Support\Carbon;
use App\Models\VacancyReminder;
use App\Traits\HrHasVacancyTrait;
use App\Events\SmsNotificationEvent;
use App\Models\GlobalVariable;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;

class VacancyRepository{
    use HrHasVacancyTrait;
    public function save($data)
    {
        $employer = $this->addEmployer($data['employer']);
        $hr_id = $this->addHrId( $data['employer']['number'], $data['vacancy']['payment']);

        $vacancy = new Vacancy();
        $vacancy->code = random_int(100000, 999999999);
        $vacancy->author_id = $employer->id;
        $vacancy->hr_id = $hr_id;
        $vacancy->title_ka = $data['vacancy']['title_ka'];
        $vacancy->title_en = $data['vacancy']['title_en'];
        $vacancy->title_ru = $data['vacancy']['title_ru'];
        $vacancy->slug = str()->slug($data['vacancy']['title_en']);
        $vacancy->category_id = $data['vacancy']['category']['id'];
        $vacancy->status_id = 1;

        $vacancy->payment = $data['vacancy']['payment'];
        $vacancy->currency_id = $data['vacancy']['currency']['id'];
        $vacancy->work_schedule_id = $data['vacancy']['work_schedule']['id'];
        $vacancy->additional_schedule_ka = $data['vacancy']['additional_schedule_ka'];
        $vacancy->additional_schedule_en = $data['vacancy']['additional_schedule_en'];
        $vacancy->additional_schedule_ru = $data['vacancy']['additional_schedule_ru'];

        $vacancy->comment = $data['vacancy']['comment'];
        $dateTime = $data['interviewDate'].' '.$data['interviewTime'];
        $vacancy->interview_date = $dateTime;
        $vacancy->interview_place_id = ($data['vacancy']['interview_place'])?$data['vacancy']['interview_place']['id']:null;


        $vacancy->go_vacation = $data['vacancy']['go_vacation'];
        $vacancy->stay_night = $data['vacancy']['stay_night'];
        $vacancy->work_additional_hours = $data['vacancy']['work_additional_hours'];
        $vacancy->start_date = $data['vacancy']['start_date'];
        $vacancy->term_id = $data['vacancy']['term']['id'];
        $vacancy->carry_in_head_date = Carbon::now()->toDateTimeString();

        $vacancy->save();

        $filteredArray = array_filter($data['demand'], 'is_null');

        if (count($filteredArray) !== count($data['demand'])) {
            $demand = new VacancyDemand();
            $demand->vacancy_id = $vacancy->id;
            $demand->min_age = $data['demand']['min_age'];
            $demand->max_age = $data['demand']['max_age'];
            $demand->education_id = ($data['demand']['education'])?$data['demand']['education']['id']:null;
            $demand->profession_id = ($data['demand']['specialty'])?$data['demand']['specialty']['id']:null;
            $demand->additional_duty_ka = $data['demand']['additional_duty_ka'];
            $demand->additional_duty_en = $data['demand']['additional_duty_en'];
            $demand->additional_duty_ru = $data['demand']['additional_duty_ru'];
            $demand->language_id = ($data['demand']['language'])?$data['demand']['language']['id']:null;
            $demand->language_level_id = ($data['demand']['language_level'])?$data['demand']['language_level']['id']:null;
            $demand->has_experience = ($data['demand']['has_experience'] == 1 )?$data['demand']['has_experience']:0;
            $demand->has_recommendation = ($data['demand']['has_recommendation'])?$data['demand']['has_recommendation']:0;
            $demand->save();
        }

        $selectForWhoNeedId = collect($data['for_who_need'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item["id"];
            return $carry;
        }, []);
        $vacancy->vacancyForWhoNeed()->sync($selectForWhoNeedId);

        $selectBenefitId = collect($data['benefit'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item["id"];
            return $carry;
        }, []);
        $vacancy->vacancyBenefit()->sync($selectBenefitId);

        if (isset($data['driving_license'])) {
            $selectDrivingLicenseId = collect($data['driving_license'])->reduce(function ($carry, $item) {
                if($carry  == null) $carry = [];
                $carry[] = $item["id"];
                return $carry;
            }, []);
            $vacancy->vacancyDrivingLicense()->sync($selectDrivingLicenseId);
        }


        $selectCharacteristic = collect($data['characteristic'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item['id'];
            return $carry;
        }, []);
        $vacancy->characteristic()->sync( $selectCharacteristic );

        $selectDutyId = collect($data['duty'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item["id"];
            return $carry;
        }, []);
        $vacancy->vacancyDuty()->sync($selectDutyId);
        $data['repeat_reason'] = null;
        if ($data['repeat_reason']) {
            $this->addRepeat($data['vacancy']['id'], $vacancy->id, $data['repeat_reason']);
        }

        $reminder = $this->addReminder($vacancy->id, $vacancy->hr_id, $data['vacancy']['category'], $data['vacancy']['work_schedule'], $vacancy->start_date, $data['vacancy']['term']);
        $smsData = ['code' => $vacancy->code, 'category' => $data['vacancy']['category']['name_ka'], 'number' => $data['employer']['number'], 'hr_id' => $hr_id];
        $this->sendSms($smsData);
        return $vacancy;


    }


    public function addEmployer($data)
    {
        $employer = Employer::updateOrCreate(
            ['number' => $data['number'], 'number_code_id' => array_key_exists('number_code', $data)? $data['number_code']['id']:$data['number_code_id']],
            [
                'name_ka' => $data['name_ka'] ?? null,
                'name_en' => $data['name_en'] ?? null,
                'name_ru' => $data['name_ru'] ?? null,
                'address_ka' => $data['address_ka'] ?? null,
                'address_en' => $data['address_en'] ?? null,
                'address_ru' => $data['address_ru'] ?? null,
                'street_ka' => $data['street_ka'] ?? null,
                'street_en' => $data['street_en'] ?? null,
                'street_ru' => $data['street_ru'] ?? null,
                'email' => $data['email'] ?? null,
            ]
        );
        return $employer;
    }

    // public function addHrId($number, $payment) {
    //     $hr_id = $this->findExistingHrIdForEmployer($number);
    //     if ($hr_id) {
    //         return $hr_id;
    //     }

    //     $auth = Auth::guard('staff')->user();
    //     $internship = $this->getInternshipPaymentThreshold();

    //     $hr_id = $this->findHrForNewVacancy($auth, $payment, $internship);
    //     if ($hr_id) {
    //         $this->updateVacancyForHr($hr_id);
    //         return $hr_id;
    //     }

    //     $hr_id = $this->findNextAvailableHr($auth, $payment, $internship);
    //     if (!$hr_id) {
    //         $this->hrHasVacancyUpdate(); // Assuming this method resets or updates HR vacancies in some way
    //         $hr_id = $this->findNextAvailableHr($auth, $payment, $internship);
    //     }

    //     if ($hr_id) {
    //         $this->updateVacancyForHr($hr_id);
    //     }

    //     return $hr_id;
    // }

    // private function findExistingHrIdForEmployer($number) {
    //     $employer = Employer::where('number', $number)->first();
    //     if ($employer && $employer->vacancies->count() > 0) {
    //         // Assuming each vacancy has an HR ID and we return the most recent one
    //         return $employer->vacancies->last()->hr_id;
    //     }
    //     return null;
    // }
    // private function getInternshipPaymentThreshold() {
    //     // Assuming there's a GlobalVariable table or similar to get this value
    //     return GlobalVariable::where('name', 'internship_payment')->first()->internship;;
    // }

    // private function findHrForNewVacancy($authUser, $payment, $internshipThreshold) {
    //     // Example logic: find an HR based on payment criteria and workload
    //     return HR::where('payment', '<=', $payment)
    //              ->where('internship_threshold', '>=', $internshipThreshold)
    //              ->orderBy('workload') // Assuming 'workload' is a field indicating the HR's current load
    //              ->first()
    //              ->id ?? null;
    // }
    // private function findNextAvailableHr($authUser, $payment, $internshipThreshold) {
    //     // Similar to findHrForNewVacancy but without payment criteria
    //     return HrHasVacancy::orderBy('workload')->first()->id ?? null;
    // }
    public function addHrId($number, $payment)
    {

        $hr_id = null;
        //თუ დამსაქმებელს აქვს უკვე გამოგზავნილი ვაკანსია ვპოულობ hr და ისევ მას ვაწერ ამ ვაკანისას
        //rewrite ვუცვლი რადგან ერთი წრე გამოტოვოს
        $findEmployer =  Employer::where('number', $number)->first();
        if ($findEmployer) {

            $findAuthor = Vacancy::where('author_id', $findEmployer->id)->first();
            if ($findAuthor) {
                $find = HrHasVacancy::where('hr_id', $findAuthor->hr_id)->first();
                if ($find) {
                    $find->update(['has_vacancy' => 1]);
                    return $findAuthor->hr_id;
                }

            }

        }

        // ვამოწმობ ავტორიზებული იუზერი თუ Hr ან ადმინია, ვნახულობ რომელ ფილიალს ეკუთვნის ამის შემდეგ მის ფილიალში ვაწერ ვაკანსიას

        // ვამოწმებ თუ ვინმეს გადაეწერა ვაკანსია და იმას ვისაც ყველაზე მეტი ვაკანსია აკლია ვაძლევ შემდეგ ვაკანსისას
        // ვზრდი მინუსს increment
        $auth = Auth::guard('staff')->user();
        $internship = GlobalVariable::where('name', 'internship_payment')->first()->internship;

        $findLessReWrite = HrHasVacancy::where('re_write', '<', 0)
            ->where('is_active', 1)
            ->when($auth, function ($query) use($auth) {
                if ($auth->role_id == 2 || $auth->role_id == 1) {
                    return $query->whereHas('hr', function ($subQuery) use ($auth) {
                        $subQuery->where('branch_id', $auth->branch_id);
                    });
                }else{
                    return $query;
                }

            })
            ->when($payment > $internship, function ($query)  {
                return $query->whereHas('hr', function ($subQuery) {
                    $subQuery->where('internship', 0);
                });
            })
            ->orderBy('re_write', 'ASC')->first();
        if ($findLessReWrite) {
            $findLessReWrite->increment('re_write');
            $findLessReWrite->update(['has_vacancy' => 1]);

            return $findLessReWrite->hr_id;
        }

        // თუ ზედა ორი პუნქტი არ შესრულდა ვეძებ ვისაც არ მიუღია ამ წრეზე ვაკანსია

        $nextVacancy = HrHasVacancy::orderBy('id', 'ASC')
            ->where('has_vacancy', 0)
            ->where('is_active', 1);

        // Apply additional filtering based on the user's role if applicable
        if ($auth && ($auth->role_id == 1 || $auth->role_id == 2)) {
            $nextVacancy->whereHas('hr', function ($query) use ($auth) {
                $query->where('branch_id', $auth->branch_id);
            });
        }

        // Apply filtering based on payment and internship criteria
        $nextVacancy->when($payment > $internship, function ($query) {
            $query->whereHas('hr', function ($subQuery) {
                $subQuery->where('internship', 0);
            });
        });

        // Retrieve the first matching vacancy
        $findNext = $nextVacancy->first();
        // ბოლო აქტიური ეიჩარი ვინაა ამ წრეზე ვამოწმებ
        $lastHrId = HrHasVacancy::orderBy('hr_id', 'DESC')
            ->where('has_vacancy', 0)
            ->where('is_active', 1)
            ->first();

        if ($findNext) {
            $hr_id = $findNext->hr_id;
            $findNext->update(['has_vacancy'=> 1]);
        }else{
            $this->hrHasVacancyUpdate();
            $findNext = HrHasVacancy::orderBy('id', 'ASC')
                ->where('has_vacancy', 0)
                ->where('is_active', 1)
                ->first();
            $hr_id = $findNext->hr_id;
        }



        if ($lastHrId->hr_id == $findNext->hr_id) {
            $this->hrHasVacancyUpdate();
        }

        // ვამატებ დღის სამუშაოში ჰრ ის გრაფაში პლიუს ერთ ვაკანსიას
        $this->dailyWorkEvent($hr_id);
        return $hr_id;


    }

    public function hrHasVacancyUpdate()
    {
        $all = HrHasVacancy::all();
        foreach ($all as $key => $value) {
            if ($value->re_write <= 1) {
                HrHasVacancy::where('id', $value->id)->update(['has_vacancy'=> 0]);
            }

            if ($value->re_write > 0) {
                $find = HrHasVacancy::where('id', $value->id)->first();
                $find->update(['re_write'=> $find->re_write - 1]);
            }
        }

    }
    function addReminder($vacancy_id, $hr_id, $category, $work_schedule, $start_date, $term ) {
        $currentDateTime = Carbon::now();
        $fivePM = Carbon::createFromTime(17, 0, 0, $currentDateTime->timezone);
        $reminderDate = null;
        if ($currentDateTime->gt($fivePM)) {
            // Your code here if the current time is greater than 17:00
            $nextDay = $currentDateTime->addDay();
            $nextDayAt10AM = $nextDay->setHour(10)->setMinute(0)->setSecond(0);
            $reminderDate = $nextDayAt10AM;
        } else {
            // Your code here if the current time is not greater than 17:00
            $reminderDate = $currentDateTime->addHour();
        }
        $reminder = new VacancyReminder();
        $reminder->vacancy_id = $vacancy_id;
        $reminder->hr_id = $hr_id;
        $reminder->date = $reminderDate;
        $reminder->reason = 'დაგემატა ახალი ვაკანსია. კატეგორია:'. $category['name_ka']. ', გრაფიკი: '. $work_schedule['name_ka']. ', კანდიდატის საჭიორების თარიღი: ' .$start_date. ', ვადა: '.$term['name_ka'].',შეავსეთ სათაური და შეცვალეთ სტატუსი!';
        $reminder->main = 1;
        $reminder->main_stage_id = 1;
        $reminder->save();
    }


    function addRepeat($old_id, $vacancy_id, $reason) {
        $repeat = new RepeatHistory();
        $repeat->user_id = Auth::guard('staff')->id();
        $repeat->old_vacancy_id = $old_id;
        $repeat->new_vacancy_id = $vacancy_id;
        $repeat->reason = $reason;
        $repeat->save();
    }
    function dailyWorkEvent($hr_id) {
        event(new hrDailyJob($hr_id, 'has_vacancy'));
    }

    function sendSms($data)
    {
        $hr = Staff::where('id', $data['hr_id'])->first();
        $HData = ['name' => $hr->name_ka, 'number' => $hr->number, 'to' => $data['number']];
        $data['to'] = $hr->number;
        $admin = Staff::where('id', $hr->parent_id)->first();
        $getHasVacancyControl = $this->getHasVacancyControl();
        $adminData = ['to' => $admin->number, 'code' => $data['code'], 'hr1' => $hr->name_ka, 'hr2' => $getHasVacancyControl['is_in_line']->hr_name];
        event(new SmsNotificationEvent($HData, 'add_vacancy_send_employer'));
        event(new SmsNotificationEvent($data, 'add_vacancy_send_hr'));
        event(new SmsNotificationEvent($adminData, 'add_vacancy_send_admin'));
    }
}
