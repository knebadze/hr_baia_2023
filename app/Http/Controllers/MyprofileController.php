<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class MyprofileController extends Controller
{



    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = User::where('id', Auth::id())->first();
        if ($user->avatar) {
            File::delete(public_path('images/user-avatar/'.$user->avatar));

        }
        $upload_path = public_path('images/user-avatar/');
        $file_name = $request->avatar->getClientOriginalName();
        $generated_new_name = time() . '.' . $file_name;
        $request->avatar->move($upload_path, $generated_new_name);
        $user->avatar = $generated_new_name;
        $user->update();
        return response()->json($user);
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        //
    }

    

    public function destroy($id)
    {
        //
    }
}
