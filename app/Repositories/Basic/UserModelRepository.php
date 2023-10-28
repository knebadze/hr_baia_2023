<?php

namespace App\Repositories\Basic;
use App\Models\role;
use App\Models\User;
use App\Models\Candidate;
use App\Models\CandidateNotice;
use App\Models\userRegisterLog;
use App\Models\WorkInformation;
use App\Models\Additional_number;
use App\Models\CandidateLanguage;
use App\Models\FamilyWorkExperience;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Models\CandidateRecommendation;
use App\Models\General_work_experience;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class UserModelRepository
{
    // public function candidate($auth_id)
    // {
    //     if (Candidate::where('user_id', $auth_id)->exists()) {
    //         $candidate = Candidate::where('user_id', $auth_id)->with(
    //             [
    //                 'nationality',
    //                 'religion',
    //                 'education',
    //                 'maritalStatus',
    //                 'citizenship',
    //                 'professions',
    //                 'specialty',
    //                 'characteristic',
    //                 'drivingLicense',
    //                 'allergy',
    //                 'getLanguage.language',
    //                 'getLanguage.level',
    //             ]
    //             )->first();
    //     } else {
    //         // Get the column names from the "candidates" table
    //         $candidateColumns = Schema::getColumnListing('candidates');

    //         // Define an array with keys that need specific values
    //         $defaultValues = [
    //             'allergy' => '',
    //             'nationality' => '',
    //             'religion' => '',
    //             'education' => '',
    //             'marital_status' => '',
    //             'citizenship' => '',
    //             'professions' => '',
    //             'specialty' => '',
    //             'characteristic' => '',
    //             'driving_license' => '',
    //             'get_language' => [],
    //         ];

    //         // Initialize the candidate array with default values
    //         $candidate = array_fill_keys($candidateColumns, '');
    //         $candidate = array_merge($candidate, $defaultValues);
    //     }

    //     if (Auth::user()->role_id != 3) {

    //         if (userRegisterLog::where('creator_id', Auth::id())->exists()) {
    //             $last = userRegisterLog::orderBy('id', 'DESC')->where('creator_id', Auth::id())->first();

    //             if (Candidate::where('user_id', $last->user_id)->exists()) {
    //                 $user = Schema::getColumnListing('users');
    //                 $user = array_map(function ($item) { return ""; }, array_flip($user));
    //                 $user['gender'] = '';
    //             }else{
    //                 $user = User::where('id', $last->user_id)->with('gender')->first()->toArray();
    //                 // dd($last);
    //             }

    //         } else {
    //             $user = Schema::getColumnListing('users');
    //             $user = array_map(function ($item) { return ""; }, array_flip($user));
    //             $user['gender'] = '';
    //         }

    //     }else{
    //         $user = Schema::getColumnListing('users');
    //         $user = array_map(function ($item) { return ""; }, array_flip($user));
    //         $user['gender'] = '';
    //     }


    //     if (Candidate::where('user_id', $auth_id)->exists() && General_work_experience::where('candidate_id', $candidate->id)->exists()) {
    //         $candidateWorkExperience = General_work_experience::where('candidate_id', $candidate->id)->with(['workExperience', 'noReason', 'hasExperience'])->get()->toArray();
    //     }else{
    //         $candidateWorkExperience = [];
    //     }

    //     if (Candidate::where('user_id', $auth_id)->exists() && CandidateNotice::where('candidate_id', $candidate->id)->exists()) {
    //         $candidateNotices = CandidateNotice::where('candidate_id', $candidate->id)->with('notice')->get();
    //     }else{
    //         $candidateNotices = [];
    //     }

    //     if (Candidate::where('user_id', $auth_id)->exists() && Additional_number::where('candidate_id', $candidate->id)->exists()) {
    //         $candidateNumber = Additional_number::where('candidate_id', $candidate->id)->with(['numberCode', 'numberOwner'])->get()->toArray();
    //     }else{
    //         $candidateNumber = [];
    //     }

    //     $data = [
    //         'candidate' => $candidate,
    //         'user' => $user,
    //         'candidateNotices' => $candidateNotices,
    //         'candidateWorkExperience' => $candidateWorkExperience,
    //         'candidateNumber' => $candidateNumber,
    //     ];
    //     return $data;
    // }



    public function candidate($auth_id)
    {
        $cacheKey = 'candidate_model';
        $cacheDuration = Carbon::now()->addHours(6);

        // Attempt to retrieve the data from the cache
        $data = Cache::remember($cacheKey, $cacheDuration, function () use ($auth_id, $cacheDuration) {
            // Fetch the candidate data
            $candidate = Candidate::where('user_id', $auth_id)->with([
                'nationality',
                'religion',
                'education',
                'maritalStatus',
                'citizenship',
                'professions',
                'specialty',
                'characteristic',
                'drivingLicense',
                'allergy',
                'getLanguage.language',
                'getLanguage.level',
            ])->first();

            // If candidate data doesn't exist, initialize with default values
            if (!$candidate) {
                $candidateColumns = Schema::getColumnListing('candidates');
                $defaultValues = [
                    'allergy' => '',
                    'nationality' => '',
                    'religion' => '',
                    'education' => '',
                    'marital_status' => '',
                    'citizenship' => '',
                    'professions' => '',
                    'specialty' => '',
                    'characteristic' => '',
                    'driving_license' => '',
                    'get_language' => [],
                ];
                $candidate = array_merge(array_fill_keys($candidateColumns, ''), $defaultValues);
            }
            dd($cacheDuration);
            // Fetch user data and handle the caching
            $user = Cache::remember('user_data_' . $auth_id, $cacheDuration, function () use ($auth_id) {
                if (Auth::user()->role_id != 3) {
                    $last = userRegisterLog::where('creator_id', Auth::id())->orderBy('id', 'DESC')->first();
                    if ($last && !Candidate::where('user_id', $last->user_id)->exists()) {
                        return User::where('id', $last->user_id)->with('gender')->first()->toArray();
                    }
                }
                // If no user data found, initialize with default values
                $userColumns = Schema::getColumnListing('users');
                return array_merge(array_fill_keys($userColumns, ''), ['gender' => '']);
            });

            $candidateWorkExperience = [];
            if ($candidate && General_work_experience::where('candidate_id', $candidate->id)->exists()) {
                $candidateWorkExperience = General_work_experience::where('candidate_id', $candidate->id)
                    ->with(['workExperience', 'noReason', 'hasExperience'])
                    ->get()
                    ->toArray();
            }

            $candidateNotices = [];
            if ($candidate && CandidateNotice::where('candidate_id', $candidate->id)->exists()) {
                $candidateNotices = CandidateNotice::where('candidate_id', $candidate->id)->with('notice')->get();
            }

            $candidateNumber = [];
            if ($candidate && Additional_number::where('candidate_id', $candidate->id)->exists()) {
                $candidateNumber = Additional_number::where('candidate_id', $candidate->id)
                    ->with(['numberCode', 'numberOwner'])
                    ->get()
                    ->toArray();
            }

            return [
                'candidate' => $candidate,
                'user' => $user,
                'candidateNotices' => $candidateNotices,
                'candidateWorkExperience' => $candidateWorkExperience,
                'candidateNumber' => $candidateNumber,
            ];
        });

        dd($data);
        return $data;
    }


    public function fullData($auth_id)
    {
        $cacheKey = 'full_data_' . $auth_id;
        $cacheDuration = Carbon::now()->addHours(6);

        // Attempt to retrieve the data from the cache
        $data = Cache::remember($cacheKey, $cacheDuration, function () use ($auth_id, $cacheDuration) {
            // Fetch candidate data
            $candidate = Candidate::where('user_id', $auth_id)->with([
                'nationality',
                'religion',
                'education',
                'maritalStatus',
                'citizenship',
                'professions',
                'specialty',
                'characteristic',
                'drivingLicense',
                'allergy',
                'getLanguage.language',
                'getLanguage.level',
            ])->first();

            if (!$candidate) {
                // If candidate data doesn't exist, initialize with default values
                $candidateColumns = Schema::getColumnListing('candidates');
                $defaultValues = [
                    'allergy' => '',
                    'nationality' => '',
                    'religion' => '',
                    'education' => '',
                    'marital_status' => '',
                    'citizenship' => '',
                    'professions' => '',
                    'specialty' => '',
                    'characteristic' => '',
                    'driving_license' => '',
                    'get_language' => [],
                ];
                $candidate = array_merge(array_fill_keys($candidateColumns, ''), $defaultValues);
            }
            // dd($cacheDuration);
            // Fetch user data and handle the caching
            $user = Cache::remember('user_data_' . $auth_id, $cacheDuration, function () use ($auth_id) {
                if (Auth::user()->role_id != 3) {
                    $last = userRegisterLog::where('creator_id', Auth::id())->orderBy('id', 'DESC')->first();
                    if ($last && !Candidate::where('user_id', $last->user_id)->exists()) {
                        return User::where('id', $last->user_id)->with('gender')->first()->toArray();
                    }
                }

                // If no user data found, initialize with default values
                $userColumns = Schema::getColumnListing('users');
                return array_merge(array_fill_keys($userColumns, ''), ['gender' => '']);
            });

            $hasCandidate = Candidate::where('user_id', $auth_id)->exists();
            // Fetch additional data and handle the caching
            $candidateWorkExperience = $this->fetchCandidateWorkExperience($auth_id, $hasCandidate, $candidate);
            $candidateNotices = $this->fetchCandidateNotices($auth_id, $hasCandidate, $candidate);
            $candidateNumber = $this->fetchCandidateNumber($auth_id, $hasCandidate, $candidate);

            $workInformation = $this->fetchWorkInformation($auth_id);
            $getWorkInformation = $workInformation['getWorkInformation'];
            $workInformation = $workInformation['workInformation'];

            $candidateRecommendation = $this->fetchCandidateRecommendation($auth_id, $hasCandidate, $candidate);

            $familyWorkExperience = $this->fetchFamilyWorkExperience($auth_id, $user->candidate);

            // Combine all data
            $data = [
                'candidate' => $candidate,
                'user' => $user,
                'candidateNotices' => $candidateNotices,
                'candidateWorkExperience' => $candidateWorkExperience,
                'candidateNumber' => $candidateNumber,
            ];

            $dataWork = [
                'workInformation' => $workInformation,
                'getWorkInformation' => $getWorkInformation,
                'candidateRecommendation' => $candidateRecommendation,
                'familyWorkExperience' => $familyWorkExperience,
            ];

            return array_merge($data, $dataWork);
        });
        return $data;
    }

    private function fetchCandidateWorkExperience($auth_id, $hasCandidate, $candidate)
    {
        // dd($hasCandidate);
        $candidateWorkExperience = [];
        if ($hasCandidate && $candidate && General_work_experience::where('candidate_id', $candidate->id)->exists()) {
            $candidateWorkExperience = General_work_experience::where('candidate_id', $candidate->id)
                ->with(['workExperience', 'noReason', 'hasExperience'])
                ->get()
                ->toArray();
        }
        return $candidateWorkExperience;
    }

    private function fetchCandidateNotices($auth_id, $hasCandidate, $candidate)
    {
        $candidateNotices = [];
        if ($hasCandidate && $candidate && CandidateNotice::where('candidate_id', $candidate->id)->exists()) {
            $candidateNotices = CandidateNotice::where('candidate_id', $candidate->id)->with('notice')->get();
        }
        return $candidateNotices;
    }

    private function fetchCandidateNumber($auth_id, $hasCandidate,  $candidate)
    {
        $candidateNumber = [];
        if ($hasCandidate && $candidate && Additional_number::where('candidate_id', $candidate->id)->exists()) {
            $candidateNumber = Additional_number::where('candidate_id', $candidate->id)
                ->with(['numberCode', 'numberOwner'])
                ->get()
                ->toArray();
        }
        return $candidateNumber;
    }

    private function fetchWorkInformation($auth_id)
    {
        $workInformation = [];
        $getWorkInformation = [];

        if (Auth::user()->role_id == 3 && Candidate::where('user_id', Auth::id())->exists() && WorkInformation::where('candidate_id', $auth_id)->exists()) {
            $getWorkInformation = WorkInformation::where('candidate_id', $auth_id)
                ->with(['category', 'workSchedule', 'currency'])
                ->get()
                ->toArray();

            // Initialize work information with default values
            $workInformationColumns = Schema::getColumnListing('work_information');
            $workInformation = array_merge(array_fill_keys($workInformationColumns, ''), [
                'category' => '',
                'currency' => '',
                'work_schedule' => '',
            ]);
        }

        return ['getWorkInformation' => $getWorkInformation, 'workInformation' => $workInformation];
    }

      
    private function fetchCandidateRecommendation($auth_id, $hasCandidate, $candidate)
    {
        $candidateRecommendation = [];
        if (Auth::user()->role_id == 3 && Candidate::where('user_id', Auth::id())->exists() && WorkInformation::where('candidate_id', $auth_id)->exists() && CandidateRecommendation::where('candidate_id', $candidate->id)->exists()) {
            $candidateRecommendation = CandidateRecommendation::where('candidate_id', $candidate->id)
                ->with(['recommendationWhom', 'numberCode', 'noReason', 'hasRecommendation'])
                ->get();
        }
        return $candidateRecommendation;
    }

    private function fetchFamilyWorkExperience($auth_id, $candidate)
    {
        $familyWorkExperience = [];
        if (Auth::user()->role_id == 3 && Candidate::where('user_id', $auth_id)->exists() && FamilyWorkExperience::where('candidate_id', $candidate->id)->exists()) {
            $familyWorkExperience = FamilyWorkExperience::where('candidate_id', $candidate->id)
                ->with(['workExperience', 'longest', 'noReason', 'hasExperience', 'familyWorkDuty', 'familyWorkCategory'])
                ->first()
                ->toArray();
        }
        return $familyWorkExperience;
    }

    // function fullData($auth_id) {
    //     if (Candidate::where('user_id', $auth_id)->exists()) {
    //         $candidate = Candidate::where('user_id', $auth_id)->with(
    //             [
    //                 'nationality',
    //                 'religion',
    //                 'education',
    //                 'maritalStatus',
    //                 'citizenship',
    //                 'professions',
    //                 'specialty',
    //                 'characteristic',
    //                 'drivingLicense',
    //                 'allergy',
    //                 'getLanguage.language',
    //                 'getLanguage.level',
    //             ]
    //             )->first();
    //     } else {
    //         $candidate =  Schema::getColumnListing('candidates');
    //         $candidate = array_map(function ($item) { return ""; }, array_flip($candidate));
    //         $candidate['allergy'] = '';
    //         $candidate['nationality'] = '';
    //         $candidate['religion'] = '';
    //         $candidate['education'] = '';
    //         $candidate['marital_status'] = '';
    //         $candidate['citizenship'] = '';
    //         $candidate['professions'] = '';
    //         $candidate['specialty'] = '';
    //         $candidate['characteristic'] = '';
    //         $candidate['driving_license'] = '';
    //         $candidate['get_language'] = array();
    //     }

    //     if (Auth::user()->role_id != 3) {

    //         if (userRegisterLog::where('creator_id', Auth::id())->exists()) {
    //             $last = userRegisterLog::orderBy('id', 'DESC')->where('creator_id', Auth::id())->first();

    //             if (Candidate::where('user_id', $last->user_id)->exists()) {
    //                 $user = Schema::getColumnListing('users');
    //                 $user = array_map(function ($item) { return ""; }, array_flip($user));
    //                 $user['gender'] = '';
    //             }else{
    //                 $user = User::where('id', $last->user_id)->with('gender')->first()->toArray();
    //                 // dd($last);
    //             }

    //         } else {
    //             $user = Schema::getColumnListing('users');
    //             $user = array_map(function ($item) { return ""; }, array_flip($user));
    //             $user['gender'] = '';
    //         }

    //     }else{
    //         $user = Schema::getColumnListing('users');
    //         $user = array_map(function ($item) { return ""; }, array_flip($user));
    //         $user['gender'] = '';
    //     }


    //     if (Candidate::where('user_id', $auth_id)->exists() && General_work_experience::where('candidate_id', $candidate->id)->exists()) {
    //         $candidateWorkExperience = General_work_experience::where('candidate_id', $candidate->id)->with(['workExperience', 'noReason', 'hasExperience'])->get()->toArray();
    //     }else{
    //         $candidateWorkExperience = [];
    //     }

    //     if (Candidate::where('user_id', $auth_id)->exists() && CandidateNotice::where('candidate_id', $candidate->id)->exists()) {
    //         $candidateNotices = CandidateNotice::where('candidate_id', $candidate->id)->with('notice')->get();
    //     }else{
    //         $candidateNotices = [];
    //     }

    //     if (Candidate::where('user_id', $auth_id)->exists() && Additional_number::where('candidate_id', $candidate->id)->exists()) {
    //         $candidateNumber = Additional_number::where('candidate_id', $candidate->id)->with(['numberCode', 'numberOwner'])->get()->toArray();
    //     }else{
    //         $candidateNumber = [];
    //     }
    //     $data = [
    //         'candidate' => $candidate,
    //         'user' => $user,
    //         'candidateNotices' => $candidateNotices,
    //         'candidateWorkExperience' => $candidateWorkExperience,
    //         'candidateNumber' => $candidateNumber,
    //     ];

    //     $user = User::where('id', $auth_id)->first();

    //     if (Auth::user()->role_id == 3 && Candidate::where('user_id', Auth::id())->exists() && WorkInformation::where('candidate_id', $user->candidate->id)->exists()) {
    //         $getWorkInformation = WorkInformation::where('candidate_id', $user->candidate->id)->with(['category', 'workSchedule','currency'])->get()->toArray();
    //         $workInformation =  Schema::getColumnListing('work_information');
    //         $workInformation = array_map(function ($item) { return ""; }, array_flip($workInformation));
    //         $workInformation['category'] = '';
    //         $workInformation['currency'] = '';
    //         $workInformation['work_schedule'] = '';
    //     }else{
    //         $getWorkInformation = [];
    //         $workInformation =  Schema::getColumnListing('work_information');
    //         $workInformation = array_map(function ($item) { return ""; }, array_flip($workInformation));
    //         $workInformation['category'] = '';
    //         $workInformation['currency'] = '';
    //         $workInformation['work_schedule'] = '';
    //     }

    //     if (Auth::user()->role_id == 3 && Candidate::where('user_id', Auth::id())->exists() && WorkInformation::where('candidate_id', $user->candidate->id)->exists() && CandidateRecommendation::where('candidate_id', $user->candidate->id)->exists()) {
    //         $candidateRecommendation = CandidateRecommendation::where('candidate_id', $user->candidate->id)->with(['recommendationWhom', 'numberCode', 'noReason', 'hasRecommendation'])->get();
    //         $recommendation = Schema::getColumnListing('candidate_recommendations');
    //         $recommendation = array_map(function ($item) {  return ""; }, array_flip($recommendation));
    //         $recommendation['recommendation_whom'] = '';
    //         $recommendation['number_code'] = '';
    //         $recommendation['no_reason'] = '';
    //         $recommendation['has_recommendation'] = '';
    //     }else{
    //         $candidateRecommendation = [];
    //         $recommendation = Schema::getColumnListing('candidate_recommendations');
    //         $recommendation = array_map(function ($item) {  return ""; }, array_flip($recommendation));
    //         $recommendation['recommendation_whom'] = '';
    //         $recommendation['number_code'] = '';
    //         $recommendation['no_reason'] = '';
    //         $recommendation['has_recommendation'] = '';
    //     }


    //     if (Auth::user()->role_id == 3 && Candidate::where('user_id', $auth_id)->exists() && FamilyWorkExperience::where('candidate_id', $user->candidate->id)->exists()) {
    //         $familyWorkExperience = FamilyWorkExperience::where('candidate_id', $user->candidate->id)->with(['workExperience', 'longest', 'noReason', 'hasExperience', 'familyWorkDuty', 'familyWorkCategory'])->first()->toArray();
    //     }else{
    //         $familyWorkExperience = Schema::getColumnListing('family_work_experiences');
    //         $familyWorkExperience = array_map(function ($item) {  return ""; }, array_flip($familyWorkExperience));
    //         $familyWorkExperience['work_experience'] = '';
    //         $familyWorkExperience['longest'] = '';
    //         $familyWorkExperience['no_reason'] = '';
    //         $familyWorkExperience['has_experience'] = '';
    //         $familyWorkExperience['family_work_duty'] = '';
    //         $familyWorkExperience['family_work_category'] = '';
    //     }

    //     $dataWork = [
    //         'workInformation' => $workInformation,
    //         'getWorkInformation' => $getWorkInformation,
    //         'candidateRecommendation' => $candidateRecommendation,
    //         'recommendation' => $recommendation,
    //         'familyWorkExperience' => $familyWorkExperience,
    //     ];
    //     $data = array_merge($data, $dataWork);
    //     return $data;
    // }
}
