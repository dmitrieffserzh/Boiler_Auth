<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct() {
        $this->middleware('guest')->except('logout');
    }


    public function showLoginForm (Request $request) {
        if($request->ajax() && $request->method('GET')) {
            return view('auth.ajax_form');
        } else {
            return view('auth.login');
        }
    }


    public function logout() {
        Cache::forget( 'user-is-online-' . Auth::id() );
        Auth::logout();
        Session::flush();
        return redirect()->back();
    }
}