<?php

namespace App\Repositories;

use App\Models\Employer;
use Illuminate\Support\Facades\Auth;

class EmployerRepository{
    public function save($data)
    {
        $employer = Employer::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'address_ka' => $data['address_ka'],
                'address_en' => $data['address_en'],
                'address_ru' => $data['address_ru'],
                'street_ka' => $data['street_ka'],
                'street_en' => $data['street_en'],
                'street_ru' => $data['street_ru'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'map_link' => $data['map_link'],
                'fb_link' => $data['fb_link'],
            ]
        );
        return $employer;
    }
}
