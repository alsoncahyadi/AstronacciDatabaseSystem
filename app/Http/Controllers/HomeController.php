<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->hasRole((\Auth::user()->username), '1')) {
			// return view on aclub
		}
        return view('dashboard\dashboard');
    }
	public function index2()
	{
		return view('dashboard\dashboard2');
    }
}

