<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HrController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\SmsPageController;
use App\Http\Controllers\Admin\EmployerController;
use App\Http\Controllers\Admin\ReminderController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\AdminVacancyController;
use App\Http\Controllers\Admin\AdminCandidateController;
use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Admin\CompanyInfoController;
use App\Http\Controllers\Admin\GlobalVariableController;
use App\Http\Controllers\HR\SelectionPersonalController;
use App\Http\Controllers\Admin\RelevantVacancyController;
use App\Http\Controllers\Admin\UnfinishedRegistrationController;
use App\Http\Controllers\Admin\VacancyAttachedController;
use App\Http\Controllers\Admin\Vacancy\VacancyDepositController;

Route::prefix('admin')->middleware('auth:staff')->group(function () {
    Route::get('candidate_update/{id?}', [AdminCandidateController::class, 'edit'])
        ->name('admin.candidate.update');

    Route::get('add_candidate', [AdminCandidateController::class, 'addCandidate'])
        ->name('admin.add_candidate');

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

    Route::get('administrator', [AdministratorController::class, 'index'])
        ->name('admin.administrator');

    Route::get('unfinished_registration', [UnfinishedRegistrationController::class, 'index'])
        ->name('admin.unfinished.registration');

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

    Route::get('testimonial', [TestimonialController::class, 'index'])
        ->name('admin.testimonial');

    Route::get('sms_template', [SmsPageController::class, 'index'])
        ->name('admin.sms.template');

    Route::get('company_info', [CompanyInfoController::class, 'index'])
        ->name('admin.company.info');
});
