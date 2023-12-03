<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmsTemplate;
use Illuminate\Http\Request;
use LDAP\Result;

class SmsPageController extends Controller
{
    function index() {
        $templates = SmsTemplate::all();
        return view('admin.sms_template', compact('templates'));
    }

    function update(Request $request) {

        $model = $request->model;
        $template = SmsTemplate::where('id', $model['id'])->first();
        $template->template_ka = $model['template_ka'];
        $template->template_ka_lt = $model['template_ka_lt'];
        $template->template_en = $model['template_en'];
        $template->template_ru = $model['template_ru'];
        $template->active = $model['active'];
        $template->update();
        return response()->json($template);
    }
}
