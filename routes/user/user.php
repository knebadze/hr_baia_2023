<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyprofileController;

// C
Route::post('upload_avatar', [MyprofileController::class, 'store']);

// R
Route::post('resume_data', [ResumeController::class, 'resumeData']);

// U
Route::post('profile_update', [MyprofileController::class, 'update']);
Route::post('change_password', [ChangePasswordController::class, 'change'])->name('change_password');

// D

// F
