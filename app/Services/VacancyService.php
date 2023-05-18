<?php

namespace App\Services;

use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Repositories\Vacancy\VacancyRepository;
use App\Repositories\Vacancy\FindVacancyRepository;

class VacancyService{
    protected VacancyRepository $vacancyRepository;
    protected FindVacancyRepository $findVacancyRepository;

    public function __construct()
    {
        $this->vacancyRepository = new VacancyRepository;
        $this->findVacancyRepository = new FindVacancyRepository;
    }

    public function translate($lang, $data)
    {
        if ($lang == 'ka') {
            $data['employer']['name_en'] = GoogleTranslate::trans($data['employer']['name_ka'], 'en');
            $data['employer']['name_ru']  = GoogleTranslate::trans($data['employer']['name_ka'], 'ru');

            $data['employer']['address_en'] = GoogleTranslate::trans($data['employer']['address_ka'], 'en');
            $data['employer']['address_ru']  = GoogleTranslate::trans($data['employer']['address_ka'], 'ru');

            $data['vacancy']['title_en'] = GoogleTranslate::trans($data['vacancy']['title_ka'], 'en');
            $data['vacancy']['title_ru']  = GoogleTranslate::trans($data['vacancy']['title_ka'], 'ru');
            if ($data['vacancy']['for_who_ka']) {
                $data['vacancy']['for_who_en'] = GoogleTranslate::trans($data['vacancy']['for_who_ka'], 'en');
                $data['vacancy']['for_who_ru']  = GoogleTranslate::trans($data['vacancy']['for_who_ka'], 'ru');
            }
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
            $data['employer']['name_ka'] = GoogleTranslate::trans($data['employer']['name_en'], 'ka');
            $data['employer']['name_ru']  = GoogleTranslate::trans($data['employer']['name_en'], 'ru');

            $data['employer']['address_ka'] = GoogleTranslate::trans($data['employer']['address_en'], 'ka');
            $data['employer']['address_ru']  = GoogleTranslate::trans($data['employer']['address_en'], 'ru');

            $data['vacancy']['title_ka'] = GoogleTranslate::trans($data['vacancy']['title_en'], 'ka');
            $data['vacancy']['title_ru']  = GoogleTranslate::trans($data['vacancy']['title_en'], 'ru');
            if ($data['vacancy']['for_who_en']) {
                $data['vacancy']['for_who_ka'] = GoogleTranslate::trans($data['vacancy']['for_who_en'], 'ka');
                $data['vacancy']['for_who_ru']  = GoogleTranslate::trans($data['vacancy']['for_who_en'], 'ru');
            }


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
            $data['employer']['name_ka'] = GoogleTranslate::trans($data['employer']['name_ru'], 'ka');
            $data['employer']['name_en']  = GoogleTranslate::trans($data['employer']['name_ru'], 'en');

            $data['employer']['address_ka'] = GoogleTranslate::trans($data['employer']['address_ru'], 'ka');
            $data['employer']['address_en']  = GoogleTranslate::trans($data['employer']['address_ru'], 'en');

            $data['vacancy']['title_ka'] = GoogleTranslate::trans($data['vacancy']['title_ru'], 'ka');
            $data['vacancy']['title_en']  = GoogleTranslate::trans($data['vacancy']['title_ru'], 'en');

            if ($data['vacancy']['for_who_ru']) {
                $data['vacancy']['for_who_ka'] = GoogleTranslate::trans($data['vacancy']['for_who_ru'], 'ka');
                $data['vacancy']['for_who_en']  = GoogleTranslate::trans($data['vacancy']['for_who_ru'], 'en');
            }

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
        $result = $this->vacancyRepository->save($trData);
        return $result;
    }

    public function Find($code)
    {
        $result = $this->findVacancyRepository->data($code);
        return $result;
    }
}
