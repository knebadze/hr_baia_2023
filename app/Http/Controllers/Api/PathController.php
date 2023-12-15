<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PathController extends Controller
{
    public function store(Request $request)
    {
        $pathName = $request->input('pathName');
        $request->session()->put('storedPathName', $pathName);

        // You can also store it in the database or elsewhere depending on your needs

        return response()->json(['message' => 'Path stored successfully']);
    }
}
