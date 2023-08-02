<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;
use App\Models\User;

class CandidateUpdateRepository
{
    function update($data){
        $candidate = Candidate::findOrFail($data['id']);
        $candidate->update([
            'personal_number' => $data['personal_number'],
            'height' => $data['height'],
            'weight' => $data['weight'],
            'smoke' => ($data['smoke'] == true)?1:$data['smoke'],
            'convection' => ($data['convection'] == true)?1:$data['convection'],
            'work_abroad' => ($data['work_abroad'] == true)?1:$data['work_abroad'],
            'nationality_id' => $data['nationality']['id'],
            'religion_id' => $data['religion']['id'],
            'education_id' => $data['education']['id'],
            'marital_status_id' => $data['marital_status']['id'],
            'children' => $data['children'],
            'children_age' => $data['children_age'],
            'spouse' => $data['spouse'],
            'medical_info_ka' => $data['medical_info_ka'],
            'medical_info_en' => $data['medical_info_en'],
            'medical_info_ru' => $data['medical_info_ru'],
            'address_ka' => $data['address_ka'],
            'address_en' => $data['address_en'],
            'address_ru' => $data['address_ru'],
            'street_ka' => $data['street_ka'],
            'street_en' => $data['street_en'],
            'street_ru' => $data['street_ru'],
            'fb_link' => $data['fb_link'],
            'youtube_link' => $data['youtube_link'],
        ]);
        $user = User::findOrFail($data['user_id']);
        $user->update([
            'name_ka' => $data['user']['name_ka'],
            'name_en' => $data['user']['name_en'],
            'name_ru' => $data['user']['name_ru'],
            'email' =>  $data['user']['email'],
            'number' => $data['user']['number'],
            'gender_id' => $data['user']['gender']['id'],
            'date_of_birth' => $data['user']['date_of_birth'],
        ]);

        $selectCitizenship = collect($data['citizenship'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item['id'];
            return $carry;
        }, []);
        $candidate->citizenship()->sync( $selectCitizenship );

        $selectProfession = collect($data['professions'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item['id'];
            return $carry;
        }, []);
        $candidate->professions()->sync( $selectProfession );

        $selectSpecialty = collect($data['specialty'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item['id'];
            return $carry;
        }, []);
        $candidate->specialty()->sync( $selectSpecialty );

        $selectCharacteristic = collect($data['characteristic'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item['id'];
            return $carry;
        }, []);
        $candidate->characteristic()->sync( $selectCharacteristic );

        $selectAllergy = collect($data['allergy'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item['id'];
            return $carry;
        }, []);
        $candidate->allergy()->sync( $selectAllergy );

        $selectDrivingLicense = collect($data['driving_license'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item['id'];
            return $carry;
        }, []);
        $candidate->drivingLicense()->sync( $selectDrivingLicense );

    }
}
