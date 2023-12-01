<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vacancy;
use App\Models\Employer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\ClassificatoryService;
use App\Filters\Employer\EmployerFilters;
use Stichoza\GoogleTranslate\GoogleTranslate;

class EmployerController extends Controller
{


    function index() {
        $data = Employer::orderBy('id', 'DESC')->paginate(25)->toArray();
        return view('admin.employer', compact('data'));
    }

    function filter(EmployerFilters $filters) {

        return Employer::filter($filters)
            ->orderBy('id', 'DESC')
            ->paginate(25)
            ->toArray();
    }
    public function translate($data)
    {
            $data['name_en'] = GoogleTranslate::trans($data['name_ka'], 'en');
            $data['name_ru']  = GoogleTranslate::trans($data['name_ka'], 'ru');

            $data['address_en'] = GoogleTranslate::trans($data['address_ka'], 'en');
            $data['address_ru']  = GoogleTranslate::trans($data['address_ka'], 'ru');
        return $data;
    }
    public function update(Request $request)
    {
        try {
            $data = $this->translate($request->model);

            $affectedRows = Employer::where('id', $data['id'])
                ->update([
                    'name_ka' => $data['name_ka'],
                    'name_en' => $data['name_en'],
                    'name_ru' => $data['name_ru'],
                    'number' => $data['number'],
                    'address_ka' => $data['address_ka'],
                    'address_en' => $data['address_en'],
                    'address_ru' => $data['address_ru'],
                    'email' => $data['email'],
                ]);

            if ($affectedRows > 0) {
                // Update was successful
                return response()->json(['message' => 'წარმატებით დარედაქტირდა']);
            } else {
                // No records were updated, possibly the ID doesn't exist
                return response()->json(['message' => 'ვერ დარედაქტირდა'], 404);
            }
        } catch (\Throwable $th) {
            // An error occurred during the update
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    function attached($id) {
        $data = [];
        $data = Vacancy::orderBy('carry_in_head_date', 'DESC')
            ->where('author_id', $id)
            ->with([
                'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer', 'currency','category', 'status',
                'workSchedule', 'vacancyInterest', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty',
                'employer.numberCode','deposit','hr.user', 'vacancyDrivingLicense'
                ])
            ->get();

        // $classificatoryArr = ['workSchedule'];
        // $classificatoryService = new ClassificatoryService();
        // $classificatory = $classificatoryService->get($classificatoryArr);
        // $role_id = Auth::user()->role_id;
        // $hr_id = $role_id == 2 ? Auth::user()->hr->id : null;


        // $data = [ 'roleId' => $role_id, 'hrId' => $hr_id, 'vacancy' => $vacancy];
        //         dd($data);
        return view( 'admin.employer_vacancy', compact('data'));
    }

}
