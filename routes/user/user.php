<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyprofileController;
use App\Http\Controllers\User\ResumeController;
use App\Http\Controllers\Auth\ChangePasswordController;

// C
Route::post('upload_avatar', [MyprofileController::class, 'store']);

// R
Route::post('resume_data', [ResumeController::class, 'resumeData']);

// U
// Route::post('profile_update', [MyprofileController::class, 'update']);
Route::post('change_password', [ChangePasswordController::class, 'change'])->name('change_password');

// D

// F
