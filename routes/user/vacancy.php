<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\MyVacancyController;

// C
Route::post('/interest_vacancy', [VacancyController::class, 'interest']);

// R
Route::get('/fetch_vacancy', [VacancyController::class, 'fetch']);
Route::post('/check_and_verify_number', [MyVacancyController::class, 'checkAndVerify']);
Route::post('/find_my_vacancy', [MyVacancyController::class, 'find']);
Route::post('/get_interest_data', [MyVacancyController::class, 'getInterestData']);

// U
Route::post('/do_not_like_candidate', [MyVacancyController::class, 'doNotLike']);
Route::post('/like_candidate', [MyVacancyController::class, 'like']);

// D

// F

