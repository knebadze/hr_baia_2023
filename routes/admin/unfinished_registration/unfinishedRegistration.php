<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UnfinishedRegistrationController;

Route::post('unfinished_registration', [UnfinishedRegistrationController::class, 'index']);
Route::post('fetch_unfinished_registration', [UnfinishedRegistrationController::class, 'fetch']);
Route::post('completed_registration', [UnfinishedRegistrationController::class, 'completed']);
Route::post('unfinished_registration_filter', [UnfinishedRegistrationController::class, 'filter']);
Route::post('unfinished_registration_update', [UnfinishedRegistrationController::class, 'update']);
Route::post('unfinished_registration_delete', [UnfinishedRegistrationController::class, 'delete']);
