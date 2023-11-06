<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;
use Stichoza\GoogleTranslate\GoogleTranslate;

class AddressRepository
{
    public function translate($lang, $data)
    {
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
                $data['street_en']  = GoogleTranslate::trans($data['vacancy']['street_ru'], 'en');
            }


        }
        return $data;
    }
    function save($data, $user_id) {
        try {
            $lang = (array_key_exists('lang', $data))?$data['lang']:'ka';
            $data = $this->translate($lang, $data);
            $candidate = Candidate::where('user_id', $user_id)->update(
                [
                    'address_ka' =>  $data['address_ka'],
                    'address_en' =>  $data['address_en'],
                    'address_ru' =>  $data['address_ru'],
                    'street_ka' =>  $data['street_ka'],
                    'street_en' =>  $data['street_en'],
                    'street_ru' =>  $data['street_ru'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                    'stage' => 2,
                ]);
                return [
                    'success' => true,
                    'data' => $candidate,
                ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}
