<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RezumeController extends Controller
{

    public function index()
    {
        $data = [];
        return view ('user.myrezume', compact('data'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
