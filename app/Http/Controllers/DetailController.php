<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Excel;
use App\Cat;

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
        $cat = Cat::where('user_id', $id)->first();

        //Nama atribut form yang ditampilkan dan nama pada SQL
        $ins= ["Master ID"=> "master_id",
                "User ID" => "user_id",
                "Nomor Induk" => "nomor_induk",
                "Batch" => "batch",
                "Sales" => "sales",
                "Sumber Data" => "sumber_data",
                "DP Date" => "DP_date",
                "DP Nominal " => "DP_nominal",
                "Payment Date" => "payment_date",
                "Payment Nominal" => "payment_nominal",
                "Tanggal Opening Class" => "tanggal_opening_class",
                "Tanggal End Class"=> "tanggal_end_class",
                "Tanggal Ujian" => "tanggal_ujian",
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
		return view('profile/pcdetail', ['route'=>'CAT', 'client'=>$cat, 'heads'=>$heads, 'ins'=>$ins, 'insreg'=>$insreg]);
    }

}
