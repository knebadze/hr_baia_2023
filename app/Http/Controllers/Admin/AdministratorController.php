<?php

namespace App\Http\Controllers\Admin;

use App\Models\Staff;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\Admin\StaffResource;
use App\Traits\HandlesAdminDataViewCaching;

class AdministratorController extends Controller
{
    use  HandlesAdminDataViewCaching;
    function index() {
        return view('admin.administrator' );
    }

    function fetchData()  {
        $adminViewAndPermission = $this->getAdminDataViewByKeyAndUserId('Administrator');
        $checkView = $adminViewAndPermission->view == 'child';
        $administrators = Staff::orderBy('id', 'DESC')
            ->where('role_id', 4)
            ->when($checkView, function ($query) {
                return $query->where('parent_id', auth()->guard('staff')->id());
            })->get();
        $data["staff"] = StaffResource::collection($administrators);
        $data['cla'] = Cache::rememberForever('branches', function () {
            return Branch::select('id', 'name')->get()->toArray();
        });
        $data['adminViewAndPermission'] = $adminViewAndPermission;
        return response()->json($data);
    }
}
