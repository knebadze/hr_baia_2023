<?php

namespace App\Services;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\CandidateRepository;
use Illuminate\Support\Facades\Validator;
use Stichoza\GoogleTranslate\GoogleTranslate;


class CandidateService
{
    protected $candidateRepository;

    public function __construct(CandidateRepository $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
    }

    public function translate($lang, $data)
    {
        if ($lang == 'ka') {
            $data['candidate']['address_en'] = GoogleTranslate::trans($data['candidate']['address_ka'], 'en');
            $data['candidate']['address_ru']  = GoogleTranslate::trans($data['candidate']['address_ka'], 'ru');

            if ($data['candidate']['street_ka']) {
                $data['candidate']['street_en'] = GoogleTranslate::trans($data['candidate']['street_ka'], 'en');
                $data['candidate']['street_ru']  = GoogleTranslate::trans($data['candidate']['street_ka'], 'ru');
            }
            if ($data['candidate']['medical_info_ka']) {
                $data['candidate']['medical_info_en'] = GoogleTranslate::trans($data['candidate']['medical_info_ka'], 'en');
                $data['candidate']['medical_info_ru']  = GoogleTranslate::trans($data['candidate']['medical_info_ka'], 'ru');
            }
            if (count($data['candidateWorkExperience']) > 0 ) {
                foreach ($data['candidateWorkExperience'] as $key => $value) {

                    if ($value['position_ka']) {
                        $data['candidateWorkExperience'][$key]['position_en'] = GoogleTranslate::trans($value['position_ka'], 'en');
                        $data['candidateWorkExperience'][$key]['position_ru']  = GoogleTranslate::trans($value['position_ka'], 'ru');
                    }
                    if ($value['object_ka']) {
                        $data['candidateWorkExperience'][$key]['object_en'] = GoogleTranslate::trans($value['object_ka'], 'en');
                        $data['candidateWorkExperience'][$key]['object_ru']  = GoogleTranslate::trans($value['object_ka'], 'ru');
                    }
                    if ($value['no_reason_info_ka']) {
                        $data['candidateWorkExperience'][$key]['no_reason_info_en'] = GoogleTranslate::trans($value['no_reason_info_ka'], 'en');
                        $data['candidateWorkExperience'][$key]['no_reason_info_ru']  = GoogleTranslate::trans($value['no_reason_info_ka'], 'ru');
                    }
                }
            }



        }elseif ($lang == 'en') {
            $data['candidate']['address_ka'] = GoogleTranslate::trans($data['candidate']['address_en'], 'ka');
            $data['candidate']['address_ru']  = GoogleTranslate::trans($data['candidate']['address_en'], 'ru');


            if ($data['candidate']['street_en']) {
                $data['candidate']['street_ka'] = GoogleTranslate::trans($data['candidate']['street_en'], 'ka');
                $data['candidate']['street_ru']  = GoogleTranslate::trans($data['candidate']['street_en'], 'ru');
            }

            if ($data['candidate']['medical_info_en']) {
                $data['candidate']['medical_info_ka'] = GoogleTranslate::trans($data['candidate']['medical_info_en'], 'ka');
                $data['candidate']['medical_info_ru']  = GoogleTranslate::trans($data['candidate']['medical_info_en'], 'ru');
            }
            if (count($data['candidateWorkExperience']) > 0 ) {
                foreach ($data['candidateWorkExperience'] as $key => $value) {
                    if ($value['position_en']) {
                        $data['candidateWorkExperience'][$key]['position_ka'] = GoogleTranslate::trans($value['position_en'], 'ka');
                        $data['candidateWorkExperience'][$key]['position_ru']  = GoogleTranslate::trans($value['position_en'], 'ru');
                    }
                    if ($value['object_en']) {
                        $data['candidateWorkExperience'][$key]['object_ka'] = GoogleTranslate::trans($value['object_en'], 'ka');
                        $data['candidateWorkExperience'][$key]['object_ru']  = GoogleTranslate::trans($value['object_en'], 'ru');
                    }
                    if ($value['no_reason_info_en']) {
                        $data['candidateWorkExperience'][$key]['no_reason_info_ka'] = GoogleTranslate::trans($value['no_reason_info_en'], 'ka');
                        $data['candidateWorkExperience'][$key]['no_reason_info_ru']  = GoogleTranslate::trans($value['no_reason_info_en'], 'ru');
                    }
                }

            }



        }elseif ($lang == 'ru') {
            $data['candidate']['address_ka'] = GoogleTranslate::trans($data['candidate']['address_ru'], 'ka');
            $data['candidate']['address_en']  = GoogleTranslate::trans($data['candidate']['address_ru'], 'en');


            if ($data['candidate']['street_ru']) {
                $data['candidate']['street_ka'] = GoogleTranslate::trans($data['candidate']['street_ru'], 'ka');
                $data['candidate']['street_en']  = GoogleTranslate::trans($data['vacancy']['street_ru'], 'en');
            }

            if ($data['candidate']['medical_info_ru']) {
                $data['candidate']['medical_info_ka'] = GoogleTranslate::trans($data['candidate']['medical_info_ru'], 'ka');
                $data['candidate']['medical_info_en']  = GoogleTranslate::trans($data['candidate']['medical_info_ru'], 'en');
            }
            if (count($data['candidateWorkExperience']) > 0 ) {
                foreach ($data['candidateWorkExperience'] as $key => $value) {
                    if ($value['position_ru']) {
                        $data['candidateWorkExperience'][$key]['position_en'] = GoogleTranslate::trans($value['position_ru'], 'en');
                        $data['candidateWorkExperience'][$key]['position_ka']  = GoogleTranslate::trans($value['position_ru'], 'ka');
                    }
                    if ($value['object_ru']) {
                        $data['candidateWorkExperience'][$key]['object_en'] = GoogleTranslate::trans($value['object_ru'], 'en');
                        $data['candidateWorkExperience'][$key]['object_ka']  = GoogleTranslate::trans($value['object_ru'], 'ka');
                    }
                    if ($value['no_reason_info_ru']) {
                        $data['candidateWorkExperience'][$key]['no_reason_info_en'] = GoogleTranslate::trans($value['no_reason_info_ru'], 'en');
                        $data['candidateWorkExperience'][$key]['no_reason_info_ka']  = GoogleTranslate::trans($value['no_reason_info_ru'], 'ka');
                    }
                }
            }


        }
        return $data;
    }
    public function candidateSaveData($data)
    {

        $lang = $data['lang'];

        $trData = $this->translate($lang, $data);
        // print_r($trData);
        // exit;

        $result = $this->candidateRepository->save($trData);
        return $result;
    }
    public function candidateFile($data){
        // print_r($data);
        // exit;
        $result = $this->candidateRepository->saveFile($data);
        return $result;
    }

    public function removeOldWorkExperience($data)
    {
        $result = $this->candidateRepository->removeOldWorkExperience($data);
        return $result;
    }
}
