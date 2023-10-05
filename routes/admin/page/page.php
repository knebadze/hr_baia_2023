<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HrController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\AdminCandidateController;
use App\Http\Controllers\Admin\GlobalVariableController;
use App\Http\Controllers\Hr\SelectionPersonalController;
use App\Http\Controllers\Admin\RelevantVacancyController;

Route::prefix('admin')->group(function () {
    Route::get('candidate_update/{id?}', [AdminCandidateController::class, 'edit'])
        ->name('admin.candidate.update');

    Route::get('add_candidate', [AdminCandidateController::class, 'addCandidate'])
        ->name('admin.add.candidate');

    Route::get('vacancy_attached/{id?}', [VacancyAttachedController::class, 'index'])
        ->name('admin.vacancy.attached');

    Route::get('relevant_vacancy/{id?}', [RelevantVacancyController::class, 'index'])
        ->name('admin.relevant.vacancy');

    Route::get('vacancy', [AdminVacancyController::class, 'index'])
        ->name('admin.vacancy');

    Route::get('vacancy_deposit/{id?}', [VacancyDepositController::class, 'index'])
        ->name('admin.vacancy.deposit');

    Route::get('enrollment', [EnrollmentController::class, 'index'])
        ->name('admin.enrollment');

    Route::get('salary', [SalaryController::class, 'index'])
        ->name('admin.salary');

    Route::get('employer_vacancy/{id?}', [EmployerController::class, 'attached'])
        ->name('admin.employer.vacancy');

    Route::get('hr', [HrController::class, 'index'])
        ->name('admin.hr');

    Route::get('candidate', [AdminCandidateController::class, 'index'])
        ->name('admin.candidate');

    Route::get('employer', [EmployerController::class, 'index'])
        ->name('admin.employer');

    Route::get('reminder', [ReminderController::class, 'index'])
        ->name('admin.reminder');

    Route::get('global_variable', [GlobalVariableController::class, 'index'])
        ->name('admin.global');

    Route::get('selection_personal/{id?}', [SelectionPersonalController::class, 'index'])
        ->name('selection.personal');

    Route::get('vacancy_personal/{id?}', [SelectionPersonalController::class, 'vacancyPersonal'])
        ->name('vacancy.personal');
});
