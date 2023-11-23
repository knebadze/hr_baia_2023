<?php

namespace App\Services;

use App\Models\Vacancy;
use App\Events\hrDailyJob;
use Illuminate\Support\Carbon;
use App\Repositories\Vacancy\VacancyRedactedRepository;
use App\Repositories\Vacancy\VacancyStatusUpdateRepository;


class VacancyStatusService
{
    protected VacancyRedactedRepository $vacancyRedactedRepository;
    protected VacancyStatusUpdateRepository $vacancyStatusUpdateRepository;

    public function __construct()
    {
        $this->vacancyRedactedRepository = new VacancyRedactedRepository;
        $this->vacancyStatusUpdateRepository = new VacancyStatusUpdateRepository;
    }

    function service($data){
        // dd($data);
        $history = [];
        $model = $data['model'];
        $update = $this->vacancyStatusUpdateRepository->update($model);
        $vacancy = Vacancy::where('id', $model['id'])->first();

        if ($update['type'] == 's') {
            switch ($model['status']['id']) {
                case 2:
                    $this->handleStatus2($model, $vacancy);
                    break;

                case 3:
                    $this->handleStatus3($model, $vacancy);
                    break;

                case 5:
                    $this->handleStatus5($model, $vacancy);
                    break;

                case 6:
                    $this->handleStatus6($model, $vacancy);
                    break;

                case 7:
                    $this->handleStatus7($model, $vacancy);
                    break;
            }

            // Save history after handling status updates
            $history = $this->vacancyRedactedRepository->save($data['model']['id'], $data['edit']);
        }

        $response = [$update, $history];
        return $response;


    }

    // Separate methods for handling each status
    private function handleStatus2($model, $vacancy) {
        $this->vacancyStatusUpdateRepository->addDeposit($model['id']);
    }

    private function handleStatus3($model, $vacancy) {
        $date = Carbon::now()->addDays(7)->toDateString();
        $this->vacancyStatusUpdateRepository->updateDepositData($model['id'], $date);

        $reminderText = 'ვაკანსიაზე (ID: '. $vacancy->code.') უნდა მოხდეს თანხის ჩარიცხვა';
        $this->vacancyStatusUpdateRepository->addReminder([
            'vacancy_id' => $model['id'],
            'hr_id' => $vacancy->hr_id,
            'date' => $date.' 10:00:00',
            'reason' =>  $reminderText
        ], 2);
        $this->vacancyStatusUpdateRepository->updateQualifying($vacancy->id);
        $this->dailyWorkEvent($vacancy->hr_id);
    }

    private function handleStatus5($model, $vacancy) {
        $this->vacancyStatusUpdateRepository->deleteReminder($vacancy->id);
        $this->vacancyStatusUpdateRepository->deleteDeposit($vacancy->id);
        $this->vacancyStatusUpdateRepository->updateQualifying($vacancy->id);
    }

    private function handleStatus6($model, $vacancy) {
        $reminder = $model['reminder'];
        $reminder['vacancy_id'] = $model['id'];
        $reminder['hr_id'] = $vacancy->hr_id;
        $reminder['reason'] =  'ვაკანსია (ID: '. $vacancy->code.') უნდა გადავიყვანო წარმოებაში და დავიწყო კადრების მოძიება';
        $this->vacancyStatusUpdateRepository->addReminder($reminder, 1);
    }

    private function handleStatus7($model, $vacancy) {
        $vacancy->update(['start_date', $model['suspended_date']]);
        $reminder = [];
        $reminder['vacancy_id'] = $model['id'];
        $reminder['hr_id'] = $vacancy->hr_id;
        $reminder['reason'] = 'ვაკანსია (ID: '. $vacancy->code.') უნდა გადავიყვანო წარმოებაში და დავიწყო კადრების მოძიება';
        $carbonDate = Carbon::parse($model['suspended_date']);
        $modifiedDate = $carbonDate->subWeeks(2);
        $reminderData = $modifiedDate->format('Y-m-d H:i:s');
        $reminder['date'] = $reminderData;
        $this->vacancyStatusUpdateRepository->addReminder($reminder, 1);
    }

    function dailyWorkEvent($hr_id) {
        event(new hrDailyJob($hr_id, 'has_vacancy'));
    }
}
