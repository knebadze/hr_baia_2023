<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Models\RegistrationFee;
use App\Http\Controllers\Controller;

class RegistrationFeeController extends Controller
{
    function registerUpdate(Request $request)  {
        $result = ['status' => 200];
        try {
            $result['data'] = RegistrationFee::where('id', $request->id)->update([
                    // 'money' => $request->enrolled,
                    'enroll_date' => $request->date,
                ]);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }


        return response()->json($result);
    }
}
