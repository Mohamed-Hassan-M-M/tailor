<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function getlogin()
    {
        return view('dashboard.auth.login');
    }

    public function dologin(Request $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;
        if (auth()->guard('admin')->attempt(['email' => $request->input("email"),'password' => $request->input("password")], $remember_me)) {
            toastr()->success('You are sign in.', 'Dashboard');
            return redirect() -> route('dashboard');
        }
        toastr()->error('Error, Try another email or password.', 'Dashboard Login');
        return redirect()->back()->with(['error'=>'Try another email or password.']);
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return view('dashboard.auth.login');
    }
}
