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
                "User ID Redclub",
                "Password Redclub",
                "Nama",
                "Telepon",
                "Email",
                "Tanggal Lahir",
                "Alamat",
                "Kota",
                "Provinsi",
                "Gender",
                "Line ID",
                "BBM",
                "WhatsApp",
                "Facebook"];

        $atts = ["master_id",
                "redclub_user_id",
                "redclub_password",
                "name",
                "telephone_number",
                "email",
                "birthdate",
                "address",
                "city",
                "province",
                "gender",
                "line_id",
                "bbm",
                "whatsapp",
                "facebook"];

        return view('content/table', ['route' => 'AShop', 'clients' => $master, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$heads]);
    }

    public function clientDetail($id) {
        $master = MasterClient::find($id);

        //judul + sql
        $ins= ["Red Club User ID" => "redclub_user_id",
          "Red Club Password" => "redclub_password",
          "Nama" => "name",
          "Telephone" => "telephone_number",
          "Email" => "email",
          "Tanggal Lahir" =>"birthdate",
          "Alamat" => "address",
          "Kota" => "city",
          "Provinsi" => "province",
          "Jenis Kelamin" => "gender",
          "Line ID" => "line_id",
          "BBM" => "bbm",
          "WhatsApp" => "whatsapp",
          "Facebook" => "facebook"
                ];

        $heads = ["Master ID" => "master_id",
          "Red Club User ID" => "redclub_user_id",
          "Red Club Password" => "redclub_password",
          "Nama" => "name",
          "Telephone" => "telephone_number",
          "Email" => "email",
          "Tanggal Lahir" =>"birthdate",
          "Alamat" => "address",
          "Kota" => "city",
          "Provinsi" => "province",
          "Jenis Kelamin" => "gender",
          "Line ID" => "line_id",
          "BBM" => "bbm",
          "WhatsApp" => "whatsapp",
          "Facebook" => "facebook"
                ];

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

     public function editClient(Request $request) {
         $this->validate($request, [
                'master_id' => '',
                'redclub_user_id' => '',
                'name' => '',
                'telephone_number' => '',
                'email' => '',
                'birthdate' => '',
                'address' => '',
                'city' => '',
                'province' => '',
                'gender' => '',
                'line_id' => '',
                'bbm' => '',
                'whatsapp' => '',
                'facebook' => '',
            ]);

        $err = [];

        try {
            $master = MasterClient::find($request->user_id);

            $master->redclub_user_id = $request->redclub_user_id;
            $master->name = $request->name;
            $master->telephone_number = $request->telephone_number;
            $master->email = $request->email;
            $master->birthdate = $request->birthdate;
            $master->address = $request->address;
            $master->city = $request->city;
            $master->province = $request->province;
            $master->gender = $request->gender;
            $master->line_id = $request->line_id;
            $master->bbm = $request->bbm;
            $master->whatsapp = $request->whatsapp;
            $master->facebook = $request->facebook;

            $master->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect()->back()->withErrors($err);
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
                'product_type' => '',
                'product_name' => '',
                'nominal' => ''
            ]);
        $ashop = AshopTransaction::where('transaction_id',$request->user_id)->first();
        //Inisialisasi array error
        $err = [];

        try {
            $ashop->product_type = $request->product_type;
            $ashop->product_name = $request->product_name;
            $ashop->nominal = $request->nominal;

            $ashop->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }

        if(!empty($err)) {
            return redirect()->back()->withErrors($err);
        } else {
            return redirect()->route('AShop.detail', ['id' => $ashop->master_id]);
        }
    }

     public function deleteTrans($id) {
        //Menghapus client dengan ID tertentu
        try {
            $ashop = AshopTransaction::find($id);
            $ashop->delete();
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        return back();
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

    public function deleteClient($id) {
        //Menghapus client dengan ID tertentu
        try {
            $master = MasterClient::find($id);
            $master->delete();
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        return redirect("home");
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
            'user_id_redclub' => '',
            'password_redclub' => '',
            'nama' => '',
            'telepon' => '',
            'email' => '',
            'tanggal_lahir' => '',
            'alamat' => '',
            'kota' => '',
            'provinsi' => '',
            'gender' => '',
            'line_id' => '',
            'bbm' => '',
            'whatsapp' => '',
            'facebook' => '',
            'trasaction_id' => '',
            'product_type' => '',
            'product_name' => '',
            'nominal' => ''
            ]);

        $err = [];

        try {
            $master = new \App\MasterClient;

            $master->master_id =  $request->master_id;
            $master->redclub_user_id = $request->user_id_redclub;
            $master->redclub_password = $request->password_redclub;
            $master->name = $request->nama;
            $master->telephone_number = $request->telepon;
            $master->email = $request->email;
            $master->birthdate = $request->tanggal_lahir;
            $master->address = $request->alamat;
            $master->city = $request->kota;
            $master->province = $request->provinsi;
            $master->gender = $request->gender;
            $master->line_id = $request->line_id;
            $master->bbm = $request->bbm;
            $master->whatsapp = $request->whatsapp;
            $master->facebook = $request->facebook;

            $master->save();
            
            $trans = new \App\AshopTransaction;

            $trans->transaction_id = $request->transaction_id;
            $trans->master_id =  $request->master_id;
            $trans->product_type = $request->product_type;
            $trans->product_name = $request->product_name;
            $trans->nominal = $request->nominal;

            $trans->save();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect()->back()->withErrors($err);
    }

    public function updateTrans($id)
    {
        $ashop = AshopTransaction::where('transaction_id', $id)->first();

        $ins = ["Product" => "product_type",
                "Nama Product" => "product_name",
                "Nominal" => "nominal"];
        //dd($aclub_transaction);

        return view('content/ashoptranseditform', ['route'=>'AShop', 'client'=>$ashop, 'ins'=>$ins]);
    }

}