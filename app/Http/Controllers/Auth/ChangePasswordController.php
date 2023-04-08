<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index()
    {
       return view('auth.passwords.change_password');
    }

    public function change(Request $request)
    {

        // print_r($request->all());
        // exit;
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
        ]);
        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return response()->json(['type' => 'e', 'message' => "ძველი პაროლი არასწორია!"]);
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return response()->json(['type' => 's', 'message' => "პაროლი წარმატებით შეიცვალა!"]);
        // return back()->with("status", "პაროლი წარმატებით შეიცვალა!");
    }
}
