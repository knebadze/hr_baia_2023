<?php

namespace App\Http\Controllers;

use App\Traits\VerifyCodeTrait;
use Illuminate\Http\Request;

class CheckVerifyCodeController extends Controller
{
    use VerifyCodeTrait;

    function check(Request $request) {

        // dd($request->all());
        $result = $this->checkVerifyCode($request->all());
        return response()->json($result);
    }
}
