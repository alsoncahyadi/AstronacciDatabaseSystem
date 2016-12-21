<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CATController extends Controller
{
    //
    public function getTable() {
        $tab = ["asdf", "bsb", "adf"];
        $a = 'a';
        //return $tab['a'];
        return view('table/table', ['posts' => $tab, 'route' => 'CAT.detail']);
    }

    public function clientDetail($id) {
        echo "CAT Detail <br>";
        echo $id;
    }

    public function addClient(Request $request) {

    }
}
