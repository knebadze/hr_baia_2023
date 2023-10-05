<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Hr\SelectionPersonalController;

// C
Route::post('/add_vacancy_personal', [SelectionPersonalController::class, 'addPersonal']);
Route::post('/add_vacancy_personal_was_employed', [SelectionPersonalController::class, 'addPersonalWasEmployed']);

// R
Route::post('/get_add_personal_info', [SelectionPersonalController::class, 'addPersonalInfo']);
Route::post('/get_end_work_info', [SelectionPersonalController::class, 'getEndWorkInfo']);
Route::post('/get_schedule_info', [SelectionPersonalController::class, 'getScheduleInfo']);
Route::post('/get_work_day_info', [SelectionPersonalController::class, 'getWorkDayInfo']);
Route::post('/get_add_personal_was_employed_info', [SelectionPersonalController::class, 'getAddPersonalWasEmployedInfo']);

// U
Route::post('/update_vacancy_personal', [SelectionPersonalController::class, 'updatePersonal']);
Route::post('/move_end_date', [SelectionPersonalController::class, 'updateEndDate']);

// D
Route::post('/delete_vacancy_personal', [SelectionPersonalController::class, 'deletePersonal']);

// F
Route::post('find_personal', [SelectionPersonalController::class, 'find']);
