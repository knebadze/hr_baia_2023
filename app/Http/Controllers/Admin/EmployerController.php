<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vacancy;
use App\Models\Employer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Filters\Employer\EmployerFilters;
use App\Traits\HandlesAdminDataViewCaching;
use Stichoza\GoogleTranslate\GoogleTranslate;

class EmployerController extends Controller
{
    use HandlesAdminDataViewCaching;

    function index() {

        return view('admin.employer');
    }

    function fetch(Request $request) {
        list($authId, $childView, $adminViewAndPermission) = $this->viewAndPermission('Employer');
        $query = Employer::orderBy('id', 'DESC');
        $total = $query->count();
        $employer = $query->paginate(20)->toArray();
        $data = [
            'total' => $total,
            'employer' => $employer,
            'adminViewAndPermission' => $adminViewAndPermission,
        ];
        return response()->json($data);
    }

    function filter(EmployerFilters $filters) {
        $query = Employer::filter($filters)
            ->orderBy('id', 'DESC');
        $total = $query->count();
        $employer = $query->paginate(20)->toArray();
        $data = [
            'total' => $total,
            'employer' => $employer
        ];
        return response()->json($data);
    }
    public function translate($data)
    {
            $data['name_en'] = GoogleTranslate::trans($data['name_ka'], 'en');
            $data['name_ru']  = GoogleTranslate::trans($data['name_ka'], 'ru');

            $data['address_en'] = GoogleTranslate::trans($data['address_ka'], 'en');
            $data['address_ru']  = GoogleTranslate::trans($data['address_ka'], 'ru');
        return $data;
    }

    private function viewAndPermission($type){
        $auth = Auth::guard('staff')->user();
        $authId = $auth->id;
        $role_id = $auth->role_id;
        $childView = false;
        $adminViewAndPermission = [];
        if ($role_id == 1) {
            $adminViewAndPermission = $this->getAdminDataViewByKeyAndUserId($type);
            $childView = $adminViewAndPermission->view == 'child';
        }
        return [$authId, $childView, $adminViewAndPermission];
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
                'employer.numberCode','deposit','hr', 'vacancyDrivingLicense'
                ])
            ->get();


        return view( 'admin.employer_vacancy', compact('data'));
    }

    function destroy($id) {
        // dd($id);
        $employer = Employer::find($id);
        if (Vacancy::where('author_id', $id)->whereNotIn('status_id', [5, 13])->exists()) {
            return response()->json(['type' => 'e', 'message' => 'წაშლა ვერ ხერხდება, რადგან არსებობს ვაკანსიები რომლებიც არ დასრულებულა']);
        }
        $employer->delete();
        return response()->json(['type' => 's', 'message' => 'წაიშალა']);

    }

}
