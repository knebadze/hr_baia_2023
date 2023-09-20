<?php

namespace App\Services\Admin;

use App\Models\Candidate;
use App\Models\DailyTask;
use App\Models\QualifyingCandidate;
use App\Models\Vacancy;
use App\Models\VacancyReminder;
use App\Models\WorkDay;
use Carbon\Carbon;

class DailyTaskService
{
    function task() {
        // #პირველი ნაწილი
        // ვამოწმებ ვადაგასულ ჩანაწერებს სადაც success 1 არ უდრის
        // ვააბდეითებ success, vacancy->status_id, candidate->status_id
        // ვაკანსიაა ვადაგასულია, სამუშაო გრაფიკი წაშლილია, კანდიდატი თავისუფალი თუ სხვა აქტიურ ვაკანსიაზე არაა დასაქმებული
        $quality = QualifyingCandidate::whereIn('qualifying_type_id', [5, 6, 7])
            ->where('success', null)
            ->whereDate('end_date', '<', Carbon::today())
            ->get();

        if (count($quality)) {

            $ids = collect($quality)->pluck('id')->toArray();
            $vacancy_ids = collect($quality)->pluck('vacancy_id')->toArray();
            $candidate_ids = collect($quality)->pluck('candidate_id')->toArray();

            QualifyingCandidate::whereIn('id', $ids)->update(['success' => 1]);
            WorkDay::whereIn('qualifying_candidate_id', $ids)->delete();


            Vacancy::whereIn('id', $vacancy_ids)->update(['status_id' => 13]);
            VacancyReminder::whereIn('vacancy_id', $vacancy_ids)->where('date', '>', Carbon::today())->delete();

            Candidate::whereIn('id', $candidate_ids)->update(['status_id' => 9]);


        }

        // #მეორე ნაწილი
        //  ვპოულობ პერიოდულ დასაქმებას სადაც დასრულების დღე მეტია დღევანდელზე
        // სამუშაო დღეების მასივში ვამოწმებ არის თუ არაა დღევანდელი დღე
        // თუ არის სატატუს ვაძელვ დასაქმდა პერიოდულად
        // თუ არაა ვაძლევ თავისუფალს


        $find = QualifyingCandidate::where('qualifying_type_id', 7)
            ->where('success', null)
            ->whereDate('start_date', '<=', Carbon::today())
            ->whereDate('end_date', '>', Carbon::today())
            ->get();
        if (count($find)) {
            // dd($find);
            $today = Carbon::today()->toDateString();
            $schedule = [];
            foreach ($find as $key => $value) {
                $f = WorkDay::where('qualifying_candidate_id', $value->id)->first();
                $schedule = json_decode($f->work_day);
                if (in_array($today, $schedule)) {
                    if (Candidate::where('id', $value->candidate_id)->where('status_id', 9)->exists()) {
                        Candidate::where('id', $value->candidate_id)->update(['status_id' => 11]);
                    }
                }else{
                    if (Candidate::where('id', $value->candidate_id)->where('status_id', 11)->exists()) {
                        Candidate::where('id', $value->candidate_id)->update(['status_id' => 9]);
                    }
                }
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

                foreach ($vacancyEquals as $key => $value) {
                    $this->addRemainder($value->hr_id, $value->id);
                }
            }

            $vacancyLess = Vacancy::whereIn('status_id', [1, 2, 6, 7])->whereDate('start_date', '<', Carbon::today())->get();
            if (count($vacancyLess)) {
                foreach ($vacancyLess as $key => $value) {
                    Vacancy::where('id', $value->id)->update(['status_id' => 5, 'status_change_reason' => 'გაუქმდა დაწყების თარიღის დროს ('.$value->start_date.') სტატუსის ('.$value->status->name_ka. ') გამო'  ]);
                }
            }

        }


        $daily = DailyTask::first();
        $daily->update(['date' => Carbon::today()->toDateString()]);
    }

    function addRemainder($hr_id, $vacancy_id) {
        // dd($hr_id, $vacancy_id);
        $currentDateTime = Carbon::today();
        VacancyReminder::create(
                [
                    'vacancy_id' => $vacancy_id,
                    'hr_id' => $hr_id,
                    'date' =>  $currentDateTime->hour(10)->minute(0)->second(0),
                    'reason' => 'ვაკანსის დაწების თარღიში მითითებული დღევანდელი თარიღი გადაწიეთ!!! რადგან ვაკანსია ხვალ გაუქმდება, დაწყების თარიღამდე დასაქმებული კანდიდატის არ არსებობის გამო'
                ]
            );
    }
}
