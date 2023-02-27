<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Additional_number;
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
use App\Models\CandidateCharacteristic;
use App\Models\CandidateDrivingLicense;
use App\Models\CandidateLanguage;
use App\Models\CandidateNotice;
use App\Models\CandidateRecommendation;
use App\Models\Education;
use App\Models\Specialty;
use App\Models\Profession;
use App\Models\Citizenship;
use App\Models\DrivingLicense;
use App\Models\Nationality;
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
use App\Models\GeneralCharacteristic;
use App\Models\NoReason;
use App\Models\numberCode;

class UserProfileController extends Controller
{
    public function index()
    {
        $data = [];

        $auth = Auth::user();
        $gender = gender::all()->toArray();

        if (DB::table('candidates')->where('user_id', $auth->id)->exists()) {
            $candidate = Candidate::where('user_id', $auth->id)->first();
            // dd($candidate);
        } else {
            $candidate =  Schema::getColumnListing('candidates');
            $candidate = array_map(function ($item) { return ""; }, array_flip($candidate));
        }

        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_languages')->where('candidate_id', $candidate->id)->exists()) {
            $candidateLanguages = CandidateLanguage::where('candidate_id', $candidate->id)->with('language')->with('level')->get();
        }else{
            // $candidateLanguages= Schema::getColumnListing('candidate_languages');
            $candidateLanguages = [];
            // [array_map(function ($item) {  return ""; }, array_flip($candidateLanguages))];
        }

        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_allergies')->where('candidate_id', $candidate->id)->exists()) {
            $candidateAllergy = CandidateAllergy::where('candidate_id', $candidate->id)->select('allergy_id')->get();
            foreach ($candidateAllergy as $key => $value) {
                $candidateAllergies[] = $value['allergy_id'];
            }
        }else{
            $candidateAllergies = [];
            // $candidateAllergies = [array_map(function ($item) {  return ""; }, array_flip($candidateAllergies))];

        }

        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_citizenships')->where('candidate_id', $candidate->id)->exists()) {
            $candidateCitizenship = Candidate_citizenship::where('candidate_id', $candidate->id)->select('citizenship_id')->get()->toArray();
            foreach ($candidateCitizenship as $key => $value) {
                $candidateCitizenships[] = $value['citizenship_id'];
            }
        }else{
            // $candidateCitizenships = Schema::getColumnListing('candidate_citizenships');
            // $candidateCitizenships = [array_map(function ($item) {  return ""; }, array_flip($candidateCitizenships))];
            $candidateCitizenships = [];
        }
        // dd(DB::table('candidates')->where('user_id', $auth->id)->exists(),  Candidate_profession::all(), $candidate->id);
        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_professions')->where('candidate_id', $candidate->id)->exists()) {
            $candidateProfession = Candidate_profession::where('candidate_id', $candidate->id)->select('profession_id')->get();
            foreach ($candidateProfession as $key => $value) {
                $candidateProfessions[] = $value['profession_id'];
            }
            // dd($candidateProfessions);
        }else{
            // $candidateProfessions = Schema::getColumnListing('candidate_professions');
            $candidateProfessions = [];
            // [array_map(function ($item) {  return ""; }, array_flip($candidateProfessions))];
        }

        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_specialties')->where('candidate_id', $candidate->id)->exists()) {
            $candidateSpecialty = Candidate_specialty::where('candidate_id', $candidate->id)->select('specialty_id')->get();
            foreach ($candidateSpecialty as $key => $value) {
                $candidateSpecialties[] = $value['specialty_id'];
            }
        }else{
            // $candidateSpecialties = Schema::getColumnListing('candidate_specialties');
            $candidateSpecialties = [];
            // [array_map(function ($item) {  return ""; }, array_flip($candidateSpecialties))];
        }

        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_characteristics')->where('candidate_id', $candidate->id)->exists()) {
            $candidateCharacteristics = CandidateCharacteristic::where('candidate_id', $candidate->id)->select('general_characteristic_id')->get();
            foreach ($candidateCharacteristics as $key => $value) {
                $candidateCharacteristic[] = $value['general_characteristic_id'];
            }
        }else{
            // $candidateSpecialties = Schema::getColumnListing('candidate_specialties');
            $candidateCharacteristic = [];
            // [array_map(function ($item) {  return ""; }, array_flip($candidateSpecialties))];
        }

        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('general_work_experiences')->where('candidate_id', $candidate->id)->exists()) {
            $candidateWorkExperience = General_work_experience::where('candidate_id', $candidate->id)->with('workExperience')->get()->toArray();
            // dd($candidateWorkExperience);
        }else{
            // $candidateWorkExperience = Schema::getColumnListing('general_work_experiences');
            // $candidateWorkExperience = [array_map(function ($item) {  return ""; }, array_flip($candidateWorkExperience))];
            $candidateWorkExperience = [];
        }

        // if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_recommendations')->where('candidate_id', $candidate->id)->exists()) {
        //     $candidateRecommendation = CandidateRecommendation::where('candidate_id', $candidate->id)->with('recommendationWhom')->first();
        // }else{
        //     // $candidateRecommendation = Schema::getColumnListing('candidate_recommendations');
        //     // $candidateRecommendation = [array_map(function ($item) {  return ""; }, array_flip($candidateRecommendation))];
        //     $candidateRecommendation = [];
        // }

        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_notices')->where('candidate_id', $candidate->id)->exists()) {
            $candidateNotices = CandidateNotice::where('candidate_id', $candidate->id)->with('notice')->get();
        }else{
            // $candidateNotices = Schema::getColumnListing('candidate_notices');
            // $candidateNotices = [array_map(function ($item) {  return ""; }, array_flip($candidateNotices))];
            $candidateNotices = [];
        }
        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_driving_licenses')->where('candidate_id', $candidate->id)->exists()) {
            $candidateDrivingLicense = CandidateDrivingLicense::where('candidate_id', $candidate->id)->select('driving_license_id')->get()->toArray();
        }else{
            // $candidateNotices = Schema::getColumnListing('candidate_notices');
            // $candidateNotices = [array_map(function ($item) {  return ""; }, array_flip($candidateNotices))];
            $candidateDrivingLicense = [];
        }
        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('additional_numbers')->where('candidate_id', $candidate->id)->exists()) {
            $candidateNumber = Additional_number::where('candidate_id', $candidate->id)->with('numberCode')->get()->toArray();
            // dd($candidateNumber);
        }else{
            // $candidateNotices = Schema::getColumnListing('candidate_notices');
            // $candidateNotices = [array_map(function ($item) {  return ""; }, array_flip($candidateNotices))];
            $candidateNumber = [];
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
        // $recommendationFromWhom = RecommendationFromWhom::all()->toArray();
        $notices = Notice::All()->toArray();
        $noExperienceReason = NoReason::where('category', 1)->get()->toArray();
        // $noRecommendationReason = NoReason::where('category', 2)->get()->toArray();
        $drivingLicense = DrivingLicense::all()->toArray();
        $numberCode = numberCode::all()->toArray();
        $characteristic = GeneralCharacteristic::all()->toArray();

        // dd($candidate);
        $data = [
            "basic" => [
                'auth' => $auth,
            ],
            "candidate" => [
                'candidate' => $candidate,

                'candidateCitizenships' => $candidateCitizenships,
                'candidateProfessions' => $candidateProfessions,
                'candidateSpecialties' => $candidateSpecialties,
                'candidateAllergies' => $candidateAllergies,
                'candidateLanguages' => $candidateLanguages,
                // 'candidateRecommendation' => $candidateRecommendation,
                'candidateNotices' => $candidateNotices,
                'candidateWorkExperience' => $candidateWorkExperience,
                'candidateDrivingLicense' => $candidateDrivingLicense,
                'candidateNumber' => $candidateNumber,
                'candidateCharacteristic' => $candidateCharacteristic
            ],
            'classificator' => [
                'gender' => $gender,
                'nationality' => $nationality,
                'religions' => $religions,
                'educations ' => $educations,
                'maritalStatus' => $maritalStatus,
                'citizenship' => $citizenship,
                'professions' => $professions,
                'specialties' => $specialties,
                'allergies' => $allergies,
                'languages' => $languages,
                'languageLevels' => $languageLevels,
                // 'recommendationFromWhom' => $recommendationFromWhom,
                'notices' => $notices,
                'workExperiences' => $workExperiences,
                'noExperienceReason' => $noExperienceReason,
                'drivingLicense' => $drivingLicense,
                'numberCode' => $numberCode,
                'characteristic' => $characteristic
                // 'noRecommendationReason' => $noRecommendationReason
            ]
         ];

        return view ('user/userProfile', compact('data'));
    }
}
