<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Excel;
use App\MasterClient;

class DetailController extends Controller
{
    //
    private function nullify($string)
    {
        $newstring = trim($string);
        if ($newstring === ''){
           return null;
        }
        return $newstring;
    }

    public function clientDetail($id) {
        //Select seluruh data client $id yang ditampilkan di detail
        $master = MasterClient::where('master_id', $id)->first();

        //Nama atribut form yang ditampilkan dan nama pada SQL
        $ins= ["Master ID"=> "master_id",
                "Redclub User ID" => "redclub_user_id",
                "Name" => "name",
                "Telephone" => "telephone_number",
                "Email" => "email",
                "Birthdate" => "birthdate",
                "Address" => "address",
                "City" => "city",
                "Province" => "province",
                "Gender" => "gender",
                "Status" => "status",
                "Keterangan" => "keterangan",
                "Created At" => "created_at",
                "Updated At" => "updated_at",
                "Created By" => "created_by",
                "Updated By" => "updated_by"];
        //Untuk input pada database, ditambahkan PC ID yang tidak ada pada form
        $heads = $ins;
        $insreg = ["Cuki"];
        //dd($cat);   
		return view('profile/pcdetail', ['route'=>'CAT', 'client'=>$master, 'heads'=>$heads, 'ins'=>$ins, 'insreg'=>$insreg]);
    }

}
