<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Vacancy\VacancyDepositController;

// C
Route::post('save_vacancy_deposit', [VacancyDepositController::class, 'save']);


// R

// U
Route::post('update_vacancy_deposit', [VacancyDepositController::class, 'updateDeposit']);
Route::post('deposit_date_update', [VacancyDepositController::class, 'updateDate']);

// D

// F
