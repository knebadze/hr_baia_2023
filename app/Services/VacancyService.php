<?php

namespace App\Services;

use App\Models\Employer;
use App\Models\Vacancy;
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
            if ($data['employer']['street_ka']) {
                $data['employer']['street_en'] = GoogleTranslate::trans($data['employer']['street_ka'], 'en');
                $data['employer']['street_ru']  = GoogleTranslate::trans($data['employer']['street_ka'], 'ru');
            }


            $data['vacancy']['title_en'] = GoogleTranslate::trans($data['vacancy']['title_ka'], 'en');
            $data['vacancy']['title_ru']  = GoogleTranslate::trans($data['vacancy']['title_ka'], 'ru');

            $data['vacancy']['additional_schedule_en'] = GoogleTranslate::trans($data['vacancy']['additional_schedule_ka'], 'en');
            $data['vacancy']['additional_schedule_ru']  = GoogleTranslate::trans($data['vacancy']['additional_schedule_ka'], 'ru');


            if ($data['demand']['additional_duty_ka']) {
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


            $data['vacancy']['title_ka'] = GoogleTranslate::trans($data['vacancy']['title_en'], 'ka');
            $data['vacancy']['title_ru']  = GoogleTranslate::trans($data['vacancy']['title_en'], 'ru');



            $data['vacancy']['additional_schedule_ka'] = GoogleTranslate::trans($data['vacancy']['additional_schedule_en'], 'ka');
            $data['vacancy']['additional_schedule_ru']  = GoogleTranslate::trans($data['vacancy']['additional_schedule_en'], 'ru');


            if ($data['demand']['additional_duty_en']) {
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

            $data['vacancy']['title_ka'] = GoogleTranslate::trans($data['vacancy']['title_ru'], 'ka');
            $data['vacancy']['title_en']  = GoogleTranslate::trans($data['vacancy']['title_ru'], 'en');


            $data['vacancy']['additional_schedule_ka'] = GoogleTranslate::trans($data['vacancy']['additional_schedule_ru'], 'ka');
            $data['vacancy']['additional_schedule_en']  = GoogleTranslate::trans($data['vacancy']['additional_schedule_ru'], 'en');


            if ($data['demand']['additional_duty_ru']) {
                $data['demand']['additional_duty_ka'] = GoogleTranslate::trans($data['demand']['additional_duty_ru'], 'ka');
                $data['demand']['additional_duty_en']  = GoogleTranslate::trans($data['demand']['additional_duty_ru'], 'en');
            }


        }
        return $data;
    }

    public function saveData($data)
    {
        $result = $this->rule($data);
        if (isset($result['type'])) {
            return $result;
        }
        $lang = $data['lang'];
        $trData = $this->translate($lang, $data);
        $result = $this->vacancyRepository->save($trData);
        return $result;
    }
    function rule($data){
        if (Employer::where('number', $data['employer']['number'])->exists()) {

            $employer = Employer::where('number', $data['employer']['number'])->first();
            if (Vacancy::where('author_id', $employer->id)->whereNotIn('status_id', [5, 13])->exists() && Vacancy::where('author_id', $employer->id)->whereNotIn('status_id', [5, 13])->where('category_id', $data['vacancy']['category_id']['id'])->exists()) {
                return ['type'=> 'e', 'message' => 'თქვენ არ გაქვთ ამ კატეგორიის ვაკანსიის დამატების უფლება!!!'];
            }
        }
    }
    public function Find($code)
    {
        $result = $this->findVacancyRepository->data($code);
        return $result;
    }




}
