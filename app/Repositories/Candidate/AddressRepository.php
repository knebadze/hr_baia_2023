<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;
use App\Services\TranslationService;
use Stichoza\GoogleTranslate\GoogleTranslate;

class AddressRepository
{

    public function translate($lang, $data)
    {
        // Specify the fields you want to translate
        $fieldsToTranslate = ['address', 'street'];

        // Use the TranslationService to translate the fields
        $translate = new TranslationService();
        $data = $translate->translateFields($lang, $data, $fieldsToTranslate);

        return $data;
    }
    function save($data, $user_id) {
        try {
            $lang = (array_key_exists('lang', $data))?$data['lang']:app()->getLocale();
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
