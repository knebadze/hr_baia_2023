<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\HrHasVacancy;
use Illuminate\Http\Request;
use App\Services\Admin\HrService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HrController extends Controller
{
    protected $hrService;

    public function __construct(HrService $hrService)
    {
        $this->hrService = $hrService;
    }
    public function index()
    {
        $hr = User::orderBy('id', 'DESC')->where('role_id', 2)->with('hr')->get();
        $hasVacancyControl = DB::table('hr_has_vacancies as a')->orderBy('a.id', 'DESC')
            ->join('hrs as b', 'a.hr_id', 'b.id')
            ->join('users as c', 'b.user_id', 'c.id')
            ->select('a.*', 'c.name_ka as hr_name')
            ->get();
        $data["hr"] = $hr;
        $data['hasVacancyControl'] = $hasVacancyControl;
        return view('admin.hr', compact('data'));
    }
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $result = $this->hrService->addHr($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function isActiveUpdate(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        User::where('id', $request->id)->update(['is_active' => $request->is_active]);
        HrHasVacancy::where('hr_id', $request->hr_id)->update(['is_active' => $request->is_active]);
        $result = ($user->is_active == 1)?'HR '.$user->name_ka.' არააქტიურია':'HR '.$user->name_ka.' აქტიურია';
        return response()->json($result);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        try {
            $result = $this->hrService->updateHr($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

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
