<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployerController;

// C

// R
Route::get('fetch_employer', [EmployerController::class, 'fetch']);
// U
Route::post('employer_update', [EmployerController::class, 'update']);

// D
Route::post('employer_delete/{id}', [EmployerController::class, 'destroy']);
// F
Route::post('employer_filter', [EmployerController::class, 'filter']);
