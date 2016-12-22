<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CATController extends Controller
{
    //
    public function getTable() {
        $cats = DB::select("call select_cat()");
        //dd($mrgs);

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["ID", "Fullname", "Username", "Tanggal Daftar"];

        //Nama attribute pada sql
        $atts = ["cat_user_id", "fullname", "cat_username", "tanggal_pendaftaran"];
        return view('table\table', ['route' => 'CAT', 'clients' => $cats, 'heads'=>$heads, 'atts'=>$atts]);
   // }
        //$tab = ["asdf", "bsb", "adf"];
        //$a = 'a';
        //return $tab['a'];
        //return view('table/table', ['posts' => $tab, 'route' => 'CAT.detail']);
    }

    public function clientDetail($id) {
        echo "CAT Detail <br>";
        echo $id;
    }

    public function addClient(Request $request) {

    }

    public function importExcel() {
        
    }
}
