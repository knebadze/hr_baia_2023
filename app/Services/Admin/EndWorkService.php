<?php

namespace App\Services\Admin;

use Carbon\Carbon;
use App\Models\Vacancy;
use App\Models\Candidate;
use App\Models\CandidateEndWork;
use App\Models\QualifyingCandidate;
use App\Models\VacancyReminder;
use App\Models\WorkDay;
use Illuminate\Support\Facades\Auth;

class EndWorkService
{

    function end($data)  {
        // dd($data);
        // ვამოწმებ აქვს თუ არა წაშლის უფლება
        // თუ წაშლის მიზეზია "შემკვეს სურს ვაკანსიის შეწყვეტა" (15) მაშინ დასრულების დღეს ვააბდეითებ გასულ დღეზე და ვაკანსია გადამყავს ვადაგასულ სტატუსში
        // ვინახავ რედაქტირების ისტორიას
        // else  შემთხვევშიც დასრულების თარიღს ვცვლი, ვაკანსია გადამყავს წარმოების სტატუსში, ვინახავ ისტორიას
        // თუ კანდიდატი არაა სხვაგან დასაქმებული სტატუს ვუცვლი და ვაძელვ "თავისუფალს"
        // თუ დასაქმების ტიპი იყო პერიოდული ვშლი გრაფიკს
        // თუ ვაკანსისას ეძებნება აქტიური შეხსენებები მაგ: "ვადის გასვლის შეხსენება" ვშლი შეხსენებებს


        $currentDate = Carbon::now();
        $find = QualifyingCandidate::findOrFail($data['id']);


        $findVacancy = Vacancy::where('id', $find->vacancy_id)->with('status')->first()->toArray();
        if (Auth::user()->role_id == 2 && $findVacancy['hr_id'] != Auth::user()->hr->id) {
            return ['type' => 'e', 'message' => 'თქვენ არ გაქვთ უფლება ამ ვაკანსიაზე შეაწყვეტინოთ მუშაობა კანდიდატს'];
        }
        $redacted = [];
        if ($data['reason']['id'] == 15) {
            QualifyingCandidate::where('id', $data['id'])->update(['status_id'=> 1, 'end_date' => $currentDate->copy()->subDay(1)->toDateString()]);
            Vacancy::where('id', $find->vacancy_id)->update(['status_id' => 13]);
            $redacted['status'] = $findVacancy['status'];
        }else{

            QualifyingCandidate::where('id', $data['id'])->update(['status_id'=> 2,'end_date' => $currentDate->copy()->subDay(1)->toDateString()]);
            Vacancy::where('id', $find->vacancy_id)
                ->update([
                    'status_id' => 2,
                    'carry_in_head_date' => Carbon::now()->toDateTimeString(),
                    'start_date' => Carbon::now()->addWeek()
                ]);
            $redacted['status'] = $findVacancy['status'];
            $redacted['carry_in_head_date'] = $findVacancy['carry_in_head_date'];
            $reminder = [
                'vacancy_id' => $findVacancy['id'],
                'hr_id' => $findVacancy['hr_id'],
                'reason' => 'ვაკანსიაზე (ID: ' .$findVacancy['code']. ') '.$data['reason']['name_ka'].'დაიწყეთ ახალი კადრის მოძიება',
                'date' => Carbon::now()->addDay(1)->toDateTimeString()
            ];
            $this->addReminder($reminder, 1);

        }

        if (!QualifyingCandidate::where('candidate_id', $find->candidate_id)->whereNull('status_id')->exists()) {
            Candidate::where('id', $find->candidate_id)->update(['status_id'=> 9]);
        }

        if ($find->qualifying_type_id == 7) {
            WorkDay::where('id', $find->workDay->id)->delete();
        }
        if (VacancyReminder::where('vacancy_id', $find->vacancy_id)->whereDate('date', '>', Carbon::now())->exists()) {
            VacancyReminder::where('vacancy_id', $find->vacancy_id)->whereDate('date', '>', Carbon::now())->delete();
        }
        $this->addReason($data, $find);
        return ['type' => 's', 'message' => 'წარმატებით შესრულდა'];
    }

    function addReason($data, $find)  {
        $reason = new CandidateEndWork();

        $reason->qualifying_candidate_id = $find->id;
        $reason->candidate_id = $find->candidate_id;
        $reason->no_reason_id = $data['reason']['id'];
        $reason->reason_info = $data['reason_info'];
        $reason->user_id = Auth::id();
        $reason->save();
    }

    function addReminder($data, $stage = null) {
        VacancyReminder::where('vacancy_id', $data['vacancy_id'])->where('main', 1)->where('active', 0)->update(['active' => 1]);
        $reminder = new VacancyReminder();
        $reminder->vacancy_id = $data['vacancy_id'];
        $reminder->hr_id = $data['hr_id'];
        $reminder->main = 1;
        if ($stage !== null) {
            $reminder->main_stage_id = $stage;
        }
        $reminder->date = $data['date'];
        $reminder->reason = $data['reason'];
        $reminder->save();
    }
}
