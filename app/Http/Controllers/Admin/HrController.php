<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Branch;
use App\Models\HrHasVacancy;
use Illuminate\Http\Request;
use App\Services\Admin\HrService;
use App\Traits\HrHasVacancyTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\Admin\StaffResource;

class HrController extends Controller
{
    protected $hrService;
    use HrHasVacancyTrait;

    public function __construct(HrService $hrService)
    {
        $this->hrService = $hrService;
    }
    public function index()
    {
        return view('admin.hr');
    }

    function fetchData()
    {
        try {
            $hrs = User::orderBy('id', 'DESC')->where('role_id', 2)->with('staff')->get();
            $data["staff"] = StaffResource::collection($hrs);
            $data['cla'] = Cache::rememberForever('branches', function () {
                return Branch::select('id', 'name')->get()->toArray();
            });
            $hasVacancyControl = $this->getHasVacancyControl()['hasVacancyControl'];
            $data['hasVacancyControl'] = $hasVacancyControl;
        } catch (Exception $e) {
            $data = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($data);
    }

    // public function store(Request $request)
    // {
    //     $data = $request->all();
    //     try {
    //         $result = $this->hrService->addHr($data);
    //     } catch (Exception $e) {
    //         $result = [
    //             'status' => 500,
    //             'error' => $e->getMessage()
    //         ];
    //     }

    //     return response()->json($result);
    // }

    // public function isActiveUpdate(Request $request)
    // {
    //     $user = User::where('id', $request->id)->first();
    //     User::where('id', $request->id)->update(['is_active' => $request->is_active]);
    //     HrHasVacancy::where('hr_id', $request->hr_id)->update(['is_active' => $request->is_active]);
    //     $result = ($user->is_active == 1)?$user->name_ka.' არააქტიურია':$user->name_ka.' აქტიურია';
    //     return response()->json($result);
    // }

    // public function update(Request $request)
    // {
    //     $data = $request->all();
    //     try {
    //         $result = $this->hrService->updateHr($data);
    //     } catch (Exception $e) {
    //         $result = [
    //             'status' => 500,
    //             'error' => $e->getMessage()
    //         ];
    //     }

    //     return response()->json($result);
    // }

    function getHr(Request $request) {
        try {
            $result = User::where('role_id', 2)->with('hr')->get();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }
}
