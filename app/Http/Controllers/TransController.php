<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;

class TransController extends Controller
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
        $transactions = DB::select("SELECT * FROM product_sale");
        //dd($mrgs);

        //Data untuk insert
        $ins = ["Product ID", "Jumlah", "Total Pembayaran", "Nama Pembeli", "All PC ID", "Sales Username", "Sale Date"];

        // "Registration Date", "Kode Paket",  "Sales", "Registration Type", "Start Date", "Bulan Member", "Bonus Member", "Sumber Data", "Broker", "Message", "Keterangan", "Jenis", "Nominal Member", "Percentage", "Paid", "Paid Date", "Debt", "Frekuensi"

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["Purchase ID", "Product ID", "Product Name", "Jumlah", "Total Pembayaran", "Nama Pembeli", "All PC ID", "Sales Username", "Sale Date"]; //kecuali is"an dan add_time

        //Nama attribute pada sql
        $atts = ["purchase_id", "product_id", "product_name", "jumlah", "total_pembayaran", "nama_pembeli", "all_pc_id", "sales_username", "sale_date"];
        return view('content\table', ['route' => 'trans', 'clients' => $transactions, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins]);
   // }
        //$tab = ["asdf", "bsb", "adf"];
        //$a = 'a';
        //return $tab['a'];
        //return view('table/table', ['posts' => $tab, 'route' => 'CAT.detail']);
    }

    public function addClient(Request $request) {
        $this->validate($request, [
            ]);

        //echo $request;
        DB::beginTransaction();
        $err = [];
        try {
            DB::select("call input_product_sale(?,?,?,?,?,?,?)", [$request->product_id, $request->jumlah, $request->total_pembayaran, $request->nama_pembeli, $request->all_pc_id, $request->sales_username, $request->sale_date]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            $err[] = $ex->getMessage();
        }
        DB::commit();
        return redirect()->back()->withErrors($err);

    }

}