<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;
use App\AshopTransaction;
use App\MasterClient;

class AshopController extends Controller
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
        $master = MasterClient::all();

        $heads= ["Master ID",
                "Redclub User ID",
                "Name",
                "Telephone",
                "Email",
                "Birthdate",
                "Address",
                "City",
                "Province",
                "Gender",
                "Status",
                "Keterangan",
                "Created At",
                "Updated At",
                "Created By",
                "Updated By"];

        $atts = ["master_id",
                "redclub_user_id",
                "name",
                "telephone_number",
                "email",
                "birthdate",
                "address",
                "city",
                "province",
                "gender",
                "status",
                "keterangan",
                "created_at",
                "updated_at",
                "created_by",
                "updated_by"];

        return view('content/table', ['route' => 'AShop', 'clients' => $master, 'heads'=>$heads, 'atts'=>$atts]);
    }

    public function clientDetail($id) {
        $master = MasterClient::find($id);

        //judul + sql
        $ins= ["Master ID" => "master_id",
                ];
        $heads = $ins;

        $clientsreg = $master->ashopTransactions()->get();

        //form transaction
        $insreg = [ "Product Type",
                    "Nama Product",
                    "Nominal"
                    ];

        //transaction
        $headsreg = [ "Product Type",
                    "Nama Product",
                    "Nominal"
                    ];

        $attsreg = ["product_type", "product_name", "nominal"];

        return view('profile/profile', ['route'=>'AShop', 'client'=>$master, 'heads'=>$heads, 'ins'=>$ins, 'insreg'=>$insreg, 'headsreg'=>$headsreg, 'clientsreg' => $clientsreg, 'attsreg' => $attsreg]);
    }

    public function clientDetailTrans($id, $trans) {

        $ashop = AshopTransaction::where('transaction_id', $trans)->first();

        $heads = ["Transaction ID" => "transaction_id",
                    "Master ID" => "master_id",
                    "Product" => "product_type",
                    "Nama Product" => "product_name",
                    "Nominal" => "nominal"];

        $ins = ["Product" => "product_type",
                "Nama Product" => "product_name",
                "Nominal" => "nominal"];
        //dd($aclub_transaction);

        return view('profile/ashoptransaction', ['route'=>'AShop', 'client'=>$ashop, 'ins'=>$ins, 'heads'=>$heads]);
    }

    public function editTrans(Request $request) {
        //Validasi input
        $this->validate($request, [
                'transaction_id' => '',
                'master_id' => '',
                'product' => '',
                'nama_product' => '',
                'nominal' => ''
            ]);
        $ashop = AshopTransaction::where('transaction_id',$request->user_id)->first();
        //Inisialisasi array error
        $err = [];

        try {
            $ashop->transaction_id = $request->user_id;
            $ashop->master_id = $request->master_id;
            $ashop->product_type = $request->product;
            $ashop->product_name = $request->nama_product;
            $ashop->nominal = $request->nominal;

            $ashop->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect()->back()->withErrors($err);
    }

     public function deleteTrans($id) {
        //Menghapus client dengan ID tertentu
        try {
            $ashop = AshopTransaction::find($id);
            $ashop->delete();
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        return redirect("home");
    }

    public function addTrans(Request $request) {
        $this->validate($request, [
                'product_type' => '',
                'nama_product' => '',
                'nominal' => ''
            ]);

        $ashop = new \App\AshopTransaction();

        $err = [];

        $ashop->master_id = $request->user_id;
        $ashop->product_type = $request->product_type;
        $ashop->product_name = $request->nama_product;
        $ashop->nominal = $request->nominal;

        $ashop->save();
        
        return redirect()->back()->withErrors($err);
    }

    public function addTrans(Request $request) {
        $this->validate($request, [
                'user_id' => '',
                'product_type' => '',
                'product_name' => '',
                'nominal' => ''
            ]);

        $ashop = new \App\AshopTransaction();

        $err = [];

        $ashop->master_id = $request->user_id;
        $ashop->product_type = $request->product_type;
        $ashop->product_name = $request->product_name;
        $ashop->nominal = $request->nominal;

        $ashop->save();
        
        return redirect()->back()->withErrors($err);
    }

    public function getTransactions($id) {
        $ashop_transactions = AshopTransaction::where('master_id', $id)->first();
        dd($ashop_transactions);
    }

    public function ashopDetail($id) {
        $master = MasterClient::find($id);
        $ashop = AshopTransaction::where('master_id', $id)->first();

        //judul + sql
        $ins= ["User ID" => "user_id",
                "Nomor Induk" => "nomor_induk",
                "Batch" => "batch",
                "Sales" => "sales_name",
                ];
        $heads = $ins;

        //form transaction
        $insreg = ["Transaction ID",
                    "Product Type",
                    "Product Name",
                    "Nominal"
                    ];

        //transaction
        $headsreg = [ "Transaction ID" => 'transation_id',
                        "Product Type" => "product_type",
                        "Product Name" => 'product_name',
                        "Nominal" => 'nominal'
                    ];

        return view('profile/profile', ['route'=>'AShop', 'client'=>$ashop, 'heads'=>$heads, 'ins'=>$ins, 'insreg'=>$insreg, 'headsreg'=>$headsreg]);
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