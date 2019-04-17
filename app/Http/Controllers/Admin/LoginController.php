<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
class LoginController extends Controller
{
	use AuthenticatesUsers;
    // public function showLoginForm() {
    // 	 return view('admin.login');
    // }
    // public function postLoginForm(Request $request) {

    // }
    protected $redirectTo = '/admin';
    public function showLoginForm() {
    	 return view('admin.auth.login');
    }

     public function logout(Request $request)
    {
        // $this->guard()->logout();

        // $request->session()->invalidate();

        // return $this->loggedOut($request) ?: redirect('admin/login');
        auth()->guard()->logout();
        session()->invalidate();
        return redirect('admin/login');
    }
}
