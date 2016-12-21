<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AClubController extends Controller
{
    //
    public function index() {
        return view('dashboard\dashboard');
    }
	public function index1() {
        return view('dashboard\dashboard1');
    }

    public function getTable() {
        $tab = "<tr><td>aaa</td></tr><tr><td>bbb</td></tr>";
        return $tab;
    }
}
