<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ImageUploadRequest;

class MyprofileController extends Controller
{



    public function create()
    {
        //
    }

    public function store(ImageUploadRequest $request)
    {
        try {
            $user = User::findOrFail($request->id);

            if ($request->hasFile('avatar')) {
                $oldAvatar = $user->avatar;
                $avatar = $request->file('avatar');

                $image = Image::make($avatar)->fit(300, 300);
                $filePath = 'user_avatar/' . $avatar->hashName();
                Storage::disk('public')->put($filePath, (string) $image->encode());

                $user->avatar = $filePath;

                if ($oldAvatar && !in_array($oldAvatar, ['user_avatar/default_male.jpg', 'user_avatar/default_female.jpg'])) {
                    Storage::disk('public')->delete($oldAvatar);
                }
            }

            $user->save();

            return response()->json($user);
        } catch (\Exception $e) {
            Log::error('Failed to upload image: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the user avatar.'. $e], 500);
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
