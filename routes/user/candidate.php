<?php

use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Route;
// R
Route::get('guest_fetch_candidate', [CandidateController::class, 'fetch']);
