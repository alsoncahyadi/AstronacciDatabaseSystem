<?php

namespace App\Http\Controllers;

use App\MasterClient;
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

    public function index()
    {
        $clients = MasterClient::select('name','email','master_id')->get();
        return view('dashboard/dashboard', ['clients' => $clients] );
    }


    public function indexAShop()
    {
        $clients = MasterClient::select('name','email','master_id')->get();
        return view('dashboard/ashop', ['clients' => $clients] );
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

}

