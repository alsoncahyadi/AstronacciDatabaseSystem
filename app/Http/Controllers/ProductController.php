<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;

class ProductController extends Controller
{
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
       $products = DB::select("SELECT * FROM product");
        //dd($mrgs);

        //Data untuk insert
       $ins = ["Product Name"];

        // "Registration Date", "Kode Paket",  "Sales", "Registration Type", "Start Date", "Bulan Member", "Bonus Member", "Sumber Data", "Broker", "Message", "Keterangan", "Jenis", "Nominal Member", "Percentage", "Paid", "Paid Date", "Debt", "Frekuensi"

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["Product ID", "Product Name"]; //kecuali is"an dan add_time

        //Nama attribute pada sql
        $atts = ["product_id", "product_name"];
        return view('content\table', ['route' => 'product', 'clients' => $products, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins]);
    }

    

    public function addClient(Request $request) {
       $this->validate($request, [
            ]);

        //echo $request;
        DB::beginTransaction();
        $err = [];
        $username = \Auth::user()->username;
        try {
            DB::select("call input_product(?)", [$this->nullify($request->product_name)]);
            DB::select("call add_username_to_log(?)", [$username]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            $err[] = $ex->getMessage();
        }
        DB::commit();
        return redirect()->back()->withErrors($err);

    }

   
}