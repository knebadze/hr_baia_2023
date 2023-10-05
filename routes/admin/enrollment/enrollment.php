<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EnrollmentController;

//C
Route::post('vacancy_enrollment', [EnrollmentController::class, 'vacancyEnrollment']);
Route::post('register_enrollment', [EnrollmentController::class, 'registerEnrolment']);

// R
Route::post('get_register_enrollment_info', [EnrollmentController::class, 'getRegisterEnrollmentInfo']);

// U
Route::post('enrollment_update', [EnrollmentController::class, 'update']);
Route::post('enrollment_agree', [EnrollmentController::class, 'agree']);

// D

// F
Route::post('enrollment_filter', [EnrollmentController::class, 'filter']);
