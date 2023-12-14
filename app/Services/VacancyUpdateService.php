<?php

namespace App\Services;

use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Repositories\Vacancy\VacancyUpdateRepository;
use App\Repositories\Vacancy\VacancyHrUpdateRepository;
use App\Repositories\Vacancy\VacancyRedactedRepository;
use App\Repositories\Vacancy\VacancyStatusUpdateRepository;

class VacancyUpdateService{
    protected VacancyUpdateRepository $vacancyUpdateRepository;
    protected VacancyRedactedRepository $vacancyRedactedRepository;
    protected VacancyStatusUpdateRepository $vacancyStatusUpdateRepository;
    protected VacancyHrUpdateRepository $vacancyHrUpdateRepository;
    public function __construct()
    {
        $this->vacancyUpdateRepository = new VacancyUpdateRepository;
        $this->vacancyRedactedRepository = new VacancyRedactedRepository;
        $this->vacancyStatusUpdateRepository = new VacancyStatusUpdateRepository;
        $this->vacancyHrUpdateRepository = new VacancyHrUpdateRepository;
    }

    public function translate($lang, $data)
    {
        if ($lang == 'ka') {
            $data['name_en'] = GoogleTranslate::trans($data['name_ka'], 'en');
            $data['name_ru']  = GoogleTranslate::trans($data['name_ka'], 'ru');

            $data['address_en'] = GoogleTranslate::trans($data['address_ka'], 'en');
            $data['address_ru']  = GoogleTranslate::trans($data['address_ka'], 'ru');
            if ($data['street_ka']) {
                $data['street_en'] = GoogleTranslate::trans($data['street_ka'], 'en');
                $data['street_ru']  = GoogleTranslate::trans($data['street_ka'], 'ru');
            }


            if ($data['title_ka']) {
                $data['title_en'] = GoogleTranslate::trans($data['title_ka'], 'en');
                $data['title_ru']  = GoogleTranslate::trans($data['title_ka'], 'ru');
            }


            $data['additional_schedule_en'] = GoogleTranslate::trans($data['additional_schedule_ka'], 'en');
            $data['additional_schedule_ru']  = GoogleTranslate::trans($data['additional_schedule_ka'], 'ru');


            if ($data['demand']['additional_duty_ka']) {
                $data['demand']['additional_duty_en'] = GoogleTranslate::trans($data['demand']['additional_duty_ka'], 'en');
                $data['demand']['additional_duty_ru']  = GoogleTranslate::trans($data['demand']['additional_duty_ka'], 'ru');
            }


        }elseif ($lang == 'en') {
            $data['name_ka'] = GoogleTranslate::trans($data['name_en'], 'ka');
            $data['name_ru']  = GoogleTranslate::trans($data['name_en'], 'ru');

            $data['address_ka'] = GoogleTranslate::trans($data['address_en'], 'ka');
            $data['address_ru']  = GoogleTranslate::trans($data['address_en'], 'ru');

            if ($data['street_en']) {
                $data['street_ka'] = GoogleTranslate::trans($data['street_en'], 'ka');
                $data['street_ru']  = GoogleTranslate::trans($data['street_en'], 'ru');
            }


            if ($data['title_en']) {
                $data['title_ka'] = GoogleTranslate::trans($data['title_en'], 'ka');
                $data['title_ru']  = GoogleTranslate::trans($data['title_en'], 'ru');
            }


            $data['additional_schedule_ka'] = GoogleTranslate::trans($data['additional_schedule_en'], 'ka');
            $data['additional_schedule_ru']  = GoogleTranslate::trans($data['additional_schedule_en'], 'ru');


            if ($data['demand']['additional_duty_en']) {
                $data['demand']['additional_duty_ka'] = GoogleTranslate::trans($data['demand']['additional_duty_en'], 'ka');
                $data['demand']['additional_duty_ru']  = GoogleTranslate::trans($data['demand']['additional_duty_en'], 'ru');
            }


        }elseif ($lang == 'ru') {
            $data['name_ka'] = GoogleTranslate::trans($data['name_ru'], 'ka');
            $data['name_en']  = GoogleTranslate::trans($data['name_ru'], 'en');

            $data['address_ka'] = GoogleTranslate::trans($data['address_ru'], 'ka');
            $data['address_en']  = GoogleTranslate::trans($data['address_ru'], 'en');

            if ($data['street_ru']) {
                $data['street_ka'] = GoogleTranslate::trans($data['street_ru'], 'ka');
                $data['street_en']  = GoogleTranslate::trans($data['street_ru'], 'en');
            }

            if ($data['title_ru']) {
                $data['title_ka'] = GoogleTranslate::trans($data['title_ru'], 'ka');
                $data['title_en']  = GoogleTranslate::trans($data['title_ru'], 'en');
            }


            $data['additional_schedule_ka'] = GoogleTranslate::trans($data['additional_schedule_ru'], 'ka');
            $data['additional_schedule_en']  = GoogleTranslate::trans($data['additional_schedule_ru'], 'en');


            if ($data['demand']['additional_duty_ru']) {
                $data['demand']['additional_duty_ka'] = GoogleTranslate::trans($data['demand']['additional_duty_ru'], 'ka');
                $data['demand']['additional_duty_en']  = GoogleTranslate::trans($data['demand']['additional_duty_ru'], 'en');
            }


        }
        return $data;
    }
    public function updateData($data) {
        // dd($data);
        $lang = $data['model']['lang'];
        $trData = $this->translate($lang, $data['model']);

        $update = $this->vacancyUpdateRepository->update($trData);
        $history = $this->vacancyRedactedRepository->save($data['model']['id'], $data['edit']);
        $result = [$update, $history];
        return $result;
    }

    public function updateDepositData($data) {
        $update = $this->vacancyUpdateRepository->updateDeposit($data['model']);
        $history = $this->vacancyRedactedRepository->save($data['model']['id'], $data['edit']);
        $result = [$update, $history];
        return $result;
    }


    function updateHr($data) {
        // dd($data['model']['id']);
        $update = $this->vacancyHrUpdateRepository->update($data['model']);
        $history = $this->vacancyRedactedRepository->save($data['model']['id'], $data['edit']);
        $result = [$update, $history];
        return $result;
    }


}
