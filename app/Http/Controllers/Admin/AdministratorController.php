<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\Admin\StaffResource;

class AdministratorController extends Controller
{
    function index() {
        // $administrator = User::orderBy('id', 'DESC')->where('role_id', 4)->with('staff')->get();
        // $hasVacancyControl = $this->getHasVacancyControl()['hasVacancyControl'];
        // $data["staff"] = $administrator;
        // $data['hasVacancyControl'] = $hasVacancyControl;
        return view('admin.administrator' );
    }

    function fetchData()  {
        $administrators = User::orderBy('id', 'DESC')->where('role_id', 4)->with('staff')->get();
        $data["staff"] = StaffResource::collection($administrators);
        $data['cla'] = Cache::rememberForever('branches', function () {
            return Branch::select('id', 'name')->get()->toArray();
        });
        return response()->json($data);
    }
}
