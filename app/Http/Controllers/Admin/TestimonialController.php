<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Services\Admin\TestimonialService;

class TestimonialController extends Controller
{
    //

    private TestimonialService $testimonialService;
    public function __construct(TestimonialService $testimonialService)
    {

        $this->testimonialService = $testimonialService;
    }

    function index(){
        $testimonial = Testimonial::all()->toArray();
        // dd($testimonial);
        return view('admin.testimonial', compact('testimonial'));
    }

    function create(Request $request) {
        $data['data'] = json_decode($request->input('data'));
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file');
        }
        // dd($data);
        $result = ['status' => 200];

        try {
            $result['data'] = $this->testimonialService->save($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function translate(Request $request) {
        $data = $request->model;
        // dd($data);
        $result = $this->testimonialService->translate('ka', $data);
        return response()->json($result);
    }

    function IsActiveUpdate(Request $request) {
        // dd($request->is_active);
        try {
            $result = Testimonial::where('id', $request->id)->update(['active' => $request->active]);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return response()->json($result);
    }

    function update(Request $request) {

        $data['data'] = json_decode($request->input('data'));
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file');
        }
        // dd($data);
        try {
            $result = $this->testimonialService->update($data);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return response()->json($result);
    }

    function delete(Request $request) {

       $data = $request->id;
        // dd($data);
        try {
            $result = $this->testimonialService->delete($data);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return response()->json($result);
    }
}
