<?php

namespace App\Services;

use App\Models\Vacancy;
use App\Models\Employer;
use App\Models\EmployerAdditionalNumber;
use App\Services\TranslationService;
use App\Repositories\Vacancy\VacancyRepository;
use App\Repositories\Vacancy\FindVacancyRepository;
use App\Services\CandidateModel\AdditionalNumber;

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
        $fieldsToTranslate = [
            'employer' => ['name', 'address', 'street'],
            'vacancy' => ['title', 'additional_schedule'],
            'demand' => ['additional_duty']
        ];
        $translate = new TranslationService();
        $data = $translate->translateFieldsParentKey($lang, $data, $fieldsToTranslate);
        return $data;
    }

    function checkNumber($data) {
        // Attempt to find the employer directly or through an additional number
        $employer = Employer::where('number', $data['number'])->first() ?? null;
                    // EmployerAdditionalNumber::where('number', $data['number'])->first()->employer ?? null;
        // dd($employer);
        // If no employer is found, return an empty collection early
        if (!$employer) {
            return collect();
        }
    
        // Fetch vacancies related to the employer
        $vacancy = Vacancy::where('author_id', $employer->id)
            ->with(['hr', 'category', 'status', 'employer'])
            ->orderBy('id', 'DESC')
            ->get();

        return $vacancy;
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
            if (Vacancy::where('author_id', $employer->id)->whereNotIn('status_id', [5, 13])->exists() && Vacancy::where('author_id', $employer->id)->whereNotIn('status_id', [5, 13])->where('category_id', $data['vacancy']['category']['id'])->exists()) {
                return ['type'=> 'e', 'message' => 'თქვენ არ გაქვთ ამ კატეგორიის ვაკანსიის დამატების უფლება!!!'];
            }
        }
    }

    public function Find($number)
    {
        $result = $this->findVacancyRepository->data($number);
        return $result;
    }




}
