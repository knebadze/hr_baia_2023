<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyprofileController extends Controller
{



    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $user = User::where('id', Auth::id())->first();

        if ($user->avatar && ($user->avatar != 'user_avatar/default_male.jpg' || $user->avatar != 'user_avatar/default_female.jpg')) {
            Storage::disk('public')->delete($user->avatar);
        }
        if (isset($request->avatar)) {
            $filePath = $request->avatar->store('user_avatar', 'public');
        }
        if (isset($filePath)) {
            $user->avatar = $filePath;
        }
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
