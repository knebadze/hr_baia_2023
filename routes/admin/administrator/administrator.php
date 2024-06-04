<?php

use App\Http\Controllers\Admin\AdministratorController;
use Illuminate\Support\Facades\Route;

Route::post('get_administrator', [AdministratorController::class, 'fetchData']);
