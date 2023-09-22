<?php

namespace App\Repositories\Candidate;

use App\Models\User;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;
use App\Models\CandidateRecommendation;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;

class RecommendationRepository
{
    function translate($lang, $data)  {
        if ($lang == 'ka') {
            if (isset($data['data']->name_ka)) {
                $data['data']->name_en = GoogleTranslate::trans($data['data']->name_ka, 'en');
                $data['data']->name_ru  = GoogleTranslate::trans($data['data']->name_ka, 'ru');
            }
            if (isset($data['data']->position_ka)) {
                $data['data']->position_en = GoogleTranslate::trans($data['data']->position_ka, 'en');
                $data['data']->position_ru  = GoogleTranslate::trans($data['data']->position_ka, 'ru');
            }
        }elseif ($lang == 'en') {
            if ($data['data']->name_en) {
                $data['data']->name_ka = GoogleTranslate::trans($data['data']->name_en, 'ka');
                $data['data']->name_ru  = GoogleTranslate::trans($data['data']->name_en, 'ru');
            }
            if ($data['data']->position_en) {
                $data['data']->position_ka = GoogleTranslate::trans($data['data']->position_en, 'ka');
                $data['data']->position_ru  = GoogleTranslate::trans($data['data']->position_en, 'ru');
            }

        }elseif ($lang == 'ru') {
            if ($data['data']->name_ru) {
                $data['data']->name_ka = GoogleTranslate::trans($data['data']->name_ru, 'ka');
                $data['data']->name_en  = GoogleTranslate::trans($data['data']->name_ru, 'en');
            }
            if ($data['data']->position_ru) {
                $data['data']->position_ka = GoogleTranslate::trans($data['data']->position_ru, 'ka');
                $data['data']->position_en  = GoogleTranslate::trans($data['data']->position_ru, 'en');
            }
        }
        return $data;
    }
    function save($data) {
        // dd($data);
        $lang = (isset($data['data']->lang))?$data['data']->lang:'ka';
        $data = $this->translate($lang, $data);
        $candidate_id = $data['data']->candidate_id ? $data['data']->candidate_id :Auth::user()->candidate->id;
        $recommendation = new CandidateRecommendation();
        $recommendation->candidate_id = $candidate_id;
        $recommendation->recommendation = $data['data']->has_recommendation->id;
        if ($data['data']->has_recommendation->id == 1) {
            if (CandidateRecommendation::where('candidate_id', $candidate_id)->exists() && CandidateRecommendation::where('candidate_id', $candidate_id)->where('recommendation', 2)->exists()) {
                CandidateRecommendation::where('candidate_id', $candidate_id)->delete();
            }
            $recommendation->recommendation_from_whom_id = $data['data']->recommendation_whom->id;
            $recommendation->name_ka = $data['data']->name_ka;
            $recommendation->name_en = $data['data']->name_en;
            $recommendation->name_ru = $data['data']->name_ru;
            if (isset($data['data']->position_ka)) {
                $recommendation->position_ka = $data['data']->position_ka;
                $recommendation->position_en = $data['data']->position_en;
                $recommendation->position_ru = $data['data']->position_ru;
            }
            $recommendation->number_code_id = $data['data']->number_code->id;
            $recommendation->number = $data['data']->number;
            if (isset($data['file'])) {
                $filePath = $data['file']->store('user_documentation', 'public');
            }
            if (isset($filePath)) {
                $recommendation->file_path = $filePath;
                $recommendation->file_name = $data['data']->file_name;
            }
        }else{
            if (CandidateRecommendation::where('candidate_id', $candidate_id)->exists() && CandidateRecommendation::where('candidate_id', $candidate_id)->where('recommendation', 1)->exists()) {
                CandidateRecommendation::where('candidate_id', $candidate_id)->delete();
            }
            $recommendation->no_reason_id = $data['data']->no_reason->id;
            if (isset($data['data']->no_reason_info_ka)) {
                $recommendation->no_reason_info_ka = $data['data']->no_reason_info_ka;
                $recommendation->no_reason_info_en = $data['data']->no_reason_info_en;
                $recommendation->no_reason_info_ru = $data['data']->no_reason_info_ru;
            }

        }
        $this->candidateStatusUpdate($candidate_id);

        $recommendation->save();
        // if (Auth::user()->role_id == 3) {
        //     $this->userStatusUpdate(Auth::id());
        // }
        return CandidateRecommendation::where('id', $recommendation->id)->with(['recommendationWhom', 'numberCode', 'noReason', 'hasRecommendation'])->first();
    }

    function update($data)  {
        // dd($data);

        $data = $this->translate('ka',$data);
        $candidate_id = $data['data']->candidate_id ? $data['data']->candidate_id :Auth::user()->candidate->id;
        $recommendation = CandidateRecommendation::findOrFail($data['data']->id);
        if ($data['data']->has_recommendation->id == 1) {
            if (CandidateRecommendation::where('candidate_id', $candidate_id)->exists() && CandidateRecommendation::where('candidate_id', $candidate_id)->where('recommendation', 2)->exists()) {
                CandidateRecommendation::where('candidate_id', $candidate_id)->delete();
            }
            $recommendation->recommendation_from_whom_id = $data['data']->recommendation_whom->id;
            $recommendation->name_ka = $data['data']->name_ka;
            $recommendation->name_en = $data['data']->name_en;
            $recommendation->name_ru = $data['data']->name_ru;
            if (isset($data['data']->position_ka)) {
                $recommendation->position_ka = $data['data']->position_ka;
                $recommendation->position_en = $data['data']->position_en;
                $recommendation->position_ru = $data['data']->position_ru;
            }
            $recommendation->number_code_id = $data['data']->number_code->id;
            $recommendation->number = $data['data']->number;
            if (isset($data['file'])) {
                Storage::disk('public')->delete($data['data']->file);
                $filePath = $data['file']->store('user_documentation', 'public');
            }
            if (isset($filePath)) {
                $recommendation->file_path = $filePath;
                $recommendation->file_name = $data['data']->file_name;
            }
        }else{
            if (CandidateRecommendation::where('candidate_id', $candidate_id)->exists() && CandidateRecommendation::where('candidate_id', $candidate_id)->where('recommendation', 1)->exists()) {
                CandidateRecommendation::where('candidate_id', $candidate_id)->delete();
            }
            $recommendation->no_reason_id = $data['data']->no_reason->id;
            if (isset($data['data']->no_reason_info_ka)) {
                $recommendation->no_reason_info_ka = $data['data']->no_reason_info_ka;
                $recommendation->no_reason_info_en = $data['data']->no_reason_info_en;
                $recommendation->no_reason_info_ru = $data['data']->no_reason_info_ru;
            }

        }

        $recommendation->update();

    }

    public function candidateStatusUpdate($candidate_id)
    {
        $candidate = Candidate::find($candidate_id);
        if ($candidate->status_id == 8) {
            $candidate->update([
                'status_id' => 9,
                'updated_at' => now()
            ]);
        }
    }

}
