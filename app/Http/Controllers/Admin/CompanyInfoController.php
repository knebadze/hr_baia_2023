<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CompanyInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class CompanyInfoController extends Controller
{
    function index() {
        $data = Cache::get('company_information');
        if ($data === null) {
            // If cache is null, fetch data from database and cache it
            $companyInformation = CompanyInformation::first();

            if ($companyInformation !== null) {
                $data = Cache::forever('company_information', $companyInformation);
            }
        }
        $coordinatesJson_1 = $data->location_1;
        if ($coordinatesJson_1) {
            $coordinates_1 = json_decode($coordinatesJson_1, true);
            $data['lat_1'] = $coordinates_1['lat'];
            $data['long_1'] = $coordinates_1['long'];
        }
        $coordinatesJson_2 = $data->location_2;
        if ($coordinatesJson_2) {
            $coordinates_2 = json_decode($coordinatesJson_2, true);
            $data['lat_2'] = $coordinates_2['lat'];
            $data['long_2'] = $coordinates_2['long'];
        }
        return view('admin.company_info', compact('data'));
    }

    function update(Request $request) {
        $location_1 = [
            'lat' => $request->lat_1,
            'long' => $request->long_1
        ];
        $location_2 = [
            'lat' => $request->lat_2,
            'long' => $request->long_2
        ];
        $data = CompanyInformation::first();
        $data->number = $request->number;
        $data->inside_number = $request->inside_number;
        $data->address_1 = $request->address_1;
        $data->address_2 = $request->address_2;
        $data->number = $request->number;
        $data->location_1 = json_encode($location_1);
        $data->location_2 = json_encode($location_2);
        $data->fb_link = $request->fb_link;
        $data->tw_link = $request->tw_link;
        $success = $data->update();

        if ($success) {
            Cache::forever('company_information', $data);
            return redirect()->back()->with('success', 'წარმატებით განახლდა');
        } else {
            return redirect()->back()->with('error', 'დაფიქსირდა შეცდომა');
        }

    }
}
