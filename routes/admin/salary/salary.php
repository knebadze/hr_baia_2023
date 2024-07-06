<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SalaryController;

// C
Route::post('salary_supplement', [SalaryController::class, 'supplement']);

// R

// U
Route::post('staff_agree_salary', [SalaryController::class, 'staffAgreeSalary']);
Route::post('disbursement_of_salary', [SalaryController::class, 'disbursementOfSalary']);

// D


// F
Route::post('salary_filter', [SalaryController::class, 'filter']);

