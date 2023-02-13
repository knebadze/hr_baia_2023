<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\gender;
use App\Models\Notice;
use App\Models\Allergy;
use App\Models\Language;
use App\Models\Religion;
use App\Models\Candidate;
use App\Models\Candidate_citizenship;
use App\Models\Candidate_profession;
use App\Models\Candidate_specialty;
use App\Models\CandidateAllergy;
use App\Models\CandidateLanguage;
use App\Models\Education;
use App\Models\Specialty;
use App\Models\Profession;
use App\Models\Citizenship;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\MaritalStatus;
use PhpParser\Node\Expr\New_;
use App\Models\Language_level;
use App\Models\Recommendation;
use App\Models\Work_experience;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// use JetBrains\PhpStorm\Language;
use App\Models\RecommendationFromWhom;
use Illuminate\Support\Facades\Schema;
use App\Models\General_work_experience;

class MyprofileController extends Controller
{

    public function index()
    {
        $data = [];
        $auth = Auth::user();
        $gender = gender::all()->toArray();

        if (DB::table('candidates')->where('user_id', $auth->id)->exists()) {
            $candidate = Candidate::where('user_id', $auth->id)->first();
            // dd($candidate);
        }else{
            $candidate = Schema::getColumnListing('candidates');
            // dd($candidate);
        }

        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_languages')->where('candidate_id', $candidate->id)->exists()) {
            $candidateLanguages = CandidateLanguage::where('candidate_id', $candidate->id)->get();
        }else{
            $candidateLanguages= Schema::getColumnListing('candidate_languages');
        }

        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_allergies')->where('candidate_id', $candidate->id)->exists()) {
            $candidateAllergies = CandidateAllergy::where('candidate_id', $candidate->id)->get();
        }else{
            $candidateAllergies= Schema::getColumnListing('candidate_allergies');
        }

        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_citizenships')->where('candidate_id', $candidate->id)->exists()) {
            $candidateCitizenships = Candidate_citizenship::where('candidate_id', $candidate->id)->get()->toArray();
        }else{
            $candidateCitizenships = Schema::getColumnListing('candidate_citizenships');
        }

        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_professions')->where('candidate_id', $candidate->id)->exists()) {
            $candidateProfessions = Candidate_profession::where('candidate_id', $candidate->id)->get();
        }else{
            $candidateProfessions = Schema::getColumnListing('candidate_professions');
        }

        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_specialties')->where('candidate_id', $candidate->id)->exists()) {
            $candidateSpecialties = Candidate_specialty::where('candidate_id', $candidate->id)->get();
        }else{
            $candidateSpecialties = Schema::getColumnListing('candidate_specialties');
        }

        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('general_work_experiences')->where('candidate_id', $candidate->id)->exists()) {
            $candidateWorkExperience = General_work_experience::where('candidate_id', $candidate->id)->get();
        }else{
            $candidateWorkExperience = Schema::getColumnListing('general_work_experiences');
        }

        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_recommendations')->where('candidate_id', $candidate->id)->exists()) {
            $candidateRecommendation = Recommendation::where('candidate_id', $candidate->id)->first();
        }else{
            $candidateRecommendation = Schema::getColumnListing('candidate_recommendations');
        }

        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_notices')->where('candidate_id', $candidate->id)->exists()) {
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
            'maritalStatus' => $maritalStatus,
            'citizenship' => $citizenship, 'candidateCitizenships' => $candidateCitizenships,
            'professions' => $professions, 'candidateProfessions' => $candidateProfessions,
            'specialties' => $specialties,'candidateSpecialties' => $candidateSpecialties,
            'allergies' => $allergies, 'candidateAllergies' => $candidateAllergies,
            'languages' => $languages, 'languageLevels' => $languageLevels, 'candidateLanguages' => $candidateLanguages,
            'workExperiences' => $workExperiences,'candidateWorkExperience' => $candidateWorkExperience,
            'recommendations' => $recommendations, 'candidateRecommendation' => $candidateRecommendation, 'recommendationFromWhom' => $recommendationFromWhom,
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

    public function destroy($id)
    {
        //
    }
}
