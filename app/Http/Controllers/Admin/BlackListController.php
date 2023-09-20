<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blacklist;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\BlacklistGround;
use App\Models\QualifyingCandidate;
use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;

class BlackListController extends Controller
{
    function getInfo(Request $request)  {
        $req = $request->data;
        // dd($req);
        $data = [];
        if ($req['type'] == 'candidate') {
            $checkQualifying = QualifyingCandidate::where('candidate_id', $req['id'])
                ->whereIn('qualifying_type_id', [3, 5])
                ->whereHas('vacancy', function ($query) {
                    return $query->where('status_id', 2);
                })
                ->with(['qualifyingType', 'vacancy'])
                ->get();
            $data['check'] = $checkQualifying;
        }else if($req['type'] == 'employer'){
            $data['check']  = Vacancy::where('author_id', $req['id'])->whereNotIn('status_id', [5, 13])->select('code', 'id', 'status_id')->with('status')->get();
        }
        $data['cla'] = BlacklistGround::all()->toArray();
        return response()->json($data);
    }

    function addBlackList(Request $request) {
        $data = $request->model;
        $blackList = new Blacklist();
        if ($request->type == 'candidate') {
            $candidate = Candidate::where('id', $data['id'])->first();
            $blackList->user_id = $candidate->user->id;
            $candidate->update(['status_id' => 12]);
        }else if($request->type == 'employer'){
            $blackList->employer_id = $data['id'];
        }
        $blackList->ground_id = $data['reason']['id'];
        $blackList->author_id = Auth::id();
        $blackList->save();
        return response()->json($blackList);
    }
}
