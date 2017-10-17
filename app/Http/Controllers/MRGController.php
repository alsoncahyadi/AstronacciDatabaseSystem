<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use App\Mrg;
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
        //Select seluruh tabel
        $mrgs = Mrg::paginate(15);
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

        //Judul kolom yang ditampilkan pada tabel
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


        //Nama attribute pada sql
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

        //Return view table dengan parameter
        return view('content/table', ['route' => 'MRG', 'clients' => $mrgs, 'heads'=>$heads, 'atts'=>$atts]);
    }

    public function clientDetail($id) {
        //Select seluruh data client $id yang ditampilkan di detail
        $mrg = MRG::where('master_id', $id)->first();
        //dd($mrg);

        //$master = $mrg->master;
        //$mrg->redclub_user_id = $master->redclub_user_id;
        //$mrg->redclub_password = $master->redclub_password;
        //$mrg->name = $master->name;
        //$mrg->telephone_number = $master->telephone_number;
        //$mrg->email = $master->email;
        //$mrg->birthdate = $master->birthdate;
        //$mrg->address = $master->address;
        //$mrg->city = $master->city;
        //$mrg->province = $master->province;
        //$mrg->gender = $master->gender;
        //$mrg->line_id = $master->line_id;
        //$mrg->bbm = $master->bbm;
        //$mrg->whatsapp = $master->whatsapp;
        //$mrg->facebook = $master->facebook;

        $ins= ["Sumber Data (MRG)" => "sumber_data",
                "Join Date (MRG)" => "join_date",
                "Sales" => "sales_name"];

        $heads = $ins;

        // form transaction
        $insreg = ["Account Number", "Account Type", "Sales Name"];

        $accounts = $mrg->accounts()->get();

        // mrg accounts belom dimasukin

        //Return view profile dengan parameter
        return view('profile/profile', ['route'=>'MRG', 'client'=>$mrg, 'heads'=>$heads, 'ins'=>$ins, 'insreg'=>$insreg]);
    }

     public function addTrans(Request $request) {
        $mrg_account = new \App\MrgAccount();

        $mrg_account->master_id = $request->user_id;
        $mrg_account->accounts_number = $request->account_number;
        $mrg_account->account_type = $request->account_type;
        $mrg_account->sales_name = $request->sales_name;

        $mrg_account->save();
        
        $err = [];
        
        return redirect()->back()->withErrors($err);
    }

    public function editClient(Request $request) {
        //Validasi input
        $this->validate($request, [
        		'all_pc_id' => 'required',
                'account' => 'required',
                'fullname' => 'required',
                'address' => 'required',
                'no_hp' => 'required',
                'email' => 'email',
            ]);
        //Inisialisasi array error
        $err = [];
        DB::beginTransaction();
        try {
            //Untuk parameter yang tidak boleh null, digunakan nullify untuk menjadikan input empty string menjadi null
            //Edit atribut master client
            DB::select("call edit_master_client(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->all_pc_id, $request->fullname, $this->nullify($request->email), $request->no_hp, $this->nullify($request->birthdate), $this->nullify($request->line_id), $this->nullify($request->bb_pin), $this->nullify($request->twitter), $request->address, $this->nullify($request->city), $this->nullify($request->marital_status), $this->nullify($request->jenis_kelamin), $this->nullify($request->no_telp), $this->nullify($request->provinsi), $this->nullify($request->facebook)]);
            //Edit atribut MRG
            DB::select("call edit_mrg(?,?,?,?,?)", [$request->all_pc_id, $request->account, $this->nullify($request->join_date), $this->nullify($request->type), $this->nullify($request->sales_username)]);
        } catch(\Illuminate\Database\QueryException $ex){ 
        	DB::rollback();
            $err[] = $ex->getMessage();
        }
        DB::commit();
        return redirect()->back()->withErrors($err);
    }

    // public function addClient(Request $request) {
    //     //Validasi input
    //     $this->validate($request, [
    //             'account' => 'required',
    //             'nama' => 'required',
    //             'tanggal_join' => 'required',
    //             'alamat' => 'required',
    //             'kota' => 'required',
    //             'telepon' => 'required',
    //             'email' => 'email',
    //             'type' => 'required',
    //             'sales' => 'required'
    //         ]);
    //     //Inisialisi array error
    //     $err = [];
    //     DB::beginTransaction();
    //     try {
    //         //Input data ke SQL
    //         DB::select("call inputMRG(?,?,?,?,?,?,?,?,?)", [$request->account, $request->nama,$request->tanggal_join,$request->alamat,$request->kota,$request->telepon,$request->email,$request->type,$request->sales]);
    //     } catch(\Illuminate\Database\QueryException $ex){ 
    //     	DB::rollback();
    //         $err[] = $ex->getMessage();
    //     }
    //     DB::commit();
    //     return redirect(route('dashboard'))->withErrors($err);
    // }

    public function deleteClient($id) {
        //Menghapus client dengan ID tertentu
        try {
            DB::select("call delete_mrg(?)", [$id]);
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
