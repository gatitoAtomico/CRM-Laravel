<?php

namespace App\Http\Controllers;

use App\Http\StaticClasses\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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
        //check if user is admin in case he tries to redirect to admin page

        if (Auth::user()->isAdmin(Roles::$Admin)) {
            return view('home');
        }

        Session::flash('error', "Permission Denied");
        return redirect()->route('transactions.index');

    }
}
