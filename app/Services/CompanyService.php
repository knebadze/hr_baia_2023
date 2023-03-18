<?php

namespace App\Services;

use App\Repositories\CompanyRepository;
use Stichoza\GoogleTranslate\GoogleTranslate;


class CompanyService
{

    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }
    public function translate($lang, $data)
    {
        // $tr = new GoogleTranslate();
        if ($lang == 'ka') {
            $data['company_name_en'] = GoogleTranslate::trans($data['company_name_ka'], 'en');
            $data['company_name_ru']  = GoogleTranslate::trans($data['company_name_ka'], 'ru');

            if ($data['object_type_ka']) {
                $data['object_type_en'] = GoogleTranslate::trans($data['object_type_ka'], 'en');
                $data['object_type_ru']  = GoogleTranslate::trans($data['object_type_ka'], 'ru');
            }


            $data['address_en'] = GoogleTranslate::trans($data['address_ka'], 'en');
            $data['address_ru']  = GoogleTranslate::trans($data['address_ka'], 'ru');

            if ($data['street_ka']) {
                $data['street_en'] = GoogleTranslate::trans($data['street_ka'], 'en');
                $data['street_ru']  = GoogleTranslate::trans($data['street_ka'], 'ru');
            }
        }elseif ($lang == 'en') {
            $data['company_name_ka'] = GoogleTranslate::trans($data['company_name_en'], 'ka');
            $data['company_name_ru']  = GoogleTranslate::trans($data['company_name_en'], 'ru');

            if ($data['object_type_en']) {
                $data['object_type_ka'] = GoogleTranslate::trans($data['object_type_en'], 'ka');
                $data['object_type_ru']  = GoogleTranslate::trans($data['object_type_en'], 'ru');
            }


            $data['address_ka'] = GoogleTranslate::trans($data['address_en'], 'ka');
            $data['address_ru']  = GoogleTranslate::trans($data['address_en'], 'ru');

            if ($data['street_en']) {
                $data['street_ka'] = GoogleTranslate::trans($data['street_en'], 'ka');
                $data['street_ru']  = GoogleTranslate::trans($data['street_en'], 'ru');
            }
        }elseif ($lang == 'ru') {
            $data['company_name_en'] = GoogleTranslate::trans($data['company_name_ru'], 'en');
            $data['company_name_ka']  = GoogleTranslate::trans($data['company_name_ru'], 'ka');

            if ($data['object_type_ru']) {
                $data['object_type_en'] = GoogleTranslate::trans($data['object_type_ru'], 'en');
                $data['object_type_ka']  = GoogleTranslate::trans($data['object_type_ru'], 'ka');
            }


            $data['address_ka'] = GoogleTranslate::trans($data['address_ru'], 'ka');
            $data['address_en']  = GoogleTranslate::trans($data['address_ru'], 'en');

            if ($data['street_ru']) {
                $data['street_ka'] = GoogleTranslate::trans($data['street_ru'], 'ka');
                $data['street_en']  = GoogleTranslate::trans($data['street_ru'], 'en');
            }
        }
        return $data;
    }
    public function saveData($data)
    {

        $lang = $data['lang'];
        $trData = $this->translate($lang, $data);

        $result = $this->companyRepository->save($trData);
        return $result;
    }

}
