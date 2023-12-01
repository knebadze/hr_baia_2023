<?php

namespace App\Services\Admin;

use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Admin\ReminderDataRepository;

class ReminderService
{
    protected ReminderDataRepository $reminderDataRepository;
    public function __construct()
    {
        $this->reminderDataRepository = new ReminderDataRepository;
    }

    function data() {
        if (Auth::user()->role_id == 1) {
            $result = ['data' => $this->reminderDataRepository->admin(), 'role_id' => Auth::user()->role_id];
        }else{
            $result = ['data' => $this->reminderDataRepository->hr(), 'role_id' => Auth::user()->role_id];
        }

        return $result;
    }
    function add($data) {
        // dd($data);
        $auth = Auth::user();
        if ($auth->role_id == 2) {
            $hr_id = Auth::user()->hr->id;
        }else{
            $vacancy = Vacancy::where('id', $data['vacancy_id'])->select('id', 'hr_id')->first();
            $hr_id = $vacancy->hr_id;
        }
        $result = $this->reminderDataRepository->addReminder($data, $hr_id);
        return $result;
    }

}
