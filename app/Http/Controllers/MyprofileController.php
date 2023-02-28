<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\gender;
use App\Models\Notice;
use App\Models\Allergy;
use App\Models\Language;
use App\Models\NoReason;
use App\Models\Religion;
use App\Models\Candidate;
use App\Models\Education;
use App\Models\Specialty;
use App\Models\numberCode;
use App\Models\Profession;
use App\Models\Citizenship;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\MaritalStatus;
use PhpParser\Node\Expr\New_;
use App\Models\DrivingLicense;
use App\Models\Language_level;
use App\Models\Recommendation;
use App\Models\CandidateNotice;
use App\Models\Work_experience;
use App\Models\CandidateAllergy;
use App\Models\Additional_number;
use App\Models\CandidateLanguage;
use Illuminate\Support\Facades\DB;
use App\Models\Candidate_specialty;
use App\Models\Candidate_profession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Candidate_citizenship;
// use JetBrains\PhpStorm\Language;
use App\Models\GeneralCharacteristic;
use App\Models\RecommendationFromWhom;
use Illuminate\Support\Facades\Schema;
use App\Models\CandidateCharacteristic;
use App\Models\CandidateDrivingLicense;
use App\Models\CandidateRecommendation;
use App\Models\General_work_experience;

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

    public function update(Request $request)
    {
        $data = $request->all();

        $lang = app()->getLocale();
        $user = User::findOrFail($request->id);
        if ($lang == 'ka') {
            $user->name_ka = $request->name_ka;
        } elseif($lang == 'en') {
            $user->name_en = $request->name_en;
        } elseif($lang == 'ru') {
            $user->name_ru = $request->name_ru;
        }
        $user->email = $request->email;
        $user->number = $request->number;
        $user->date_of_birth = $request->date_of_birth;
        $user->gender_id = $request->gender_id;
        $user->update();
        return response()->json();
    }

    public function unknownUpdate(Request $request)
    {
        // $data = $request->data;
        // print_r('$request',$data);
        // exit;
        $id = 4;
        if ($request->data == 'candidate') {
            $id = 1;
        }elseif ($request->data == 'person') {
            $id = 2;
        }
        elseif ($request->data == 'company') {
            $id = 3;
        }

        // $user = Auth::user();
        $user = User::find(1);
        if ($user->user_type_id == 4) {

            $user->update([
                'user_type_id' => $id,
                'updated_at' => now()
            ]);
        }
        return response()->json($user);
    }

    public function destroy($id)
    {
        //
    }
}
