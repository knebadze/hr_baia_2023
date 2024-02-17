<?php

namespace App\Services\Admin;

use Carbon\Carbon;
use App\Models\Vacancy;
use App\Models\WorkDay;
use App\Models\Candidate;
use App\Models\DailyTask;
use App\Models\VacancyReminder;
use Illuminate\Support\Facades\DB;
use App\Models\QualifyingCandidate;

class DailyTaskService
{
    function task() {
        try {
             // #პირველი ნაწილი
            // ვამოწმებ ვადაგასულ ჩანაწერებს სადაც status_id არის null ან 17(მიმდინარე)
            // ვააბდეითებ status_id, vacancy->status_id, candidate->status_id
            // ვაკანსიაა ვადაგასულია, სამუშაო გრაფიკი წაშლილია, კანდიდატი თავისუფალი თუ სხვა აქტიურ ვაკანსიაზე არაა დასაქმებული
            $quality = QualifyingCandidate::whereIn('qualifying_type_id', [5, 6, 7, 8])
                ->where('status_id', 17)
                ->whereDate('end_date', '<', Carbon::today())
                ->get();

            if (count($quality)) {

                $ids = collect($quality)->pluck('id')->toArray();
                $vacancy_ids = collect($quality)->pluck('vacancy_id')->toArray();
                $candidate_ids = collect($quality)->pluck('candidate_id')->toArray();

                QualifyingCandidate::whereIn('id', $ids)->update(['status_id' => 18]);
                WorkDay::whereIn('qualifying_candidate_id', $ids)->delete();


                Vacancy::whereIn('id', $vacancy_ids)->update(['status_id' => 13]);
                VacancyReminder::whereIn('vacancy_id', $vacancy_ids)->where('date', '>', Carbon::today())->delete();

                Candidate::whereIn('id', $candidate_ids)->update(['status_id' => 9]);


            }
            // გასაუბრებაზე ცხადება ტიპის სტატუსის განახლება
            $interview = QualifyingCandidate::where('qualifying_type_id', 4)
                ->where('status_id', 17)
                ->whereDate('interview_date', '<', Carbon::today())
                ->update(['status_id' => 18]);


            $currentDateTime = Carbon::today();
            // #მეორე ნაწილი
            $quality2 = QualifyingCandidate::whereIn('qualifying_type_id', [5, 6, 7, 8])
                ->where('status_id', 17)
                ->whereDate(
                    DB::raw('DATE_ADD(end_date, INTERVAL -2 DAY)'),
                    '=',
                    now()->toDateString()
                )
                ->get();
                if(count($quality2)){
                    $text = "ვაკანსიასზე დასაქმებულ კანდიდატს ორ დრეში ეწურება სამუშაო პერიოდი გადაამოწმეთ შემკვეთთან ხომ არ სურს გაგრძელება";
                    foreach ($quality2 as $key => $value) {
                        $this->addRemainder($value->vacancy->hr_id, $value->vacancy_id, $currentDateTime->hour(11)->minute(0)->second(0), $text);
                    }
                }




            // #მესამე ნაწილი
            //ვამოწმებ ვაკანსიებს საწყისი, წარომებაში, უნდა კადრი, შეჩერებული სტატუსებში რომლის დაწყების თარიღიც დღევანდელზე ნაკლებია ან ტოლია
            // თუ ტოლია ამ ვაკანსიებზე ვამატებ შეხსენებას
            // თუ ნაკლებია სტატუსი გადამყავს  გაუქმდაში,
            if (Vacancy::whereIn('status_id', [1, 2, 6, 7])->whereDate('start_date', '<=', Carbon::today())->exists()) {
                $vacancyEquals = Vacancy::whereIn('status_id', [1, 2, 6, 7])->whereDate('start_date', '=', Carbon::today())->get();
                // dd($vacancyEquals);
                if (count($vacancyEquals)) {

                    $text = 'ვაკანსის დაწების თარღიში მითითებული დღევანდელი თარიღი გადაწიეთ!!! რადგან ვაკანსია ხვალ გაუქმდება, დაწყების თარიღამდე დასაქმებული კანდიდატის არ არსებობის გამო';
                    foreach ($vacancyEquals as $key => $value) {
                        $this->addRemainder($value->hr_id, $value->id, $currentDateTime->hour(11)->minute(0)->second(0), $text);
                    }
                }

                $vacancyLess = Vacancy::whereIn('status_id', [1, 2, 6, 7])->whereDate('start_date', '<', Carbon::today())->get();
                if (count($vacancyLess)) {
                    $reason_for_cancel_id = 34;
                    foreach ($vacancyLess as $key => $value) {
                        if($value->qualifyingCandidate){
                            $reason_for_cancel_id = 33;
                        }
                        Vacancy::where('id', $value->id)->update(['status_id' => 5, 'status_change_reason' => 'გაუქმდა დაწყების თარიღის დროს ('.$value->start_date.') სტატუსის ('.$value->status->name_ka. ') გამო', 'reason_for_cancel_id' => $reason_for_cancel_id ]);
                    }
                }

            }


            $daily = DailyTask::first();
            $daily->update(['date' => Carbon::today()->toDateString()]);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }

    }

    function addRemainder($hr_id, $vacancy_id, $date, $text) {
        VacancyReminder::create(
                [
                    'vacancy_id' => $vacancy_id,
                    'hr_id' => $hr_id,
                    'date' =>  $date,
                    'reason' => $text
                ]
            );
    }
}
