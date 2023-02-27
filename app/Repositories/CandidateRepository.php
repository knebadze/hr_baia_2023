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
;
        $objData = $this->array_to_object($data);
        $candidate = Candidate::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'personal_number' => $objData->candidate->personal_number,
                'nationality_id' => $objData->candidate->nationality_id,
                'religion_id' => $objData->candidate->religion_id,
                'education_id' => $objData->candidate->education_id,
                'marital_status_id' => $objData->candidate->marital_status_id,
                'children' => $objData->candidate->children,
                'children_age' => $objData->candidate->children_age,
                'spouse' => $objData->candidate->spouse,
                'fb_link' => $objData->candidate->fb_link,
                'youtube_link' =>  $objData->candidate->youtube_link,
                'map_link' =>  $objData->candidate->map_link,
                'height' =>  $objData->candidate->height,
                'weight' =>  $objData->candidate->weight,
                'address' =>  $objData->candidate->address,
                'street' =>  $objData->candidate->street,
                'medical_info' =>  $objData->candidate->medical_info,
                'convection' => ($objData->candidate->convection == null)?0:$objData->candidate->convection,
                'smoke' =>  ($objData->candidate->smoke == null)?0:$objData->candidate->smoke,
                'work_abroad' =>  ($objData->candidate->work_abroad == null)?0:$objData->candidate->work_abroad,
            ]
        );
        $candidate->citizenship()->sync( $objData->candidateCitizenships );
        $candidate->professions()->sync($objData->candidateProfessions);
        $candidate->specialty()->sync($objData->candidateSpecialties);
        $candidate->characteristic()->sync($objData->candidateCharacteristic);
        $candidate->allergy()->sync($objData->candidateAllergies);
        $candidate->drivingLicense()->sync($objData->candidateDrivingLicense);



        $selectLanguage = collect($data['candidateLanguages'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[$item["language"]["id"]] = ["language_level_id" => $item["level"]["id"]];
            return $carry;
        }, []);


        $candidate->languages()->sync($selectLanguage);

        if (count($data['candidateWorkExperience'])) {
            General_work_experience::where('candidate_id', $candidate->id)->delete();
            $selectExperience = collect($data['candidateWorkExperience'])->reduce(function ($carry, $item) {
                if($carry  == null) $carry = [];
                $carry[$item["work_experience_id"]] = ["experience" => $item["experience"], "position" => $item["position"], "object" => $item["object"]];
                return $carry;
            }, []);;
            $candidate->generalWorkExperience()->attach($selectExperience);
        }else{
            General_work_experience::updateOrCreate(
                ['candidate_id' => $candidate->id],
                [
                    'experience' => $objData->candidateWorkExperienceModel->experience,
                    'no_reason_id' => $objData->candidateWorkExperienceModel->no_reason_id,
                    'no_reason_info' => $objData->candidateWorkExperienceModel->no_reason_info,
                ]
            );
        }
        if (count($data['candidateNumber'])) {
            if (DB::table('additional_numbers')->where('candidate_id', $candidate->id)->exists()) {
                Additional_number::where('candidate_id', $candidate->id)->delete();
            }
            foreach ($data['candidateNumber'] as $key => $value) {

                $additionalNumber = new Additional_number();
                $additionalNumber->candidate_id = $candidate->id;
                $additionalNumber->number_code_id = $value['number_code_id'];
                $additionalNumber->number = $value['number'];
                $additionalNumber->owner = $value['owner'];
                $additionalNumber->save();
            }
        }


        return $candidate->id;
    }


    public function saveFile($data)
    {
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
                $generated_new_name = time() . '.' . $file_name;
                $candidateNotice = new CandidateNotice();
                $candidateNotice->candidate_id = $data['candidate_id'];
                $candidateNotice->notice_id = $notice_id;



                $value->move($upload_path, $generated_new_name);
                $candidateNotice->file = $generated_new_name ;
                $candidateNotice->save();
            }


        }
        if (CandidateNotice::where('candidate_id', $data['candidate_id'])->exists()) {
            $id = Auth::id();
            $user = User::find($id);
            if ($user->user_type_id == 1) {

                $user->update([
                    'is_active' => 2,
                    'updated_at' => now()
                ]);
            }
        }
        return $data;
    }
}
