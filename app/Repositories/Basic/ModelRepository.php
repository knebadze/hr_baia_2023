<?php

namespace App\Repositories\Basic;
use App\Models\Allergy;
use App\Models\Employer;
use App\Models\Candidate;
use App\Models\Specialty;
use App\Models\Profession;
use App\Models\Citizenship;
use App\Models\CandidateNotice;
use App\Models\CandidateAllergy;
use App\Models\Additional_number;
use App\Models\CandidateLanguage;
use App\Models\Candidate_specialty;
use App\Models\Candidate_profession;
use App\Models\Candidate_citizenship;
use App\Models\GeneralCharacteristic;
use Illuminate\Support\Facades\Schema;
use App\Models\CandidateCharacteristic;
use App\Models\CandidateDrivingLicense;
use App\Models\General_work_experience;

class ModelRepository
{
    public function candidate($auth_id)
    {
        if (Candidate::where('user_id', $auth_id)->exists()) {
            $candidate = Candidate::where('user_id', $auth_id)->with(['nationality','religion', 'education', 'maritalStatus'])->first();
        } else {
            $candidate =  Schema::getColumnListing('candidates');
            $candidate = array_map(function ($item) { return ""; }, array_flip($candidate));
        }

        if (Candidate::where('user_id', $auth_id)->exists() && CandidateLanguage::where('candidate_id', $candidate->id)->exists()) {
            $candidateLanguages = CandidateLanguage::where('candidate_id', $candidate->id)->with('language')->with('level')->get();
        }else{
            $candidateLanguages = [];
        }

        if (Candidate::where('user_id', $auth_id)->exists() && CandidateAllergy::where('candidate_id', $candidate->id)->exists()) {
            $candidateAllergy = CandidateAllergy::where('candidate_id', $candidate->id)->select('allergy_id')->get();
            foreach ($candidateAllergy as $key => $value) {
                $ids[] = $value['allergy_id'];
            }
            $candidateAllergies = Allergy::whereIn('id', $ids)->get()->toArray();
        }else{
            $candidateAllergies = [];
        }

        if (Candidate::where('user_id', $auth_id)->exists() && Candidate_citizenship::where('candidate_id', $candidate->id)->exists()) {
            $candidateCitizenship = Candidate_citizenship::where('candidate_id', $candidate->id)->select('citizenship_id')->get()->toArray();
            foreach ($candidateCitizenship as $key => $value) {
                $ids[] = $value['citizenship_id'];
            }
            $candidateCitizenships = Citizenship::whereIn('id', $ids)->get()->toArray();
        }else{
            $candidateCitizenships = [];
        }

        if (Candidate::where('user_id', $auth_id)->exists() && Candidate_profession::where('candidate_id', $candidate->id)->exists()) {
            $candidateProfession = Candidate_profession::where('candidate_id', $candidate->id)->select('profession_id')->get();
            foreach ($candidateProfession as $key => $value) {
                $ids[] = $value['profession_id'];
            }
            $candidateProfessions = Profession::whereIn('id', $ids)->get()->toArray();
        }else{
            $candidateProfessions = [];
        }

        if (Candidate::where('user_id', $auth_id)->exists() && Candidate_specialty::where('candidate_id', $candidate->id)->exists()) {
            $candidateSpecialty = Candidate_specialty::where('candidate_id', $candidate->id)->select('specialty_id')->get();
            foreach ($candidateSpecialty as $key => $value) {
                $ids[] = $value['specialty_id'];
            }
            $candidateSpecialties = Specialty::whereIn('id', $ids)->get()->toArray();
        }else{
            $candidateSpecialties = [];
        }

        if (Candidate::where('user_id', $auth_id)->exists() && CandidateCharacteristic::where('candidate_id', $candidate->id)->exists()) {
            $candidateCharacteristics = CandidateCharacteristic::where('candidate_id', $candidate->id)->select('general_characteristic_id')->get();
            foreach ($candidateCharacteristics as $key => $value) {
                $ids[] = $value['general_characteristic_id'];
            }
            $candidateCharacteristic = GeneralCharacteristic::whereIn('id', $ids)->get()->toArray();
        }else{
            $candidateCharacteristic = [];
        }

        if (Candidate::where('user_id', $auth_id)->exists() && General_work_experience::where('candidate_id', $candidate->id)->exists()) {
            $candidateWorkExperience = General_work_experience::where('candidate_id', $candidate->id)->with(['workExperience', 'noReason', 'hasExperience'])->get()->toArray();
        }else{
            $candidateWorkExperience = [];
        }

        if (Candidate::where('user_id', $auth_id)->exists() && CandidateNotice::where('candidate_id', $candidate->id)->exists()) {
            $candidateNotices = CandidateNotice::where('candidate_id', $candidate->id)->with('notice')->get();
        }else{
            $candidateNotices = [];
        }
        if (Candidate::where('user_id', $auth_id)->exists() && CandidateDrivingLicense::where('candidate_id', $candidate->id)->exists()) {
            $candidateDrivingLicense = CandidateDrivingLicense::where('candidate_id', $candidate->id)->select('driving_license_id')->get()->toArray();
        }else{
            $candidateDrivingLicense = [];
        }
        if (Candidate::where('user_id', $auth_id)->exists() && Additional_number::where('candidate_id', $candidate->id)->exists()) {
            $candidateNumber = Additional_number::where('candidate_id', $candidate->id)->with(['numberCode', 'numberOwner'])->get()->toArray();
        }else{
            $candidateNumber = [];
        }

        $data = [
            'candidate' => $candidate,

            'candidateCitizenships' => $candidateCitizenships,
            'candidateProfessions' => $candidateProfessions,
            'candidateSpecialties' => $candidateSpecialties,
            'candidateAllergies' => $candidateAllergies,
            'candidateLanguages' => $candidateLanguages,
            'candidateNotices' => $candidateNotices,
            'candidateWorkExperience' => $candidateWorkExperience,
            'candidateDrivingLicense' => $candidateDrivingLicense,
            'candidateNumber' => $candidateNumber,
            'candidateCharacteristic' => $candidateCharacteristic,
        ];
        return $data;
    }

    public function employer($auth_id)
    {
        if (Employer::where('user_id', $auth_id)->exists()) {
            $employer = Employer::where('user_id', $auth_id)->first();
        } else {
            $employer =  Schema::getColumnListing('employers');
            $employer = array_map(function ($item) { return ""; }, array_flip($employer));
        }

        $data = [ 'employer' => $employer];
        return $data;
    }
}
