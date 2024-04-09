<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermConditionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('term_condition');
    }
}
