<?php

namespace App\Http\Controllers;

use App\Models\EmployeeBhApplication;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pendingRegistrationReqs = EmployeeBhApplication::where('status', 0)->where('isSeen', 0)->get();
        return view('home', compact('pendingRegistrationReqs'));
    }
}
