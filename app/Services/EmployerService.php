<?php

namespace App\Services;

use App\Repositories\EmployerRepository;

class EmployerService{
    protected $employerRepository;

    public function __construct(EmployerRepository $employerRepository)
    {
        $this->employerRepository = $employerRepository;
    }
    
    public function translate($lang, $data)
    {
        // Specify the fields you want to translate
        $fieldsToTranslate = ['address', 'street'];

        // Use the TranslationService to translate the fields
        $translate = new TranslationService();
        $data = $translate->translateFields($lang, $data, $fieldsToTranslate);

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
