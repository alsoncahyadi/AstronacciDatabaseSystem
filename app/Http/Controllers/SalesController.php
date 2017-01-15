<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;


class SalesController extends Controller
{
    //
    private function nullify($string)
    {
        $newstring = trim($string);
        if ($newstring === ''){
           return null;
        }

        //echo "masuk sini";
        return $newstring;
    }

    public function getTable() {
		//Select seluruh tabel
        $assgreen = DB::select("call select_assign_green()");
		
		$username = \Auth::user()->username;
		
		//dd($assgreen);
						
		$assgrow = DB::select("call select_assign_grow()");
		
		//dd($assgrow);
		
		//$assredclub = DB::select("call select_assign_redclub()");
		
		//dd($assredclub);

        //Data untuk insert
        $ins = ["Client", "Nama", "Class", "Nomor", "Expired", "Alamat", "Kota", "Tanggal Lahir", "Kategori", "Bulan", "Email", "Telepon",  "Bank", "Nomor Rekening", "Jenis Kelamin", "RDI Niaga", "RDI BCA", "Trading via", "Source", "Sales"];

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["PC ID", "Client ID", "Fullname", "Email", "No HP", "Birthdate", "Line ID", "BB Pin", "Twitter", "Address", "City", "Marital Status", "Jenis Kelamin", "No Telepon", "Provinsi", "Facebook", "Class", "Nomor", "Tanggal Expired", "Kategori", "Bulan", "Bank", "Nomor Rekening", "RDI Niaga", "RDI BCA", "Trading", "Source", "Sales"]; //kecuali is" an dan add_time

        //Nama attribute pada sql
        $atts = ["green_id", "client_id", "fullname", "email", "no_hp", "birthdate", "line_id", "bb_pin", "twitter", "address", "city", "marital_status", "jenis_kelamin", "no_telp", "provinsi", "facebook", "class", "nomor", "expired_date", "kategori", "bulan", "bank", "nomor_rekening", "RDI_niaga", "RDI_BCA", "trading_via", "source", "sales_username"];
        foreach ($assgrow as $mrg) {
            $mrg->is_UOB = $mrg->is_UOB ? "Yes" : "No";
            $mrg->is_cat = $mrg->is_cat ? "Yes" : "No";
            $mrg->is_mrg_premiere = $mrg->is_mrg_premiere ? "Yes" : "No";
            $mrg->is_aclub_stock = $mrg->is_aclub_stock ? "Yes" : "No";
            $mrg->is_aclub_future = $mrg->is_aclub_future ? "Yes" : "No";
            foreach ($atts as $att) {
                if (!$mrg->$att) $mrg->$att = "-";
            }
        }
		return view('content\sales', ['user'=>$username , 'clients' => $assgrow, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins]);
    }

}
