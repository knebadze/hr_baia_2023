<?php

namespace App\Services\Admin;

use Carbon\Carbon;
use App\Models\Vacancy;
use App\Models\Candidate;
use App\Models\CandidateEndWork;
use App\Models\QualifyingCandidate;
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
        // dd($data['id']);

        $currentDate = Carbon::now();
        $find = QualifyingCandidate::findOrFail($data['id']);
        $findVacancy = Vacancy::where('id', $find->vacancy_id)->with('status')->first()->toArray();
        if (Auth::user()->role_id == 2 && $findVacancy['hr_id'] != Auth::user()->hr->id) {
            return ['type' => 'e', 'message' => 'თქვენ არ გაქვთ უფლება ამ ვაკანსიაზე შეაწყვეტინოთ მუშაობა კანდიდატს'];
        }
        $redacted = [];
        if ($data['reason']['id'] == 15) {
            QualifyingCandidate::where('id', $data['id'])->update(['success'=> 1, 'end_date' => $currentDate->copy()->subDay(1)->toDateString()]);
            Vacancy::where('id', $find->vacancy_id)->update(['status_id', 13]);
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
        $this->addReason($data, $find);
        return ['type' => 's', 'message' => 'წარმატებით შესრულდა'];
    }

    function addReason($data, $find)  {
        $reason = new CandidateEndWork();
        $reason->qualifying_candidate_id = $find->id;
        $reason->candidate->id = $find->candidate_id;
        $reason->no_reason_id = $data['reason']['id'];
        $reason->reason_info = $data['reason_info'];
        $reason->user_id = Auth::id();
        $reason->save();
    }
}
