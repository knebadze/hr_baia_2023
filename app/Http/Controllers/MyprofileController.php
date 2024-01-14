<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
        // $user->clearMediaCollection('user_avatar');

        // // Upload new profile picture
        // $user->addMedia($request->avatar)
        //     ->toMediaCollection('user_avatar');

        if ($user->avatar && ($user->avatar != 'user_avatar/hL1pnPeKu9z9a7jUP81TcNxTfcf9l2YGzMwh31G0.jpg' || $user->avatar != 'user_avatar/kB1TbCAm6HHw0BzJZEmEFB8IR0NZCdxZF9bOEHpv.jpg')) {
            Storage::disk('public')->delete($user->avatar);

        }
        if (isset($request->avatar)) {
            $filePath = $request->avatar->store('user_avatar', 'public');
        }
        if (isset($filePath)) {
            $user->avatar = $filePath;
        }
        // $upload_path = public_path('images/user-avatar/');
        // $file_name = $request->avatar->getClientOriginalName();
        // $generated_new_name = time() . '.' . $file_name;
        // $request->avatar->move($upload_path, $generated_new_name);
        // $user->avatar = $generated_new_name;
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
