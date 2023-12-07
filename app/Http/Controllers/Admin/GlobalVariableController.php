<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GlobalVariable;
use Illuminate\Http\Request;

class GlobalVariableController extends Controller
{
    function index() {
        $data = GlobalVariable::all();
        return view('admin.global_variable', compact('data'));
    }

    function update(Request $request) {
        $data = $request->model;
        // dd($data);
        try {
            $global = GlobalVariable::findOrFail($data['id']);
            $global->description = $data['description'];
            $global->meaning = $data['meaning'];
            $global->update();

        } catch (\Throwable $th) {
            //throw $th;
        }

        return response()->json($global);
    }

}
