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
use App\Repositories\Vacancy\VacancyRedactedRepository;

class EndWorkService
{

    protected VacancyRedactedRepository $vacancyRedactedRepository;
    public function __construct()
    {

        $this->vacancyRedactedRepository = new VacancyRedactedRepository;
    }
    function end($data)  {
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
            QualifyingCandidate::where('id', $data['id'])->update(['success'=> 1, 'end_date' => $currentDate->copy()->subDay(1)->toDateString()]);
            Vacancy::where('id', $find->vacancy_id)->update(['status_id' => 13]);
            $redacted['status'] = $findVacancy['status'];
            $this->vacancyRedactedRepository->save($findVacancy['id'], $redacted);
        }else{

            QualifyingCandidate::where('id', $data['id'])->update(['end_date' => $currentDate->copy()->subDay(1)->toDateString()]);
            Vacancy::where('id', $find->vacancy_id)->update(['status_id' => 2, 'carry_in_head_date' => Carbon::now()->toDateTimeString()]);
            $redacted['status'] = $findVacancy['status'];
            $redacted['carry_in_head_date'] = $findVacancy['carry_in_head_date'];
            $this->vacancyRedactedRepository->save($findVacancy['id'], $redacted);

        }

        if (!QualifyingCandidate::where('candidate_id', $find->candidate_id)->whereDate('end_date', '>', Carbon::today())->exists()) {
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
}
