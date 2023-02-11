<?php

namespace App\Http\Controllers;

use App\Models\gender;
use App\Models\Allergy;
use App\Models\Language;
use App\Models\Religion;
use App\Models\Candidate;
use App\Models\Education;
use App\Models\Specialty;
use App\Models\Profession;
use App\Models\Citizenship;
use App\Models\Language_level;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\MaritalStatus;
use PhpParser\Node\Expr\New_;
use Illuminate\Support\Facades\DB;
// use JetBrains\PhpStorm\Language;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class MyprofileController extends Controller
{

    public function index()
    {
        $data = [];
        $auth = Auth::user();
        $gender = gender::all()->toArray();

        if (DB::table('candidates')->where('user_id', $auth->id)->exists()) {
            $candidate = Candidate::where('user_id', $auth->id)->first();
        }else{
            $candidate = Schema::getColumnListing('candidates');
        }

        //კლასიფიკატორები
        $nationality = Nationality::all()->toArray();
        $religions = Religion::all()->toArray();
        $educations = Education::all()->toArray();
        $maritalStatus = MaritalStatus::all()->toArray();
        $citizenship = Citizenship::all()->toArray();
        $professions = Profession::all()->toArray();
        $specialties = Specialty::all()->toArray();
        $allergies = Allergy::all()->toArray();
        $languages = Language::all()->toArray();
        $languageLevels = Language_level::all()->toArray();

        // dd($candidate);
        $data = [
            'auth' => $auth, 'candidate' => $candidate,
            'gender' => $gender, 'nationality' => $nationality,
            'religions' => $religions, 'educations ' => $educations,
            'maritalStatus' => $maritalStatus, 'citizenship' => $citizenship,
            'professions' => $professions, 'specialties' => $specialties,
            'allergies' => $allergies, 'languages' => $languages,
            'languageLevels' => $languageLevels

         ];
        return view ('user/candidateProfile', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
