<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use App\Mrg;
use App\MrgAccount;
use DB;

class MRGController extends Controller
{
   
    private function nullify($string)
    {
        $newstring = trim($string);
        if ($newstring === ''){
           return null;
        }
        return $newstring;
    }
    
    public function getTable() {
        $mrgs = Mrg::paginate(15);

        //ambil data master
        foreach ($mrgs as $mrg_master) {
            $master = $mrg_master->master;
            $mrg_master->redclub_user_id = $master->redclub_user_id;
            $mrg_master->redclub_password = $master->redclub_password;
            $mrg_master->name = $master->name;
            $mrg_master->telephone_number = $master->telephone_number;
            $mrg_master->email = $master->email;
            $mrg_master->birthdate = $master->birthdate;
            $mrg_master->address = $master->address;
            $mrg_master->city = $master->city;
            $mrg_master->province = $master->province;
            $mrg_master->gender = $master->gender;
            $mrg_master->line_id = $master->line_id;
            $mrg_master->bbm = $master->bbm;
            $mrg_master->whatsapp = $master->whatsapp;
            $mrg_master->facebook = $master->facebook;
        }

        //judul kolom
        $heads = ["Master ID",
                "RedClub User ID",
                "RedClub Password",
                "Nama",
                "Nomor Telepon",
                "Email",
                "Tanggal Lahir",
                "Alamat",
                "Kota",
                "Provinsi",
                "Gender",
                "Line ID",
                "BBM",
                "WhatsApp",
                "Facebook",
                "Sumber Data (MRG)",
                "Join Date (MRG)"];


        //attribute sql
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
                "facebook",
                "sumber_data",
                "join_date"];

