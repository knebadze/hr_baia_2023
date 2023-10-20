<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CandidateInfoController;
use App\Http\Controllers\Admin\AdminCandidateController;
use App\Http\Controllers\Admin\RegistrationFeeController;
use App\Http\Controllers\Candidate\WorkInformationController;


//C
Route::post('add_user', [CandidateInfoController::class, 'addUser']);
Route::post('add_candidate', [CandidateInfoController::class, 'addCandidate']);
Route::post('add_candidate_recommendation', [CandidateInfoController::class, 'addCandidateRecommendation']);
Route::post('add_candidate_file', [CandidateInfoController::class, 'addCandidateFile']);

//შესაცვლელია
// Route::post('add_work_information', [WorkInformationController::class, 'store']);

// R
Route::post('candidate_work_info_data', [AdminCandidateController::class, 'workInfoData']);
Route::post('candidate_family_work_info_data', [AdminCandidateController::class, 'familyWorkInfoData']);
Route::post('get_candidate_additional_number', [AdminCandidateController::class, 'additionalNumberInfo']);

// U
Route::post('update_candidate_recommendation', [CandidateInfoController::class, 'updateCandidateRecommendation']);
Route::post('register_update', [RegistrationFeeController::class, 'registerUpdate']);

Route::post('update_candidate', [AdminCandidateController::class, 'update']);

// D
Route::post('delete_candidate_info', [CandidateInfoController::class, 'deleteCandidateInfo']);
Route::post('delete_candidate_recommendation', [CandidateInfoController::class, 'deleteCandidateRecommendation']);

Route::post('delete_candidate', [AdminCandidateController::class, 'delete']);

// F

Route::post('user_candidate_filter', [CandidateController::class, 'filter']);
Route::post('candidate_filter', [AdminCandidateController::class, 'filter']);
