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
use App\Models\General_work_experience;
use App\Models\Language_level;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\MaritalStatus;
use App\Models\Notice;
use App\Models\Recommendation;
use App\Models\RecommendationFromWhom;
use App\Models\Work_experience;
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
            // dd($candidate);
        }

        if (DB::table('candidates')->exists() && DB::table('general_work_experiences')->where('candidate_id', $candidate->id)->exists()) {
            $candidateWorkExperience = General_work_experience::where('candidate_id', $candidate->id)->get();
        }else{
            $candidateWorkExperience = Schema::getColumnListing('general_work_experiences');
        }

        if (DB::table('candidates')->exists() && DB::table('candidate_recommendations')->where('candidate_id', $candidate->id)->exists()) {
            $candidateRecommendation = Recommendation::where('candidate_id', $candidate->id)->first();
        }else{
            $candidateRecommendation = Schema::getColumnListing('candidate_recommendations');
        }

        if (DB::table('candidates')->exists() && DB::table('candidate_notices')->where('candidate_id', $candidate->id)->exists()) {
            $candidateNotices = Recommendation::where('candidate_id', $candidate->id)->get();
        }else{
            $candidateNotices = Schema::getColumnListing('candidate_notices');
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
        $workExperiences = Work_experience::all()->toArray();
        $recommendations = Recommendation::all()->toArray();
        $recommendationFromWhom = RecommendationFromWhom::all()->toArray();
        $notices = Notice::All()->toArray();

        // dd($candidate);
        $data = [
            'auth' => $auth, 'candidate' => $candidate,
            'gender' => $gender, 'nationality' => $nationality,
            'religions' => $religions, 'educations ' => $educations,
            'maritalStatus' => $maritalStatus, 'citizenship' => $citizenship,
            'professions' => $professions, 'specialties' => $specialties,
            'allergies' => $allergies, 'languages' => $languages,
            'languageLevels' => $languageLevels, 'workExperiences' => $workExperiences,
            'candidateWorkExperience' => $candidateWorkExperience, 'recommendations' => $recommendations,
            'candidateRecommendation' => $candidateRecommendation, 'recommendationFromWhom' => $recommendationFromWhom,
            'notices' => $notices, 'candidateNotices' => $candidateNotices
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
        return response()->json('ok');
    }

    public function destroy($id)
    {
        //
    }
}
