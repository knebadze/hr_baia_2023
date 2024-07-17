<?php

namespace App\Repositories\Vacancy;

use Exception;
use App\Models\Staff;
use App\Models\Vacancy;
use App\Models\Employer;
use App\Traits\FindHrTrait;
use Illuminate\Support\Str;
use App\Events\staffDailyJob;
use App\Models\RepeatHistory;
use App\Models\VacancyDemand;
use Illuminate\Support\Carbon;
use App\Models\VacancyReminder;
use App\Traits\HrHasVacancyTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Events\SmsNotificationEvent;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployerAdditionalNumber;

class VacancyRepository{
    use HrHasVacancyTrait;
    use FindHrTrait;
    public function save($data)
    {
        try {
            DB::beginTransaction();
            // dd($data);
            $employer = $this->addEmployer($data['employer']);
            $hr_id = $this->findHr($employer->number, $data['vacancy']['payment']);
            if (!$hr_id) {
                // Return an error or throw an exception
                Log::error("HR ID not found for employer number: {$employer->number}");
                throw new \Exception("Error: HR ID not found.");
            }
            // ვამატებ დღის სამუშაოში ჰრ ის გრაფაში პლიუს ერთ ვაკანსიას
            $this->dailyWorkEvent($hr_id);
            $vacancyData = $this->prepareVacancyData($data, $employer->id, $hr_id);
            $vacancy = Vacancy::create($vacancyData);

            if ($this->hasValidDemands($data['demand'])) {
                $this->createVacancyDemand($vacancy->id, $data['demand']);
            }


            $this->syncManyToManyRelations($vacancy, $data);
            if (!is_null($data['repeat_reason'])) {
                $this->addRepeat($data['vacancy']['id'], $vacancy->id, $data['repeat_reason']);
            }

            $reminder = $this->addReminder($vacancy->id, $vacancy->hr_id, $data['vacancy']['category'], $data['vacancy']['work_schedule'], $vacancy->start_date, $data['vacancy']['term']);
            $this->sendSms([
                'code' => $vacancy->code,
                'category' => $data['vacancy']['category']['name_ka'],
                'number' => $data['employer']['number'],
                'hr_id' => $hr_id
            ]);


            DB::commit(); // Commit the transaction

        return $vacancy;
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction on error
            // Log the error or handle it as needed
            Log::error("Error saving vacancy: " . $e->getMessage());
            throw new \Exception("An error occurred while saving the vacancy.");
        }
    }

    public function addEmployer($data)
    {
        try {
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
            // Check if additional_numbers is present and not empty
            if (!empty($data['additional_numbers'])) {
                foreach ($data['additional_numbers'] as $additionalNumber) {
                    EmployerAdditionalNumber::updateOrCreate(
                        [
                            // Assuming 'employer_id' and 'number' uniquely identify an additional number
                            'employer_id' => $employer->id,
                            'number' => $additionalNumber['number'],
                        ],
                        [
                            'number_code_id' => $additionalNumber['number_code']['id'],
                            'number_owner_id' => $additionalNumber['number_owner']['id'],
                            // Add other fields you need to save or update
                            'comment' => $additionalNumber['comment'] ?? null,
                        ]
                    );
                }
            }
            return $employer;
        } catch (Exception $e) {
            // Log the error or handle it as needed
            Log::error("Failed to add or update employer. Error: " . $e->getMessage());
            // Optionally, rethrow the exception if you want the calling code to handle it
            // throw $e;
        }
    }
    private function prepareVacancyData($data, $employerId, $hrId)
    {
        // Assuming slug generation and interview date formatting are required
        $slug = Str::slug($data['vacancy']['title_en'], '-'); // Example slug generation based on vacancy title
        $dateTime = $data['interviewDate'] . ' ' . $data['interviewTime']; // Combining date and time for interview
        $code = random_int(100000, 999999999);
        return [
            'code' => $code,
            'author_id' => $employerId,
            'hr_id' => $hrId,
            'title_ka' => $data['vacancy']['title_ka'],
            'title_en' => $data['vacancy']['title_en'],
            'title_ru' => $data['vacancy']['title_ru'],
            'category_id' => $data['vacancy']['category']['id'],
            'status_id' => 1,
            'payment' => $data['vacancy']['payment'],
            'currency_id' => $data['vacancy']['currency']['id'],
            'work_schedule_id' => $data['vacancy']['work_schedule']['id'],
            'additional_schedule_ka' => $data['vacancy']['additional_schedule_ka'],
            'additional_schedule_en' => $data['vacancy']['additional_schedule_en'],
            'additional_schedule_ru' => $data['vacancy']['additional_schedule_ru'],
            'comment' => $data['vacancy']['comment'],
            'interview_date' => $dateTime,
            'interview_place_id' => $data['vacancy']['interview_place']['id'] ?? null,
            'go_vacation' => $data['vacancy']['go_vacation'],
            'stay_night' => $data['vacancy']['stay_night'],
            'work_additional_hours' => $data['vacancy']['work_additional_hours'],
            'start_date' => $data['vacancy']['start_date'],
            'term_id' => $data['vacancy']['term']['id'],
            'carry_in_head_date' => Carbon::now()->toDateTimeString(),
            'slug' => $slug, // Assuming a slug is needed
        ];
    }

