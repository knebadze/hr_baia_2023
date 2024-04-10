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
        try {
            $user = User::findOrFail(Auth::id());

            // Check if there's a new avatar uploaded
            if ($request->hasFile('avatar')) {
                $oldAvatar = $user->avatar;

                // Store the new avatar
                $filePath = $request->file('avatar')->store('user_avatar', 'public');

                // Update the user's avatar
                $user->avatar = $filePath;

                // Delete the old avatar if it exists and it's not a default avatar
                if ($oldAvatar && !in_array($oldAvatar, ['user_avatar/default_male.jpg', 'user_avatar/default_female.jpg'])) {
                    Storage::disk('public')->delete($oldAvatar);
                }
            }

            // Save changes to the user
            $user->save();

            return response()->json($user);
        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json(['error' => 'An error occurred while updating the user avatar.'], 500);
        }
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
