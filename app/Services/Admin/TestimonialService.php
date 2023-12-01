<?php

namespace App\Services\Admin;

use App\Repositories\Admin\Testimonial\TestimonialRepository;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TestimonialService {
    protected TestimonialRepository $testimonialRepository;
    // protected DisbursementOfSalaryRepository $disbursementOfSalaryRepository;
    public function __construct()
    {
        $this->testimonialRepository = new TestimonialRepository;
        // $this->disbursementOfSalaryRepository = new DisbursementOfSalaryRepository;
    }

    public function translate($lang, $data)
    {
        $translations = [
            'ka' => ['en', 'ru'],
            'en' => ['ka', 'ru'],
            'ru' => ['ka', 'en'],
        ];
        foreach ($translations[$lang] as $targetLang) {

            foreach (['fullName', 'profession', 'text'] as $field) {
                $sourceField = "{$field}_{$lang}";
                $targetField = "{$field}_{$targetLang}";
                $data[$targetField] = GoogleTranslate::trans($data[$sourceField], $targetLang);
            }
        }
        return $data;
    }

    function save($data){
        $result = $this->testimonialRepository->save($data);
        return $result;
    }

    function update($data) {
        // dd($data);
        $result = $this->testimonialRepository->update($data);
        return $result;
    }

    function delete($data) {
        // dd($data);
        $result = $this->testimonialRepository->delete($data);
        return $result;
    }
}
