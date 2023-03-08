<?php

namespace App\Services;

use App\Repositories\VacancyRepository;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Http\Controllers\Employer\VacancyController;

class VacancyService{
    protected $vacancyRepository;

    public function __construct(VacancyRepository $vacancyRepository)
    {
        $this->vacancyRepository = $vacancyRepository;
    }

    public function translate($lang, $data)
    {
        if ($lang == 'ka') {
            $data['vacancy']['address_en'] = GoogleTranslate::trans($data['vacancy']['address_ka'], 'en');
            $data['vacancy']['address_ru']  = GoogleTranslate::trans($data['vacancy']['address_ka'], 'ru');

            $data['vacancy']['title_en'] = GoogleTranslate::trans($data['vacancy']['title_ka'], 'en');
            $data['vacancy']['title_ru']  = GoogleTranslate::trans($data['vacancy']['title_ka'], 'ru');

            $data['vacancy']['for_who_en'] = GoogleTranslate::trans($data['vacancy']['for_who_ka'], 'en');
            $data['vacancy']['for_who_ru']  = GoogleTranslate::trans($data['vacancy']['for_who_ka'], 'ru');

            $data['vacancy']['additional_schedule_en'] = GoogleTranslate::trans($data['vacancy']['additional_schedule_ka'], 'en');
            $data['vacancy']['additional_schedule_ru']  = GoogleTranslate::trans($data['vacancy']['additional_schedule_ka'], 'ru');

            if ($data['vacancy']['additional_ka']) {
                $data['vacancy']['additional_en'] = GoogleTranslate::trans($data['vacancy']['additional_ka'], 'en');
                $data['vacancy']['additional_ru']  = GoogleTranslate::trans($data['vacancy']['additional_ka'], 'ru');
            }
            if ($data['demand']['additional_duty_ka']) {
                $data['demand']['additional_duty_en'] = GoogleTranslate::trans($data['demand']['additional_duty_ka'], 'en');
                $data['demand']['additional_duty_ru']  = GoogleTranslate::trans($data['demand']['additional_duty_ka'], 'ru');
            }


        }elseif ($lang == 'en') {
            $data['vacancy']['address_ka'] = GoogleTranslate::trans($data['vacancy']['address_en'], 'ka');
            $data['vacancy']['address_ru']  = GoogleTranslate::trans($data['vacancy']['address_en'], 'ru');

            $data['vacancy']['title_ka'] = GoogleTranslate::trans($data['vacancy']['title_en'], 'ka');
            $data['vacancy']['title_ru']  = GoogleTranslate::trans($data['vacancy']['title_en'], 'ru');

            $data['vacancy']['for_who_ka'] = GoogleTranslate::trans($data['vacancy']['for_who_en'], 'ka');
            $data['vacancy']['for_who_ru']  = GoogleTranslate::trans($data['vacancy']['for_who_en'], 'ru');

            $data['vacancy']['additional_schedule_ka'] = GoogleTranslate::trans($data['vacancy']['additional_schedule_en'], 'ka');
            $data['vacancy']['additional_schedule_ru']  = GoogleTranslate::trans($data['vacancy']['additional_schedule_en'], 'ru');

            if ($data['vacancy']['additional_en']) {
                $data['vacancy']['additional_ka'] = GoogleTranslate::trans($data['vacancy']['additional_en'], 'ka');
                $data['vacancy']['additional_ru']  = GoogleTranslate::trans($data['vacancy']['additional_en'], 'ru');
            }

            if ($data['demand']['additional_duty_en']) {
                $data['demand']['additional_duty_ka'] = GoogleTranslate::trans($data['demand']['additional_duty_en'], 'ka');
                $data['demand']['additional_duty_ru']  = GoogleTranslate::trans($data['demand']['additional_duty_en'], 'ru');
            }


        }elseif ($lang == 'ru') {
            $data['vacancy']['address_ka'] = GoogleTranslate::trans($data['vacancy']['address_ru'], 'ka');
            $data['vacancy']['address_en']  = GoogleTranslate::trans($data['vacancy']['address_ru'], 'en');

            $data['vacancy']['title_ka'] = GoogleTranslate::trans($data['vacancy']['title_ru'], 'ka');
            $data['vacancy']['title_en']  = GoogleTranslate::trans($data['vacancy']['title_ru'], 'en');

            $data['vacancy']['for_who_ka'] = GoogleTranslate::trans($data['vacancy']['for_who_ru'], 'ka');
            $data['vacancy']['for_who_en']  = GoogleTranslate::trans($data['vacancy']['for_who_ru'], 'en');

            $data['vacancy']['additional_schedule_ka'] = GoogleTranslate::trans($data['vacancy']['additional_schedule_ru'], 'ka');
            $data['vacancy']['additional_schedule_en']  = GoogleTranslate::trans($data['vacancy']['additional_schedule_ru'], 'en');

            if ($data['vacancy']['additional_ru']) {
                $data['vacancy']['additional_ka'] = GoogleTranslate::trans($data['vacancy']['additional_ru'], 'ka');
                $data['vacancy']['additional_en']  = GoogleTranslate::trans($data['vacancy']['additional_ru'], 'en');
            }

            if ($data['demand']['additional_duty_ru']) {
                $data['demand']['additional_duty_ka'] = GoogleTranslate::trans($data['demand']['additional_duty_ru'], 'ka');
                $data['demand']['additional_duty_en']  = GoogleTranslate::trans($data['demand']['additional_duty_ru'], 'en');
            }


        }
        return $data;
    }
    public function saveData($data)
    {

        $lang = $data['lang'];
        $trData = $this->translate($lang, $data);

        // print_r($trData);
        // exit;
        $result = $this->vacancyRepository->save($trData);
        return $result;
    }
}
