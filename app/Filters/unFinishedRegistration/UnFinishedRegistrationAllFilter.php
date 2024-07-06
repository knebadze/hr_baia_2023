<?php

namespace App\Filters\unFinishedRegistration;

use Illuminate\Support\Facades\Auth;


class UnFinishedRegistrationAllFilter
{
    function __invoke($query, $request)
    {
        return $query->when(Auth::guard('staff')->user()->role_id != 1, function ($query) {
            $query->where('was_assigned_id', '=', Auth::guard('staff')->id());
        });;
    }
}
