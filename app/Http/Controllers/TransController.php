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
        $transactions = DB::select("SELECT * FROM product_sale natural join product");
        //dd($mrgs);

        //Data untuk insert
        $ins = ["Product ID", "Jumlah", "Total Pembayaran", "Nama Pembeli", "All PC ID", "Sales Username", "Sale Date"];

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["Purchase ID", "Product ID", "Jumlah", "Total Pembayaran", "Nama Pembeli", "All PC ID", "Sales Username", "Sale Date"]; 

        //Nama attribute pada sql
        $atts = ["purchase_id", "product_id", "jumlah", "total_pembayaran", "nama_pembeli", "all_pc_id", "sales_username", "sale_date"];
        return view('content\table', ['route' => 'trans', 'clients' => $transactions, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins]);
    }

    public function addClient(Request $request) {
        $this->validate($request, [
            'product_id' => 'required',
            'total_pembayaran' => 'required',
            ]);

        DB::beginTransaction();
        $err = [];
        $username = \Auth::user()->username;
        try {
            DB::select("call input_product_sale(?,?,?,?,?,?,?)", [$request->product_id, $this->nullify($request->jumlah), $request->total_pembayaran, $this->nullify($request->nama_pembeli), $this->nullify($request->all_pc_id), $this->nullify($request->sales_username), $this->nullify($request->sale_date)]);
            DB::select("call add_username_to_log(?)", [$username]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            $err[] = $ex->getMessage();
        }
        DB::commit();
        return redirect()->back()->withErrors($err);

    }

}