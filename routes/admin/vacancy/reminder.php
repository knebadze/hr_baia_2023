<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ReminderController;

// C
Route::post('add_reminder_vacancy', [ReminderController::class, 'addReminder']);

// R
Route::post('/get_reminder_info', [ReminderController::class, 'getReminderInfo']);
Route::post('/hr_reminder_info', [ReminderController::class, 'hrReminderInfo']);
// U
Route::post('update_vacancy_reminder', [ReminderController::class, 'update']);

// D

// F
Route::post('vacancy_reminder_filter', [ReminderController::class, 'filter']);
