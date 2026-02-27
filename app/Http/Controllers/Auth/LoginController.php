<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        $userRoles = Auth::user()->roles->pluck('id')->toArray();

        if (in_array(1, $userRoles)) {
            return '/admin-dashboard';
        } elseif (in_array(2, $userRoles)) {
            return '/operator-dashboard';
        } elseif (in_array(3, $userRoles)) {
            return '/dorm-manager-dashboard';
        } elseif (in_array(4, $userRoles)) {
            return '/uhrc-dashboard';
        } elseif (in_array(5, $userRoles)) {
            return '/osa-dashboard';
        } elseif (in_array(6, $userRoles)) {
            return '/assoc-dashboard';
        } elseif (in_array(7, $userRoles)) {
            return '/employee-dashboard';
        } else {
            return $this->redirectTo;
        }
    }
}
