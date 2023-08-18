<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blacklist;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\BlacklistGround;
use App\Models\QualifyingCandidate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BlackListController extends Controller
{
    function getInfo(Request $request)  {
        $req = $request->data;
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
        }
        $data['cla'] = BlacklistGround::all()->toArray();
        return response()->json($data);
    }

    function addBlackList(Request $request) {
        // dd($request->all());
        $data = $request->model;
        $blackList = new Blacklist();
        if ($data['type'] == 'candidate') {
            $candidate = Candidate::where('id', $data['id'])->first();
            $blackList->user_id = $candidate->user->id;

        }
        $blackList->ground_id = $data['reason']['id'];
        $blackList->author = Auth::id();
        $blackList->save();
        return response()->json($blackList);
    }
}
