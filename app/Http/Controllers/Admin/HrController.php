<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Staff;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Traits\HrHasVacancyTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\Admin\StaffResource;
use App\Traits\HandlesAdminDataViewCaching;

class HrController extends Controller
{
    use HrHasVacancyTrait, HandlesAdminDataViewCaching;

    public function index()
    {
        return view('admin.hr');
    }

    function fetchData()
    {
        try {
            $adminViewAndPermission = $this->getAdminDataViewByKeyAndUserId('HR');
            $checkView = $adminViewAndPermission->view == 'child';
            // return response()->json($checkView);
            $hrs = Staff::orderBy('id', 'DESC')
                ->where('role_id', 2)
                ->when($checkView, function ($query) {
                    return $query->where('parent_id', auth()->guard('staff')->id());
                })->get();
            $data["staff"] = StaffResource::collection($hrs);
            $data['cla'] = Cache::rememberForever('branches', function () {
                return Branch::select('id', 'name')->get()->toArray();
            });
            $hasVacancyControl = $this->getHasVacancyControl($checkView)['hasVacancyControl'];
            $data['hasVacancyControl'] = $hasVacancyControl;
            $data['adminViewAndPermission'] = $adminViewAndPermission;
        } catch (Exception $e) {
            $data = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($data);
    }

    function getHr(Request $request) {
        try {
            $result = Staff::where('parent_id', Auth::guard('staff')->id())->where('role_id', 2)->whereNot('is_active', 2)->get();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }
}
