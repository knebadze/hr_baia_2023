<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\VacancyActionController;
use App\Http\Controllers\GetVacancyInfoController;
use App\Http\Controllers\User\PostVacancyController;
use App\Http\Controllers\Admin\RelevantVacancyController;
use App\Http\Controllers\Admin\VacancyAttachedController;

// C

Route::post('send_add_vacancy_validate_sms', [PostVacancyController::class, 'verifyNumber']);
Route::post('add_vacancy', [PostVacancyController::class, 'store']);

// R
Route::post('/get_classificatory', [GetVacancyInfoController::class, 'getClassificatory']);
Route::post('/get_vacancy_filter_classificatory', [GetVacancyInfoController::class, 'getVacancyFilterClassificatory']);
Route::post('/get_status_change_info', [GetVacancyInfoController::class, 'statusChangeInfo']);
Route::post('/get_vacancy_full_info', [GetVacancyInfoController::class, 'getVacancyFullInfo']);
Route::post('/get_vacancy_redacted_history_info', [GetVacancyInfoController::class, 'vacancyRedactedHistory']);
Route::post('/find_vacancy', [GetVacancyInfoController::class, 'findVacancy']);

Route::post('admin_relevant_vacancy_data', [RelevantVacancyController::class, 'adminData']);

// U
Route::post('update_vacancy', [VacancyActionController::class, 'update']);
Route::post('update_vacancy_status', [VacancyActionController::class, 'updateStatus']);
Route::post('carry_in_head_vacancy', [VacancyActionController::class, 'carryInHead']);
Route::post('change_hr_in_vacancy', [VacancyActionController::class, 'changeHr']);

Route::post('/end_work', [VacancyAttachedController::class, 'endWork']);

// D
Route::post('delete_vacancy', [VacancyActionController::class, 'delete']);

// F
Route::post('vacancy_filter', [VacancyController::class, 'filter']);
Route::post('admin_vacancy_filter', [VacancyActionController::class, 'filter']);

// SMS
Route::post('send_sms_add_vacancy', [PostVacancyController::class, 'sendSms'])->middleware('csrf.custom');


include('deposit.php');
include('personal.php');
include('reminder.php');
