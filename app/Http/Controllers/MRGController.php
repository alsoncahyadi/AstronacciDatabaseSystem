<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use App\MRG;
use DB;

class MRGController extends Controller
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
    //
    public function getTable() {
        //Select seluruh tabel
        //$mrgs = MRG::all();
        $mrgs = DB::select("call select_mrg()");
        //dd($mrgs);

        //Data untuk insert
        $ins = ["Account", "Nama", "Tanggal Join", "Alamat", "Kota", "Telepon", "Email", "Type", "Sales"];

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["PC ID", "Account", "Fullname", "Email", "No HP", "Birthdate", "Line ID", "BB Pin", "Twitter", "Alamat", "Kota", "Marital Status", "Jenis Kelamin", "No Telepon", "Provinsi", "Facebook", "Tanggal Join", "Type", "Sales"]; //semua kecuali yg is"an dan add_time

        //Nama attribute pada sql
        $atts = ["all_pc_id", "account", "fullname", "email", "no_hp", "birthdate", "line_id", "bb_pin", "twitter", "address", "city", "marital_status", "jenis_kelamin", "no_telp", "provinsi", "facebook", "join_date", "type", "sales_username"]; 
        foreach ($mrgs as $mrg) {
            $mrg->is_UOB = $mrg->is_UOB ? "Yes" : "No";
            $mrg->is_cat = $mrg->is_cat ? "Yes" : "No";
            $mrg->is_mrg_premiere = $mrg->is_mrg_premiere ? "Yes" : "No";
            $mrg->is_aclub_stock = $mrg->is_aclub_stock ? "Yes" : "No";
            $mrg->is_aclub_future = $mrg->is_aclub_future ? "Yes" : "No";
            foreach ($atts as $att) {
                if (!$mrg->$att) $mrg->$att = "-";
            }
        }
        return view('content\table', ['route' => 'MRG', 'clients' => $mrgs, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins]);
    }

    public function clientDetail($id) {
        //Select seluruh data client $id yang ditampilkan di detail
        $mrg = DB::select("select * from master_client INNER JOIN mrg on (master_client.all_pc_id = mrg.all_pc_id) where master_client.all_pc_id = ?", [$id]);
        $mrg = $mrg[0];
        $ins = ["Account" => "account", "Fullname" => "fullname", "Email" => "email", "No HP" => "no_hp", "Birthdate" =>"birthdate", "Line ID" => "line_id", "BB Pin" => "bb_pin", "Twitter" => "twitter", "Alamat" => "address", "Kota" => "city", "Marital Status" => "marital_status", "Jenis Kelamin" => "jenis_kelamin", "No Telepon" => "no_telp", "Provinsi" => "provinsi", "Facebook" => "facebook", "Tanggal Join" => "join_date", "Type" => "type", "Sales" => "sales_username"];
        $heads = ["PC ID" => "all_pc_id"] + $ins;

        //$atts = ["all_pc_id", "fullname", "email", "no_hp", "birthdate", "line_id", "bb_pin", "twitter", "address", "city", "marital_status", "jenis_kelamin", "no_telp", "provinsi", "facebook", "account", "join_date", "type", "sales_username"];
        echo $mrg->all_pc_id;
        return view('profile\profile', ['route'=>'MRG', 'client'=>$mrg, 'heads'=>$heads, 'ins'=>$ins]);
    }

    public function editClient(Request $request) {
        $this->validate($request, [
                'account' => 'required',
                'fullname' => 'required',
                'join_date' => 'required',
                'address' => 'required',
                'city' => 'required',
                'no_telp' => 'required',
                'email' => 'required|email',
                'type' => 'required',
                'sales_username' => 'required'
            ]);
        echo $request->all_pc_id;
        echo ("call edit_mrg(".$request->all_pc_id. $request->account. $request->join_date. $request->type. $request->sales_username);
        $err = [];
        try {
            DB::select("call edit_master_client(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->all_pc_id, $request->fullname, $request->email, $request->no_hp, $this->nullify($request->birthdate), $request->line_id, $request->bb_pin, $request->twitter, $request->address, $request->city, $request->marital_status, $request->jenis_kelamin, $request->no_telp, $request->provinsi, $request->facebook]);
            DB::select("call edit_mrg(?,?,?,?,?)", [$request->all_pc_id, $request->account, $request->join_date, $request->type, $request->sales_username]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        return redirect(route('dashboard'))->withErrors($err);
        //return redirect()->back()->withErrors($err);
    }

    public function addClient(Request $request) {
        //Insert
        $this->validate($request, [
                'account' => 'required',
                'nama' => 'required',
                'tanggal_join' => 'required',
                'alamat' => 'required',
                'kota' => 'required',
                'telepon' => 'required',
                'email' => 'required|email',
                'type' => 'required',
                'sales' => 'required'
            ]);
        //input ke database
        //DB::select("call inputMRG($request->account,'$request->nama',$request->tanggal_join,'$request->address','$request->kota','$request->telepon','$request->email','$request->type','$request->sales')");
        $err = [];
        try {
            DB::select("call inputMRG(?,?,?,?,?,?,?,?,?)", [$request->account, $request->nama,$request->tanggal_join,$request->alamat,$request->kota,$request->telepon,$request->email,$request->type,$request->sales]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        return redirect(route('dashboard'))->withErrors($err);
    }

    public function importExcel() {
        $err = [];
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
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

                //Jika tidak ada error, import
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        echo $value->account . ' ' . $value->nama . ' ' . $value->tanggal_join . ' ' . $value->alamat . ' ' . $value->kota . ' ' . $value->telepon . ' ' . $value->email . ' ' . $value->type . ' ' . $value->sales . ' ' . "<br/>";
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


        //foreach ($err as $er) 
        //    echo $er . "<br/>";
        return redirect()->back()->withErrors([$err]);
    }

    public function exportExcel() {
        $data = DB::select("call select_mrg()");
        $array = [];
        $heads = ["PC ID" => "all_pc_id", "Account" => "account", "Fullname" => "fullname", "Email" => "email", "No HP" => "no_hp", "Birthdate" =>"birthdate", "Line ID" => "line_id", "BB Pin" => "bb_pin", "Twitter" => "twitter", "Alamat" => "address", "Kota" => "city", "Marital Status" => "marital_status", "Jenis Kelamin" => "jenis_kelamin", "No Telepon" => "no_telp", "Provinsi" => "provinsi", "Facebook" => "facebook", "Tanggal Join" => "join_date", "Type" => "type", "Sales" => "sales_username"];
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
