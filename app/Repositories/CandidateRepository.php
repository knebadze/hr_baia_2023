<?php

namespace App\Repositories;

use stdClass;
use App\Models\User;
use App\Models\Candidate;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\CandidateNotice;
use App\Models\Additional_number;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\CandidateRecommendation;
use App\Models\General_work_experience;

class CandidateRepository
{
    public function __construct()
    {

    }

    function array_to_object($array) {
        $obj = new stdClass();

        foreach ($array as $k => $v) {
           if (strlen($k)) {
              if (is_array($v)) {
                 $obj->{$k} = $this->array_to_object($v); //RECURSION
              } else {
                 $obj->{$k} = $v;
              }
           }
        }

        return $obj;
     }



    public function save($data)
    {
        // print_r($data);
        // exit;
;
        // $objData = $this->array_to_object($data);
        $candidate = Candidate::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'personal_number' => $data['candidate']['personal_number'],
                'nationality_id' => $data['candidate']['nationality']['id'],
                'religion_id' => $data['candidate']['religion']['id'],
                'education_id' => $data['candidate']['education']['id'],
                'marital_status_id' => $data['candidate']['marital_status']['id'],
                'children' => $data['candidate']['children'],
                'children_age' => $data['candidate']['children_age'],
                'spouse' => $data['candidate']['spouse'],
                'fb_link' => $data['candidate']['fb_link'],
                'youtube_link' =>  $data['candidate']['youtube_link'],
                'map_link' =>  $data['candidate']['map_link'],
                'height' =>  $data['candidate']['height'],
                'weight' =>  $data['candidate']['weight'],
                'address_ka' =>  $data['candidate']['address_ka'],
                'address_en' =>  $data['candidate']['address_en'],
                'address_ru' =>  $data['candidate']['address_ru'],
                'street_ka' =>  $data['candidate']['street_ka'],
                'street_en' =>  $data['candidate']['street_en'],
                'street_ru' =>  $data['candidate']['street_ru'],
                'medical_info_ka' =>  $data['candidate']['medical_info_ka'],
                'medical_info_en' =>  $data['candidate']['medical_info_en'],
                'medical_info_ru' =>  $data['candidate']['medical_info_ru'],
                'convection' => ($data['candidate']['convection'] == null)?0:$data['candidate']['convection'],
                'smoke' =>  ($data['candidate']['smoke'] == null)?0:$data['candidate']['smoke'],
                'work_abroad' =>  ($data['candidate']['work_abroad'] == null)?0:$data['candidate']['work_abroad'],
                'latitude' => $data['candidate']['latitude'],
                'longitude' => $data['candidate']['longitude'],
            ]
        );
        $selectCitizenship = collect($data['candidateCitizenships'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item['id'];
            return $carry;
        }, []);
        $candidate->citizenship()->sync( $selectCitizenship );

        $selectProfession = collect($data['candidateProfessions'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item['id'];
            return $carry;
        }, []);
        $candidate->professions()->sync( $selectProfession );

        $selectSpecialty = collect($data['candidateSpecialties'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item['id'];
            return $carry;
        }, []);
        $candidate->specialty()->sync( $selectSpecialty );

        $selectCharacteristic = collect($data['candidateCharacteristic'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item['id'];
            return $carry;
        }, []);
        $candidate->characteristic()->sync( $selectCharacteristic );

        $selectAllergy = collect($data['candidateAllergies'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item['id'];
            return $carry;
        }, []);
        $candidate->allergy()->sync( $selectAllergy );


        $candidate->drivingLicense()->sync($data['candidateDrivingLicense']);



        $selectLanguage = collect($data['candidateLanguages'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[$item["language"]["id"]] = ["language_level_id" => $item["level"]["id"]];
            return $carry;
        }, []);


        $candidate->languages()->sync($selectLanguage);

        // print_r($data);
        //     exit;
        if (count($data['candidateWorkExperience'])) {

            if (DB::table('general_work_experiences')->where('candidate_id', $candidate->id)->exists()) {
                General_work_experience::where('candidate_id', $candidate->id)->delete();
            }
            if ($data['candidateWorkExperience'][0]["has_experience"]['id'] == 1) {

                $selectExperience = collect($data['candidateWorkExperience'])->reduce(function ($carry, $item) {
                    if($carry  == null) $carry = [];
                    $carry[$item["work_experience"]['id']] = ["experience" => $item["has_experience"]['id'], "position_ka" => $item["position_ka"], "position_en" => $item["position_en"], "position_ru" => $item["position_ru"],
                    "object_ka" => $item["object_ka"],"object_en" => $item["object_en"],"object_ru" => $item["object_ru"],];
                    return $carry;
                }, []);;
                $candidate->generalWorkExperience()->attach($selectExperience);
            }else{

                General_work_experience::updateOrCreate(
                    ['candidate_id' => $candidate->id],
                    [
                        'experience' => $data['candidateWorkExperience'][0]["has_experience"]['id'],
                        'no_reason_id' => $data['candidateWorkExperience'][0]['no_reason']['id'],
                        'no_reason_info_ka' => $data['candidateWorkExperience'][0]['no_reason_info_ka'],
                        'no_reason_info_en' => $data['candidateWorkExperience'][0]['no_reason_info_en'],
                        'no_reason_info_ru' => $data['candidateWorkExperience'][0]['no_reason_info_ru'],
                    ]
                );
            }


        }
        if (count($data['candidateNumber'])) {
            if (DB::table('additional_numbers')->where('candidate_id', $candidate->id)->exists()) {
                Additional_number::where('candidate_id', $candidate->id)->delete();
            }
            foreach ($data['candidateNumber'] as $key => $value) {
                // print_r($value);
                // exit;
                $additionalNumber = new Additional_number();
                $additionalNumber->candidate_id = $candidate->id;
                $additionalNumber->number_code_id = $value['number_code_id'];
                $additionalNumber->number = $value['number'];
                $additionalNumber->number_owner_id = $value['number_owner']['id'];
                $additionalNumber->save();
            }
        }
        $this->userStatusUpdate();

        return $candidate->id;
    }


    public function saveFile($data)
    {
        // print_r($data['candidate_id']);
        // exit;
        $upload_path = public_path('user-documentation/');
        $candidateNoticeDelete = CandidateNotice::where('candidate_id', $data['candidate_id'])->select('file')->get();
        foreach ($candidateNoticeDelete as $key => $value) {
            File::delete(public_path('user-documentation/'.$value->file));
        }
        CandidateNotice::where('candidate_id', $data['candidate_id'])->delete();

        foreach ($data  as $key => $value) {
            $test = Str::contains($key, 'file');
            if ($test == true) {
                $notice_id = substr($key, strlen($key)-1, 1);
                $file_name = $value->getClientOriginalName();
                $generated_new_name = time() . '.' .$file_name;
                $candidateNotice = new CandidateNotice();
                $candidateNotice->candidate_id = $data['candidate_id'];
                $candidateNotice->notice_id = $notice_id;



                $value->move($upload_path, $generated_new_name);
                $candidateNotice->file = $generated_new_name;
                $candidateNotice->save();
            }


        }
        if (CandidateNotice::where('candidate_id', $data['candidate_id'])->exists()) {
            $this->userStatusUpdate();
        }
        return $data;
    }
    public function removeOldWorkExperience($data)
    {
        CandidateNotice::where('candidate_id', $data)->delete();
        return $data;
    }

    public function userStatusUpdate()
    {
        $id = Auth::id();
        $user = User::find($id);
        if ($user->status == 0) {
            $user->update([
                'status' => 1,
                'updated_at' => now()
            ]);
        }
    }
}
