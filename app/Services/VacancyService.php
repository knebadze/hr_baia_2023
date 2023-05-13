<?php

namespace App\Services;

use App\Models\Hr;
use App\Models\User;
use App\Models\Vacancy;
use App\Models\HrHasVacancy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\VacancyRepository;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Http\Controllers\Employer\VacancyController;

class VacancyService{
    protected $vacancyRepository;

    public function __construct(VacancyRepository $vacancyRepository)
    {
        $this->vacancyRepository = $vacancyRepository;
    }

    public function translate($lang, $data)
    {
        if ($lang == 'ka') {
            $data['vacancy']['name_en'] = GoogleTranslate::trans($data['vacancy']['name_ka'], 'en');
            $data['vacancy']['name_ru']  = GoogleTranslate::trans($data['vacancy']['name_ka'], 'ru');

            $data['vacancy']['address_en'] = GoogleTranslate::trans($data['vacancy']['address_ka'], 'en');
            $data['vacancy']['address_ru']  = GoogleTranslate::trans($data['vacancy']['address_ka'], 'ru');

            $data['vacancy']['title_en'] = GoogleTranslate::trans($data['vacancy']['title_ka'], 'en');
            $data['vacancy']['title_ru']  = GoogleTranslate::trans($data['vacancy']['title_ka'], 'ru');
            if ($data['vacancy']['for_who_ka']) {
                $data['vacancy']['for_who_en'] = GoogleTranslate::trans($data['vacancy']['for_who_ka'], 'en');
                $data['vacancy']['for_who_ru']  = GoogleTranslate::trans($data['vacancy']['for_who_ka'], 'ru');
            }
            $data['vacancy']['additional_schedule_en'] = GoogleTranslate::trans($data['vacancy']['additional_schedule_ka'], 'en');
            $data['vacancy']['additional_schedule_ru']  = GoogleTranslate::trans($data['vacancy']['additional_schedule_ka'], 'ru');

            if ($data['vacancy']['additional_ka']) {
                $data['vacancy']['additional_en'] = GoogleTranslate::trans($data['vacancy']['additional_ka'], 'en');
                $data['vacancy']['additional_ru']  = GoogleTranslate::trans($data['vacancy']['additional_ka'], 'ru');
            }
            if ($data['demand']['additional_duty_ka']) {
                $data['demand']['additional_duty_en'] = GoogleTranslate::trans($data['demand']['additional_duty_ka'], 'en');
                $data['demand']['additional_duty_ru']  = GoogleTranslate::trans($data['demand']['additional_duty_ka'], 'ru');
            }


        }elseif ($lang == 'en') {
            $data['vacancy']['name_ka'] = GoogleTranslate::trans($data['vacancy']['name_en'], 'ka');
            $data['vacancy']['name_ru']  = GoogleTranslate::trans($data['vacancy']['name_en'], 'ru');

            $data['vacancy']['address_ka'] = GoogleTranslate::trans($data['vacancy']['address_en'], 'ka');
            $data['vacancy']['address_ru']  = GoogleTranslate::trans($data['vacancy']['address_en'], 'ru');

            $data['vacancy']['title_ka'] = GoogleTranslate::trans($data['vacancy']['title_en'], 'ka');
            $data['vacancy']['title_ru']  = GoogleTranslate::trans($data['vacancy']['title_en'], 'ru');
            if ($data['vacancy']['for_who_en']) {
                $data['vacancy']['for_who_ka'] = GoogleTranslate::trans($data['vacancy']['for_who_en'], 'ka');
                $data['vacancy']['for_who_ru']  = GoogleTranslate::trans($data['vacancy']['for_who_en'], 'ru');
            }


            $data['vacancy']['additional_schedule_ka'] = GoogleTranslate::trans($data['vacancy']['additional_schedule_en'], 'ka');
            $data['vacancy']['additional_schedule_ru']  = GoogleTranslate::trans($data['vacancy']['additional_schedule_en'], 'ru');

            if ($data['vacancy']['additional_en']) {
                $data['vacancy']['additional_ka'] = GoogleTranslate::trans($data['vacancy']['additional_en'], 'ka');
                $data['vacancy']['additional_ru']  = GoogleTranslate::trans($data['vacancy']['additional_en'], 'ru');
            }

            if ($data['demand']['additional_duty_en']) {
                $data['demand']['additional_duty_ka'] = GoogleTranslate::trans($data['demand']['additional_duty_en'], 'ka');
                $data['demand']['additional_duty_ru']  = GoogleTranslate::trans($data['demand']['additional_duty_en'], 'ru');
            }


        }elseif ($lang == 'ru') {
            $data['vacancy']['name_ka'] = GoogleTranslate::trans($data['vacancy']['name_ru'], 'ka');
            $data['vacancy']['name_en']  = GoogleTranslate::trans($data['vacancy']['name_ru'], 'en');

            $data['vacancy']['address_ka'] = GoogleTranslate::trans($data['vacancy']['address_ru'], 'ka');
            $data['vacancy']['address_en']  = GoogleTranslate::trans($data['vacancy']['address_ru'], 'en');

            $data['vacancy']['title_ka'] = GoogleTranslate::trans($data['vacancy']['title_ru'], 'ka');
            $data['vacancy']['title_en']  = GoogleTranslate::trans($data['vacancy']['title_ru'], 'en');

            if ($data['vacancy']['for_who_ru']) {
                $data['vacancy']['for_who_ka'] = GoogleTranslate::trans($data['vacancy']['for_who_ru'], 'ka');
                $data['vacancy']['for_who_en']  = GoogleTranslate::trans($data['vacancy']['for_who_ru'], 'en');
            }

            $data['vacancy']['additional_schedule_ka'] = GoogleTranslate::trans($data['vacancy']['additional_schedule_ru'], 'ka');
            $data['vacancy']['additional_schedule_en']  = GoogleTranslate::trans($data['vacancy']['additional_schedule_ru'], 'en');

            if ($data['vacancy']['additional_ru']) {
                $data['vacancy']['additional_ka'] = GoogleTranslate::trans($data['vacancy']['additional_ru'], 'ka');
                $data['vacancy']['additional_en']  = GoogleTranslate::trans($data['vacancy']['additional_ru'], 'en');
            }

            if ($data['demand']['additional_duty_ru']) {
                $data['demand']['additional_duty_ka'] = GoogleTranslate::trans($data['demand']['additional_duty_ru'], 'ka');
                $data['demand']['additional_duty_en']  = GoogleTranslate::trans($data['demand']['additional_duty_ru'], 'en');
            }


        }
        return $data;
    }
    public function addHr($data)
    {
        //თუ დამსაქმებელს აქვს უკვე გამოგზავნილი ვაკანსია ვპოულობ hr და ისევ მას ვაწერ ამ ვაკანისას
        //rewrite ვუცვლი რადგან ერთი წრე გამოტოვოს
        if (DB::table('vacancies')->where('author_id', Auth::id())->exists()) {

            $findAuthor = Vacancy::where('author_id', Auth::id())->first();
            // print(Auth::id());
            // exit;
            $data['vacancy']['hr_id'] = $findAuthor->hr_id;
            HrHasVacancy::where('hr_id', $findAuthor->hr_id)->update(['rewrite'=> 1]);
            return $data;
        }
        //ვპოულობ Hr რომელსაც არ აქვს ვაკანსია დაწერი ან ქონდა და სხვას გადააწერა ადმინმა
        //თუ იპოვა და აქტიურია ეს hr ვაწერ ვაკანსიას
        $hrHasVacancy = HrHasVacancy::where('has_vacancy', 0)->get();
        if (count($hrHasVacancy)) {
            foreach ($hrHasVacancy as $key => $value) {
                if ($value->is_active == 1) {
                    $data['vacancy']['hr_id'] = $value->hr_id;
                    HrHasVacancy::where('hr_id', $value->hr_id)->update(['has_vacancy'=> 1]);
                    break;
                }

            }
            //თუ დაწერა ვაკანსია return
            //თუ არ დაეწერა არააქტიურობის გამო ვიწყებ ვაკანსიებიდან ჰრ ის ძებნას
            if ($data['vacancy']['hr_id']) {
                return $data;
            }else{
                return $this->addHrFromVacancy($data);
            }
        }
        //თუ არ არის ჰრ რომელსაც არ აქვს ვაკანსია მაშინ პირდაპირ ვიწყებ ვაკანიებიდან ბოლოს დაწერილი ჰრ ის ძებნას
        return $this->addHrFromVacancy($data);
    }
    public function addHrFromVacancy($data)
    {

        $vacancy = Vacancy::orderBy('id', 'DESC')->first();
        $lastHrId = HrHasVacancy::orderBy('hr_id', 'DESC')->where('is_active', 1)->first();
        //ყველა hr გარდა ბოლოს დაწერილი hr_ისა
        $allHr = HrHasVacancy::whereNot('hr_id', $vacancy->hr_id)->get();
        foreach ($allHr as $key => $value) {
            if ($value->is_active == 1 && $value->rewrite == 0) {
                if ($value->hr_id > $vacancy->hr_id) {
                    //მეტია იდ
                    $mIds[] = $value->hr_id;
                }else{
                    //ნაკლებია იდ
                    $lIds[] = $value->hr_id;
                }

            }
        }
        if(count($mIds)) {

            $data['vacancy']['hr_id'] = $mIds[0];
            //თუ ბოლო ჰრ ია მაშინ იმ HR ებს რომელსაც ქონდა გადაწერილი ვაკანსია ვუცვლი სტატუს რადგან ახალ წრეზე მოხდეს მათვის ვაკანსიების დაწერა
            if ($mIds[0] == $lastHrId->id) {
                HrHasVacancy::where('rewrite', 1)->update(['rewrite'=> 0]);
            }
            return $data;
        }
        if (count($lIds)) {
            $data['vacancy']['hr_id'] = $mIds[0];
            return $data;
        }
    }
    public function saveData($data)
    {

        $lang = $data['lang'];
        $fullData = $this->addHr($data);
        $trData = $this->translate($lang, $fullData);
        $result = $this->vacancyRepository->save($trData);
        return $result;
    }
}
