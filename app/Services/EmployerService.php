<?php

namespace App\Services;

use App\Repositories\EmployerRepository;
use Stichoza\GoogleTranslate\GoogleTranslate;

class EmployerService{
    protected $employerRepository;

    public function __construct(EmployerRepository $employerRepository)
    {
        $this->employerRepository = $employerRepository;
    }
    public function translate($lang, $data)
    {
        // $tr = new GoogleTranslate();
        if ($lang == 'ka') {
            $data['address_en'] = GoogleTranslate::trans($data['address_ka'], 'en');
            $data['address_ru']  = GoogleTranslate::trans($data['address_ka'], 'ru');
            if ($data['street_ka']) {
                $data['street_en'] = GoogleTranslate::trans($data['street_ka'], 'en');
                $data['street_ru']  = GoogleTranslate::trans($data['street_ka'], 'ru');
            }
        }elseif ($lang == 'en') {
            $data['address_ka'] = GoogleTranslate::trans($data['address_en'], 'ka');
            $data['address_ru']  = GoogleTranslate::trans($data['address_en'], 'ru');
            if ($data['street_en']) {
                $data['street_ka'] = GoogleTranslate::trans($data['street_en'], 'ka');
                $data['street_ru']  = GoogleTranslate::trans($data['street_en'], 'ru');
            }
        }elseif ($lang == 'ru') {
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

        // print_r($trData);
        // exit;
        $result = $this->employerRepository->save($trData);
        return $result;
    }
}