    private function hasValidDemands($demands)
    {
        $requiredKeys = ['min_age', 'max_age', 'education', 'specialty', 'language', 'language_level', 'has_experience', 'has_recommendation'];

        // Check if all required keys exist and are not empty (for non-array values) or not empty arrays.
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $demands) || (is_array($demands[$key]) ? empty($demands[$key]) : $demands[$key] === '')) {
                return false;
            }
        }

        return true;
    }

    private function createVacancyDemand($vacancyId, $demands)
    {
        try {
            $demand = new VacancyDemand();
            $demand->vacancy_id = $vacancyId;
            $demand->min_age = $demands['min_age'];
            $demand->max_age = $demands['max_age'];
            $demand->education_id = isset($demands['education']['id']) ? $demands['education']['id'] : null;
            $demand->profession_id = isset($demands['specialty']['id']) ? $demands['specialty']['id'] : null;
            $demand->additional_duty_ka = isset($demands['additional_duty_ka'])?$demands['additional_duty_ka']:null;
            $demand->additional_duty_en = isset($demands['additional_duty_en'])?$demands['additional_duty_en']:null;
            $demand->additional_duty_ru = isset($demands['additional_duty_ru'])?$demands['additional_duty_ru']:null;
            $demand->language_id = isset($demands['language']['id']) ? $demands['language']['id'] : null;
            $demand->language_level_id = isset($demands['language_level']['id']) ? $demands['language_level']['id'] : null;
            $demand->has_experience = isset($demands['has_experience']) && $demands['has_experience'] == 1 ? 1 : 0;
            $demand->has_recommendation = isset($demands['has_recommendation']) && $demands['has_recommendation'] == 1 ? 1 : 0;
            $demand->save();
        } catch (Exception $e) {
            // Handle the exception
            // Log the error or send it back as a response
            Log::error("Error creating vacancy demand: " . $e->getMessage());
            // Optionally, rethrow or handle the exception as needed
            throw $e;
        }
    }

    private function syncRelationFromData($vacancy, $data, $relationKey, $relationMethod)
    {
        try {
            if (isset($data[$relationKey])) {
                $ids = collect($data[$relationKey])->pluck('id')->all();
                $vacancy->$relationMethod()->sync($ids);
            }
        } catch (Exception $e) {
            // Handle the error, for example, log it
            Log::error("Failed to sync relation {$relationKey} for vacancy. Error: " . $e->getMessage());
            // Optionally, rethrow the exception if you want the calling code to handle it
            // throw $e;
        }
    }

    public function syncManyToManyRelations(Vacancy $vacancy, $data)
    {
        $this->syncRelationFromData($vacancy, $data, 'for_who_need', 'vacancyForWhoNeed');
        $this->syncRelationFromData($vacancy, $data, 'benefit', 'vacancyBenefit');
        $this->syncRelationFromData($vacancy, $data, 'driving_license', 'vacancyDrivingLicense');
        $this->syncRelationFromData($vacancy, $data, 'characteristic', 'characteristic');
        $this->syncRelationFromData($vacancy, $data, 'duty', 'vacancyDuty');
    }

    function addReminder($vacancy_id, $hr_id, $category, $work_schedule, $start_date, $term) {
        $reminderDate = $this->calculateReminderDate();
        $reason = $this->formatReason($category, $work_schedule, $start_date, $term);

        try {
            $reminder = new VacancyReminder();
            $reminder->vacancy_id = $vacancy_id;
            $reminder->hr_id = $hr_id;
            $reminder->date = $reminderDate;
            $reminder->reason = $reason;
            $reminder->main = 1;
            $reminder->main_stage_id = 1;
            $reminder->save();
        } catch (Exception $e) {
            // Log the error or handle it as needed
            Log::error("Error adding reminder: " . $e->getMessage());
            throw $e;
        }
    }

    private function calculateReminderDate() {
        $currentDateTime = Carbon::now();
        $fivePM = $currentDateTime->copy()->setTime(17, 0, 0);

        if ($currentDateTime->gt($fivePM)) {
            return $currentDateTime->addDay()->setTime(10, 0, 0);
        } else {
            return $currentDateTime->addHour();
        }
    }

    private function formatReason($category, $work_schedule, $start_date, $term) {
        return "დაგემატა ახალი ვაკანსია. კატეგორია: {$category['name_ka']}, გრაფიკი: {$work_schedule['name_ka']}, კანდიდატის საჭიორების თარიღი: {$start_date}, ვადა: {$term['name_ka']}, შეავსეთ სათაური და შეცვალეთ სტატუსი!";
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
        event(new staffDailyJob($hr_id, 'has_vacancy'));
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