        return view('content/table', ['route' => 'MRG', 'clients' => $mrgs, 'heads'=>$heads, 'atts'=>$atts]);
    }

    public function clientDetail($id) {
        $mrg = MRG::where('master_id', $id)->first();

        $ins= ["Sumber Data (MRG)" => "sumber_data",
                "Join Date (MRG)" => "join_date",
                "Sales" => "sales_name"];

        $heads = $ins;

        // form transaction
        $insreg = ["Account Number", "Account Type", "Sales Name"];

        $clientsreg = $mrg->accounts()->get();
        
        //kolom account
        $headsreg = ["Account Number", "Account Type", "Sales Name"];

        //attribute sql account
        $attsreg = ["accounts_number", "account_type", "sales_name"];

        return view('profile/profile', ['route'=>'MRG', 'client'=>$mrg, 'heads'=>$heads, 'ins'=>$ins, 'insreg'=>$insreg, 'clientsreg'=>$clientsreg, 'headsreg'=>$headsreg, 'attsreg'=>$attsreg]);
    }

     public function addTrans(Request $request) {
        $this->validate($request, [
                'user_id' => '',
                'account_number' => '',
                'account_type' => '',
                'sales_name' => ''
            ]);

        $mrg_account = new \App\MrgAccount();

        $err = [];

        $mrg_account->master_id = $request->user_id;
        $mrg_account->accounts_number = $request->account_number;
        $mrg_account->account_type = $request->account_type;
        $mrg_account->sales_name = $request->sales_name;

        $mrg_account->save();
        
        return redirect()->back()->withErrors($err);
    }

    public function deleteClient($id) {
        //Menghapus client dengan ID tertentu
        try {
            $mrg = Mrg::find($id);
            $mrg->delete();
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        return redirect("home");
    }
  
    public function editClient(Request $request) {
        //Validasi input
        $this->validate($request, [
                'user_id' => '',
                'sumber_data' => '',
                'join_date' => 'date'
            ]);
        //Inisialisasi array error
        $err = [];
        try {
            $mrg = Mrg::where('master_id',$request->user_id)->first();

            $err =[];

            $mrg->sumber_data = $request->sumber_data;
            $mrg->join_date = $request->join_date;

            $mrg->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect()->back()->withErrors($err);
    }

    public function clientDetailAccount($id, $account) {

        $mrg_account = MrgAccount::where('accounts_number', $account)->first();

        $heads = ["Master ID" => "master_id",
                    "Nomor Account" => "accounts_number",
                    "Type Account" => "account_type",
                    "Sales" => "sales_name"];

        $ins = ["Type Account" => "account_type",
                "Sales" => "sales_name"];

        return view('profile/mrgaccount', ['route'=>'MRG', 'client'=>$mrg_account, 'ins'=>$ins, 'heads'=>$heads]);
    }

     public function editTrans(Request $request) {
        //Validasi input
        $this->validate($request, [
                'nomor_account' => '',
                'type_account' => '',
                'sales' => ''
            ]);
        $mrg_account = MrgAccount::where('accounts_number',$request->user_id)->first();
        //Inisialisasi array error
        $err = [];

        try {
            $mrg_account->account_type = $request->type_account;
            $mrg_account->sales_name = $request->sales;

            $mrg_account->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect()->back()->withErrors($err);
    }

    public function deleteTrans($id) {
        try {
            $mrg_account = MrgAccount::find($id);
            $mrg_account->delete();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect("home");
    }

    public function importExcel() {
        $err = []; //Inisialisasi array error
        if(Input::hasFile('import_file')){ //Mengecek apakah file diberikan
            $path = Input::file('import_file')->getRealPath(); //Mendapatkan path
            $data = Excel::load($path, function($reader) { //Load excel
            })->get();
            if(!empty($data) && $data->count()){
                $i = 1;
                //Cek apakah ada error
                foreach ($data as $key => $value) {
                    $i++;
                    if (($value->account) === null) {
                        $msg = "Account empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->nama) === null) {
                        $msg = "Nama empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->tanggal_join) === null) {
                        $msg = "Tanggal Join empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->alamat) === null) {
                        $msg = "Alamat empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->kota) === null) {
                        $msg = "Kota empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->telepon) === null) {
                        $msg = "Telepon empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->email) === null) {
                        $msg = "Email empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->type) === null) {
                        $msg = "Type empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->sales) === null) {
                        $msg = "Sales empty on line ".$i;
                        //$err[] = $msg;
                    }
                } //end validasi

                //Jika tidak ada error, import dengan cara insert satu per satu
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        try { 
                          DB::select("call inputMRG(?,?,?,?,?,?,?,?,?)", [$value->account, $value->nama,$value->tanggal_join,$value->alamat,$value->kota,$value->telepon,$value->email,$value->type,$value->sales]);
                        } catch(\Illuminate\Database\QueryException $ex){ 
                          echo ($ex->getMessage()); 
                          $err[] = $ex->getMessage();
                        }
                    }
                    if (empty($err)) { //message jika tidak ada error saat import
                        $msg = "Excel successfully imported";
                        $err[] = $msg;
                    }
                }
            }
        } else {
            $msg = "No file supplied";
            $err[] = $msg;
        }

        return redirect()->back()->withErrors([$err]);
    }

    public function exportExcel() {
        $data = DB::select("call select_mrg()");
        $array = [];
        $heads = ["PC ID" => "all_pc_id", "Account" => "account", "Nama" => "fullname", "Email" => "email", "No HP" => "no_hp", "Tanggal Lahir" =>"birthdate", "Line ID" => "line_id", "BB Pin" => "bb_pin", "Twitter" => "twitter", "Alamat" => "address", "Kota" => "city", "Status Pernikahan" => "marital_status", "Jenis Kelamin" => "jenis_kelamin", "No Telepon" => "no_telp", "Provinsi" => "provinsi", "Facebook" => "facebook", "Tanggal Join" => "join_date", "Type" => "type", "Sales" => "sales_username"];
        foreach ($data as $dat) {
            $arr = [];
            foreach ($heads as $key => $value) {
                //echo $key . " " . $value . "<br>";
                $arr[$key] = $dat->$value;
            }
            $array[] = $arr;
        }
        //print_r($array);
        //$array = ['a' => 'b'];
        return Excel::create('testexportmrg', function($excel) use ($array) {
            $excel->sheet('Sheet1', function($sheet) use ($array)
            {
                $sheet->fromArray($array);
            });
        })->export('xls');
    }
}
