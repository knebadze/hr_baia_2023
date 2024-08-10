<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VacancyListController;
use App\Http\Controllers\CandidateInfoController;
use App\Http\Controllers\Admin\AdminCandidateController;
use App\Http\Controllers\Admin\RegistrationFeeController;


//C
Route::post('add_user', [CandidateInfoController::class, 'addUser']);
Route::post('add_candidate', [CandidateInfoController::class, 'addCandidate']);
Route::post('add_candidate_recommendation', [CandidateInfoController::class, 'addCandidateRecommendation']);
Route::post('add_candidate_file', [CandidateInfoController::class, 'addCandidateFile']);

//შესაცვლელია
// Route::post('add_work_information', [WorkInformationController::class, 'store']);

// R
Route::get('fetch_candidate', [AdminCandidateController::class, 'fetch']);
Route::post('find_candidate_model', [CandidateInfoController::class, 'findModel']);
Route::post('candidate_work_info_data', [AdminCandidateController::class, 'workInfoData']);
Route::post('candidate_family_work_info_data', [AdminCandidateController::class, 'familyWorkInfoData']);
Route::post('get_candidate_additional_number', [AdminCandidateController::class, 'additionalNumberInfo']);
Route::post('get_candidate_full_info', [AdminCandidateController::class, 'getFullInfo']);

// U
Route::post('update_candidate_recommendation', [CandidateInfoController::class, 'updateCandidateRecommendation']);
Route::post('register_update', [RegistrationFeeController::class, 'registerUpdate']);

Route::post('update_candidate', [AdminCandidateController::class, 'update']);

// D
Route::post('delete_candidate_info', [CandidateInfoController::class, 'deleteCandidateInfo']);
Route::post('delete_candidate_recommendation', [CandidateInfoController::class, 'deleteCandidateRecommendation']);

Route::post('delete_candidate', [AdminCandidateController::class, 'delete']);

// F

Route::post('guest_candidate_filter', [CandidateController::class, 'filter']);
Route::post('candidate_filter', [AdminCandidateController::class, 'filter']);

// S
Route::post('send_sms_candidate', [AdminCandidateController::class, 'sendSms']);
Route::post('/send_vacancy_to_candidate', [VacancyListController::class, 'sendVacancyToCandidate']);
