<?php

namespace App\Repositories\Vacancy;

use Exception;
use App\Models\Vacancy;
use App\Models\HrHasVacancy;
use App\Events\staffDailyJob;
use App\Models\StaffDailyWork;
use App\Models\VacancyReminder;
use App\Events\SmsNotificationEvent;

class VacancyHrUpdateRepository
{

    function update($data) {
        try {
            $vacancy = Vacancy::where('id', $data['id'])->first();
            if (!$vacancy) {
                throw new Exception('Vacancy not found');
            }
            $vacancy->update(['hr_id' => $data['new_hr']['id']]);

            $findNewHr = HrHasVacancy::where('hr_id', $data['new_hr']['id'])->first();
            if ($findNewHr) {
                $findNewHr->increment('re_write'); // Increment re_write by 1
                $findNewHr->increment('has_vacancy'); // Directly set has_vacancy to 1
            }

            $findOldHr = HrHasVacancy::where('hr_id', $data['hr']['id'])->first();
            if ($findOldHr) {
                $findOldHr->decrement('re_write'); // Decrement re_write by 1
                $findOldHr->decrement('has_vacancy'); // Directly set has_vacancy to 0
            }

            $this->dailyWorkEvent($data['new_hr']['id']);
            $this->lesHasVacancy($data['hr']['id'], $vacancy->created_at);
            $this->moveReminder($data['id'], $data['new_hr']['id']);

            $newHr = $findNewHr->hr;
            $oldHr = $findOldHr->hr;
            $smsData = [
                [
                    'type'=> 'rewrite_vacancy_to_hr',
                    'data' => [
                        'to' => $newHr->number,
                        'hrName' => $oldHr->name_ka,
                        'code' => $vacancy->code,
                        'category' => $vacancy->category->name_ka,
                        'eNumber' => $vacancy->employer->number,
                        'link' => route('admin.vacancy')
                    ]
                    
                ],
                [
                    'type'=> 'rewrite_vacancy_from_hr',
                    'data' => [
                        'to' => $oldHr->number,
                        'code' => $vacancy->code,
                        'category' => $vacancy->category->name_ka,
                        'hName' => $newHr->name_ka,
                    ]
                ]

            ];
            foreach ($smsData as $key => $value) {
                $this->sendSms($value);
            }
            return [];
        } catch (Exception $e) {
            // Log the exception or handle it as needed
            error_log($e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    public function dailyWorkEvent($hr_id) {
        event(new staffDailyJob($hr_id, 'has_vacancy'));
    }

    public function lesHasVacancy($staff_id, $created_at) {
        $find = StaffDailyWork::where('staff_id', $staff_id)->whereDate('created_at', $created_at)->first();

        if ($find) {
            $find->decrement('has_vacancy', 1);
        }
    }

    public function moveReminder($vacancy_id, $hr_id) {
        VacancyReminder::where('vacancy_id', $vacancy_id)->where('active', 0)->update(['hr_id' => $hr_id]);
    }

    private function sendSms($data) {
        try {
            event(new SmsNotificationEvent($data['data'], $data['type']));
            return response()->json(['message' => 'SMS sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to send SMS', 'error' => $e->getMessage()], 500);
        }
    }
}
