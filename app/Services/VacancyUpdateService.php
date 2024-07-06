<?php

namespace App\Services;

use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Repositories\Vacancy\VacancyUpdateRepository;
use App\Repositories\Vacancy\VacancyHrUpdateRepository;
use App\Repositories\Vacancy\VacancyStatusUpdateRepository;

class VacancyUpdateService{
    protected VacancyUpdateRepository $vacancyUpdateRepository;
    protected VacancyStatusUpdateRepository $vacancyStatusUpdateRepository;
    protected VacancyHrUpdateRepository $vacancyHrUpdateRepository;
    public function __construct()
    {
        $this->vacancyUpdateRepository = new VacancyUpdateRepository;
        $this->vacancyStatusUpdateRepository = new VacancyStatusUpdateRepository;
        $this->vacancyHrUpdateRepository = new VacancyHrUpdateRepository;
    }

    public function translate($lang, $data)
    {

        if ($lang == 'ka') {
            $data['employer']['name_en'] = GoogleTranslate::trans($data['employer']['name_ka'], 'en');
            $data['employer']['name_ru']  = GoogleTranslate::trans($data['employer']['name_ka'], 'ru');

            $data['employer']['address_en'] = GoogleTranslate::trans($data['employer']['address_ka'], 'en');
            $data['employer']['address_ru']  = GoogleTranslate::trans($data['employer']['address_ka'], 'ru');
            if ($data['employer']['street_ka']) {
                $data['employer']['street_en'] = GoogleTranslate::trans($data['employer']['street_ka'], 'en');
                $data['employer']['street_ru']  = GoogleTranslate::trans($data['employer']['street_ka'], 'ru');
            }


            if ($data['title_ka']) {
                $data['title_en'] = GoogleTranslate::trans($data['title_ka'], 'en');
                $data['title_ru']  = GoogleTranslate::trans($data['title_ka'], 'ru');
            }


            $data['additional_schedule_en'] = GoogleTranslate::trans($data['additional_schedule_ka'], 'en');
            $data['additional_schedule_ru']  = GoogleTranslate::trans($data['additional_schedule_ka'], 'ru');


            if ($data['demand'] && isset($data['demand']['additional_duty_ka'])) {
                $data['demand']['additional_duty_en'] = GoogleTranslate::trans($data['demand']['additional_duty_ka'], 'en');
                $data['demand']['additional_duty_ru']  = GoogleTranslate::trans($data['demand']['additional_duty_ka'], 'ru');
            }


        }elseif ($lang == 'en') {
            $data['employer']['name_ka'] = GoogleTranslate::trans($data['employer']['name_en'], 'ka');
            $data['employer']['name_ru']  = GoogleTranslate::trans($data['employer']['name_en'], 'ru');

            $data['employer']['address_ka'] = GoogleTranslate::trans($data['employer']['address_en'], 'ka');
            $data['employer']['address_ru']  = GoogleTranslate::trans($data['employer']['address_en'], 'ru');

            if ($data['employer']['street_en']) {
                $data['employer']['street_ka'] = GoogleTranslate::trans($data['employer']['street_en'], 'ka');
                $data['employer']['street_ru']  = GoogleTranslate::trans($data['employer']['street_en'], 'ru');
            }


            if ($data['title_en']) {
                $data['title_ka'] = GoogleTranslate::trans($data['title_en'], 'ka');
                $data['title_ru']  = GoogleTranslate::trans($data['title_en'], 'ru');
            }


            $data['additional_schedule_ka'] = GoogleTranslate::trans($data['additional_schedule_en'], 'ka');
            $data['additional_schedule_ru']  = GoogleTranslate::trans($data['additional_schedule_en'], 'ru');


            if ($data['demand'] && isset($data['demand']['additional_duty_en'])) {
                $data['demand']['additional_duty_ka'] = GoogleTranslate::trans($data['demand']['additional_duty_en'], 'ka');
                $data['demand']['additional_duty_ru']  = GoogleTranslate::trans($data['demand']['additional_duty_en'], 'ru');
            }


        }elseif ($lang == 'ru') {
            $data['employer']['name_ka'] = GoogleTranslate::trans($data['employer']['name_ru'], 'ka');
            $data['employer']['name_en']  = GoogleTranslate::trans($data['employer']['name_ru'], 'en');

            $data['employer']['address_ka'] = GoogleTranslate::trans($data['employer']['address_ru'], 'ka');
            $data['employer']['address_en']  = GoogleTranslate::trans($data['employer']['address_ru'], 'en');

            if ($data['employer']['street_ru']) {
                $data['employer']['street_ka'] = GoogleTranslate::trans($data['employer']['street_ru'], 'ka');
                $data['employer']['street_en']  = GoogleTranslate::trans($data['employer']['street_ru'], 'en');
            }

            if ($data['title_ru']) {
                $data['title_ka'] = GoogleTranslate::trans($data['title_ru'], 'ka');
                $data['title_en']  = GoogleTranslate::trans($data['title_ru'], 'en');
            }


            $data['additional_schedule_ka'] = GoogleTranslate::trans($data['additional_schedule_ru'], 'ka');
            $data['additional_schedule_en']  = GoogleTranslate::trans($data['additional_schedule_ru'], 'en');


            if ($data['demand'] && isset($data['demand']['additional_duty_ru'])) {
                $data['demand']['additional_duty_ka'] = GoogleTranslate::trans($data['demand']['additional_duty_ru'], 'ka');
                $data['demand']['additional_duty_en']  = GoogleTranslate::trans($data['demand']['additional_duty_ru'], 'en');
            }


        }
        return $data;
    }
    public function updateData($data, $ip) {['lang'];
        $trData = $this->translate($lang, $data['model']);
        $result = $this->vacancyUpdateRepository->update($trData, $ip);
        return $result;
    }

    public function updateDepositData($data) {
        $result = $this->vacancyUpdateRepository->updateDeposit($data['model']);
        return $result;
    }


    function updateHr($data) {
        $result= $this->vacancyHrUpdateRepository->update($data['model']);
        return $result;
    }


}
