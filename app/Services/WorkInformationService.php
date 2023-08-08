<?php

namespace App\Services;

use App\Repositories\Candidate\WorkInformationRepository;
use App\Repositories\Candidate\FamilyWorkExperienceRepository;

class WorkInformationService
{
    protected WorkInformationRepository $workInformationRepository;
    protected FamilyWorkExperienceRepository $familyWorkExperienceRepository;
    public function __construct()
    {
        $this->workInformationRepository = new WorkInformationRepository;
        $this->familyWorkExperienceRepository = new FamilyWorkExperienceRepository;
    }

    function saveData($data) {
        if($data['type'] == 'work_information'){
            $result = $this->workInformationRepository->updateOrCreate($data['model']);
        }else if($data['type'] == 'family_work_information'){
            $result = $this->familyWorkExperienceRepository->updateOrCreate($data['model']);
        }

        return $result;
    }

//     public function translate($lang, $data)
//     {
//         if ($lang == 'ka') {

//             if ($data['getWorkInformation']['additional_schedule_ka']) {
//                 $data['getWorkInformation']['additional_schedule_en'] = GoogleTranslate::trans($data['getWorkInformation']['additional_schedule_ka'], 'en');
//                 $data['getWorkInformation']['additional_schedule_ru']  = GoogleTranslate::trans($data['getWorkInformation']['additional_schedule_ka'], 'ru');
//             }


//         }elseif ($lang == 'en') {
//             if ($data['getWorkInformation']['additional_schedule_en']) {
//                 $data['getWorkInformation']['additional_schedule_ka'] = GoogleTranslate::trans($data['getWorkInformation']['additional_schedule_en'], 'ka');
//                 $data['getWorkInformation']['additional_schedule_ru']  = GoogleTranslate::trans($data['getWorkInformation']['additional_schedule_en'], 'ru');
//             }





//         }elseif ($lang == 'ru') {
//             if ($data['getWorkInformation']['additional_schedule_ru']) {
//                 $data['getWorkInformation']['additional_schedule_ka'] = GoogleTranslate::trans($data['getWorkInformation']['additional_schedule_ru'], 'ka');
//                 $data['getWorkInformation']['additional_schedule_en']  = GoogleTranslate::trans($data['getWorkInformation']['additional_schedule_ru'], 'en');
//             }


//         }
//         return $data;
//     }


//     public function saveData($data)
//     {
//         // print_r($data);
//         // exit;
//         $lang = $data['lang'];

//         $trData = $this->translate($lang, $data);
//         $result = null;
//         $auth = Auth::user();
//         $user = User::where('id', $auth->id)->first();
//         $candidate_id = $user->candidate->id;
//         if (DB::table('work_information')->where('candidate_id', $candidate_id)->where('category_id', $data['getWorkInformation']['category_id']['id'])->exists()) {
//             return $result = ['message' => 'თქვენს მიერ მითითებულ კატეგორიაზე უკვე არსებობს ინფორმაცია'];
//         }
//         $result = $this->workInformationRepository->save($trData, $candidate_id);
//         return $result;
//     }
//     public function updateData($data)
//     {
//         $workInformation = WorkInformation::find($data['id']);
//         if ($workInformation->category_id == $data['category_id']){
//             $result = $this->workInformationRepository->update($workInformation,$data);
//             return $result;
//         }else {
//             $result = null;
//             if (DB::table('work_information')->where('candidate_id',$data['candidate_id'])->where('category_id', $data['category_id'])->exists()) {
//                 $result = ['message' => 'თქვენს მიერ მითითებულ კატეგორიაზე უკვე არსებობს ინფორმაცია'];
//             }else{
//                 $result = $this->workInformationRepository->updateRecommendation($workInformation, $data);
//             }
//             return $result;
//         }



//     }

//    public function translateRecommendation($lang, $data)
//     {
//         if ($lang == 'ka') {
//             foreach ($data as $key => $value) {
//                 if ($value['name_ka']) {
//                     $data[$key]['name_en'] = GoogleTranslate::trans($value['name_ka'], 'en');
//                     $data[$key]['name_ru']  = GoogleTranslate::trans($value['name_ka'], 'ru');
//                 }
//                 if ($value['position_ka']) {
//                     $data[$key]['position_en'] = GoogleTranslate::trans($value['position_ka'], 'en');
//                     $data[$key]['position_ru']  = GoogleTranslate::trans($value['position_ka'], 'ru');
//                 }
//                 if ($value['no_reason_info_ka']) {
//                     $data[$key]['no_reason_info_en'] = GoogleTranslate::trans($value['no_reason_info_ka'], 'en');
//                     $data[$key]['no_reason_info_ru']  = GoogleTranslate::trans($value['no_reason_info_ka'], 'ru');
//                 }
//             }


//         }elseif ($lang == 'en') {

//             foreach ($data as $key => $value) {
//                 if ($value['name_en']) {
//                     $data[$key]['name_ka'] = GoogleTranslate::trans($value['name_en'], 'ka');
//                     $data[$key]['name_ru']  = GoogleTranslate::trans($value['name_en'], 'ru');
//                 }
//                 if ($value['position_ka']) {
//                     $data[$key]['position_ka'] = GoogleTranslate::trans($value['position_en'], 'ka');
//                     $data[$key]['position_ru']  = GoogleTranslate::trans($value['position_en'], 'ru');
//                 }
//                 if ($value['no_reason_info_ka']) {
//                     $data[$key]['no_reason_info_ka'] = GoogleTranslate::trans($value['no_reason_info_en'], 'ka');
//                     $data[$key]['no_reason_info_ru']  = GoogleTranslate::trans($value['no_reason_info_en'], 'ru');
//                 }
//             }



//         }elseif ($lang == 'ru') {
//             foreach ($data as $key => $value) {
//                 if ($value['name_en']) {
//                     $data[$key]['name_ka'] = GoogleTranslate::trans($value['name_en'], 'ka');
//                     $data[$key]['name_en']  = GoogleTranslate::trans($value['name_en'], 'en');
//                 }
//                 if ($value['position_en']) {
//                     $data[$key]['position_ka'] = GoogleTranslate::trans($value['position_en'], 'ka');
//                     $data[$key]['position_en']  = GoogleTranslate::trans($value['position_en'], 'en');
//                 }
//                 if ($value['no_reason_info_en']) {
//                     $data[$key]['no_reason_info_ka'] = GoogleTranslate::trans($value['no_reason_info_en'], 'ka');
//                     $data[$key]['no_reason_info_en']  = GoogleTranslate::trans($value['no_reason_info_en'], 'en');
//                 }
//             }



//         }
//         return $data;
//     }
//     public function saveRecommendation($data)
//     {
//         // print_r($data['lang']);
//         // exit;
//         $lang = $data[0]['lang'];
//         $trData = $this->translateRecommendation($lang, $data);
//         if ($data[0]['has_recommendation']['id'] == 1) {
//             $result = $this->workInformationRepository->addRecommendation($trData);
//             return $result;
//         }else{
//             $result = $this->workInformationRepository->addNoRecommendation($data);
//             return $result;
//         }
//     }
//     public function saveRecommendationFile($data)
//     {
//         $result = $this->workInformationRepository->addRecommendationFile($data);
//         return $result;
//     }

//     public function updateRecommendation($data)
//     {
//         if ($data['recommendation'] == 1) {
//             $result = $this->workInformationRepository->updateRecommendation($data);
//             return $result;
//         }else{
//             $result = $this->workInformationRepository->updateNoRecommendation($data);
//             return $result;
//         }

//     }
//     public function updateRecommendationFile($data)
//     {
//         $result = $this->workInformationRepository->updateRecommendationFile($data);
//         return $result;
//     }

//     public function removeRecommendationFile($data)
//     {
//         $result = $this->workInformationRepository->removeRecommendationFile($data);
//         return $result;
//     }
//     public function trashRecommendation($data)
//     {
//         $result = $this->workInformationRepository->trashRecommendation($data);
//         return $result;
//     }
}
