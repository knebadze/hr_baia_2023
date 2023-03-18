<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyRepository
{
    public function save($data)
    {
        // print_r($data);
        // exit;
        $company = Company::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'company_name_ka' => $data['company_name_ka'],
                'company_name_en' => $data['company_name_en'],
                'company_name_ru' => $data['company_name_ru'],
                'company_object_type_id' => $data['company_object_type']['id'],
                'object_type_ka' => $data['object_type_ka'],
                'object_type_en' => $data['object_type_en'],
                'object_type_ru' => $data['object_type_ru'],
                'position' => $data['position'],
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
        $this->statusUpdate();
        return $company;
    }
    public function statusUpdate()
    {
        $id = Auth::id();
        $user = User::find($id);
        if ($user->user_type_id == 3 && $user->status == 0) {
            $user->update([
                'status' => 1,
                'updated_at' => now()
            ]);
        }
    }
}
