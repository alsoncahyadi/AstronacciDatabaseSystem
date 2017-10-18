<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;
use App\AshopTransaction;

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

        $this->getTransactions(100039);
        return view('content/table', ['route' => 'trans', 'prods' => $prods, 'clients' => $transactions, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins, 'sales'=>$salesusers]);
    }

    public function getTransactions($id) {
        $ashop_transactions = MasterClient::where('master_id', $id)->first()->TransController()->get();
        dd($ashop_transactions);
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
            DB::select("call input_product_sale(?,?,?,?,?,?,?,?)", [$request->product_id, $this->nullify($request->jumlah), $request->total_pembayaran, $this->nullify($request->nama_pembeli), $this->nullify($request->all_pc_id), $this->nullify($request->sales), $this->nullify($request->sale_date), $username]);
            DB::select("call add_username_to_log(?)", [$username]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            $err[] = $ex->getMessage();
        }
        DB::commit();
        return redirect()->back()->withErrors($err);

    }

}