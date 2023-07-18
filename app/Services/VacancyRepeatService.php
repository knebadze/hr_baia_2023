<?php

namespace App\Services;

use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Repositories\Vacancy\VacancyRepeatRepository;

class VacancyRepeatService
{

    protected VacancyRepeatRepository $vacancyRepeatRepository;
    public function __construct()
    {
        $this->vacancyRepeatRepository = new vacancyRepeatRepository;
    }
    public function translate($lang, $data)
    {
        if ($lang == 'ka') {
            $data['name_en'] = GoogleTranslate::trans($data['name_ka'], 'en');
            $data['name_ru']  = GoogleTranslate::trans($data['name_ka'], 'ru');

            $data['address_en'] = GoogleTranslate::trans($data['address_ka'], 'en');
            $data['address_ru']  = GoogleTranslate::trans($data['address_ka'], 'ru');

            $data['title_en'] = GoogleTranslate::trans($data['title_ka'], 'en');
            $data['title_ru']  = GoogleTranslate::trans($data['title_ka'], 'ru');

            $data['additional_schedule_en'] = GoogleTranslate::trans($data['additional_schedule_ka'], 'en');
            $data['additional_schedule_ru']  = GoogleTranslate::trans($data['additional_schedule_ka'], 'ru');


            if ($data['additional_duty_ka']) {
                $data['additional_duty_en'] = GoogleTranslate::trans($data['additional_duty_ka'], 'en');
                $data['additional_duty_ru']  = GoogleTranslate::trans($data['additional_duty_ka'], 'ru');
            }


        }elseif ($lang == 'en') {
            $data['name_ka'] = GoogleTranslate::trans($data['name_en'], 'ka');
            $data['name_ru']  = GoogleTranslate::trans($data['name_en'], 'ru');

            $data['address_ka'] = GoogleTranslate::trans($data['address_en'], 'ka');
            $data['address_ru']  = GoogleTranslate::trans($data['address_en'], 'ru');

            $data['title_ka'] = GoogleTranslate::trans($data['title_en'], 'ka');
            $data['title_ru']  = GoogleTranslate::trans($data['title_en'], 'ru');



            $data['additional_schedule_ka'] = GoogleTranslate::trans($data['additional_schedule_en'], 'ka');
            $data['additional_schedule_ru']  = GoogleTranslate::trans($data['additional_schedule_en'], 'ru');


            if ($data['additional_duty_en']) {
                $data['additional_duty_ka'] = GoogleTranslate::trans($data['additional_duty_en'], 'ka');
                $data['additional_duty_ru']  = GoogleTranslate::trans($data['additional_duty_en'], 'ru');
            }


        }elseif ($lang == 'ru') {
            $data['name_ka'] = GoogleTranslate::trans($data['name_ru'], 'ka');
            $data['name_en']  = GoogleTranslate::trans($data['name_ru'], 'en');

            $data['address_ka'] = GoogleTranslate::trans($data['address_ru'], 'ka');
            $data['address_en']  = GoogleTranslate::trans($data['address_ru'], 'en');

            $data['title_ka'] = GoogleTranslate::trans($data['title_ru'], 'ka');
            $data['title_en']  = GoogleTranslate::trans($data['title_ru'], 'en');


            $data['additional_schedule_ka'] = GoogleTranslate::trans($data['additional_schedule_ru'], 'ka');
            $data['additional_schedule_en']  = GoogleTranslate::trans($data['additional_schedule_ru'], 'en');


            if ($data['additional_duty_ru']) {
                $data['additional_duty_ka'] = GoogleTranslate::trans($data['additional_duty_ru'], 'ka');
                $data['additional_duty_en']  = GoogleTranslate::trans($data['additional_duty_ru'], 'en');
            }


        }
        return $data;
    }
    public function repeat($data)
    {
        $lang = $data['lang'];
        $trData = $this->translate($lang, $data);
        $result = $this->vacancyRepeatRepository->save($trData);
        return $result;
    }
}
