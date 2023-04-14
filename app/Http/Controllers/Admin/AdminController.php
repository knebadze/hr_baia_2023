<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
   public function index()
   {
        return view('admin');
   }
   public function login(Request $request)
   {
       $request->validate([
           'email' => 'required',
           'password' => 'required',
       ]);

       $credentials = $request->only('email', 'password');
       if (Auth::attempt($credentials)) {
           return redirect()->intended('ka/admin/dashboard')
                       ->withSuccess('Signed in');
       }

       return redirect("admin")->withSuccess('Login details are not valid');
   }
   public function dashboard()
   {
       if(Auth::check()){
           return view('admin.dashboard');
       }

       return redirect("admin")->withSuccess('are not allowed to access');
   }
}
