<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Excel;

class CATController extends Controller
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
        $cats = DB::select("call select_cat()");
        //dd($mrgs);

        //Data untuk insert
        $ins = ["Sales", "Batch", "User ID", "No Induk", "Pendaftaran", "Kelas Berakhir", "Nama", "Jenis Kelamin", "Email", "Telepon", "Alamat", "Kota", "Tanggal Lahir", "Username", "Password"];

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["PC ID", "CAT ID", "No Induk", "Fullname", "Email", "No HP", "Birthdate", "Line ID", "BB Pin", "Twitter", "Address", "City", "Marital Status", "Jenis Kelamin", "No Telepon", "Provinsi", "Facebook", "Username", "Password", "Batch", "Tanggal Daftar", "Tanggal Kelas Akhir", "Sales"]; //kecuali is" an, sm add_time

        //Nama attribute pada sql
        $atts = ["all_pc_id", "cat_user_id", "cat_no_induk", "fullname", "email", "no_hp", "birthdate", "line_id", "bb_pin", "twitter", "address", "city", "marital_status", "jenis_kelamin", "no_telp", "provinsi", "facebook", "cat_username", "password", "batch", "tanggal_pendaftaran", "tanggal_kelas_berakhir", "sales_username"];
        return view('content\table', ['route' => 'CAT', 'clients' => $cats, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins]);
   // }
        //$tab = ["asdf", "bsb", "adf"];
        //$a = 'a';
        //return $tab['a'];
        //return view('table/table', ['posts' => $tab, 'route' => 'CAT.detail']);
    }

    public function clientDetail($id) {
        //echo "CAT Detail <br>";
        //echo $id;
        $cat = DB::select("call select_detail_cat(?)", [$id]);
        $cat = $cat[0];
        $ins = ["CAT ID" => "cat_user_id", "Fullname" => "fullname", "Email" => "email", "No HP" => "no_hp", "Birthdate" =>"birthdate", "Line ID" => "line_id", "BB Pin" => "bb_pin", "Twitter" => "twitter", "Alamat" => "address", "Kota" => "city", "Marital Status" => "marital_status", "Jenis Kelamin" => "jenis_kelamin", "No Telepon" => "no_telp", "Provinsi" => "provinsi", "Facebook" => "facebook", "Username" => "cat_username", "Password" => "password", "Tanggal Daftar" => "tanggal_pendaftaran", "Tanggal Kelas Akhir" => "tanggal_kelas_berakhir", "Sales" => "sales_username"];
        $heads = ["PC ID" => "all_pc_id"] + $ins;

        $clientsreg = DB::select("call select_detail_cat_2(?)", [$id]);
        $headsreg = ["Angsuran ke", "Tanggal Pembayaran Angsuran", "Pembayaran Angsuran"];
        $attsreg = ["angsuran_ke", "tanggal_pembayaran_angsuran", "pembayaran_angsuran"];
        //ADD TRANSAKSI
        $insreg = ["Angsuran ke", "Tanggal Pembayaran Angsuran", "Pembayaran Angsuran"];
		return view('profile\profile', ['route'=>'CAT', 'client'=>$cat, 'heads'=>$heads, 'ins'=>$ins, 'clientsreg'=>$clientsreg, 'attsreg'=>$attsreg, 'headsreg'=>$headsreg, 'insreg' => $insreg]);
    }


    public function editClient(Request $request) {
        $this->validate($request, [
                'email' => 'email',
                'address' => 'required',
                'no_hp' => 'required',
                //'batch' => 'required',
                'cat_user_id' => 'required',
                //'cat_no_induk' => 'required',
                'tanggal_pendaftaran' => 'required',
                'tanggal_kelas_berakhir' => 'required',
                'cat_username' => 'required',
                'fullname' => 'required',
                'all_pc_id' => 'required'
            ]);
        DB::beginTransaction();
        $err = [];
        try {
            DB::select("call edit_master_client(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->all_pc_id, $request->fullname, $request->email, $request->no_hp, $this->nullify($request->birthdate), $this->nullify($request->line_id), $this->nullify($request->bb_pin), $this->nullify($request->twitter), $request->address, $this->nullify($request->city), $this->nullify($request->marital_status), $this->nullify($request->jenis_kelamin), $this->nullify($request->no_telp), $this->nullify($request->provinsi), $this->nullify($request->facebook)]);
            DB::select("call edit_cat(?,?,?,?,?,?,?,?,?)", [$request->all_pc_id, $request->cat_user_id, $request->cat_no_induk, $request->cat_username, $this->nullify($request->password), $request->batch, $request->tanggal_pendaftaran, $request->tanggal_kelas_berakhir, $this->nullify($request->sales_username)]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            $err[] = $ex->getMessage();
        }
        DB::commit();
        return redirect()->back()->withErrors($err);
    }

    public function addClient(Request $request) {
        $this->validate($request, [
                'batch' => 'required',
                'user_id' => 'required',
                'no_induk' => 'required',
                'pendaftaran' => 'required',
                'kelas_berakhir' => 'required',
                'nama' => 'required',
                'email' => 'email',
                'telepon' => 'required',
                'alamat' => 'required',
                'username' => 'required'
            ]);

        //echo $request;
        DB::beginTransaction();
        $err = [];
        try {
            DB::select("call inputCAT(?,?,?,?)", [$this->nullify($request->user_id),$request->batch,$request->user_id,$request->no_induk,$request->pendaftaran,$request->kelas_berakhir,$request->username,$this->nullify($request->password),$request->nama,$this->nullify($request->jenis_kelamin),$request->email,$request->telepon,$request->alamat,$this->nullify($request->kota), $this->nullify($request->tanggal_lahir)]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            $err[] = $ex->getMessage();
        }
        DB::commit();
        return redirect()->back()->withErrors($err);

    }

    public function deleteClient($id) {
        echo "delete" . $id;
        try {
            DB::select("call delete_cat(?)", [$id]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        return redirect("home");
    }

    public function addTrans(Request $request) {
         DB::beginTransaction();
        $err = [];
        try {
            DB::select("call inputCAT_pembayaran(?,?,?,?)", [$this->nullify($request->user_id),$request->angsuran_ke,$request->tanggal_pembayaran_angsuran,$request->pembayaran_angsuran]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            $err[] = $ex->getMessage();
        }
        DB::commit();
        return redirect()->back()->withErrors($err);
    }

    public function detailTrans($id){
        echo ($id);
         $clientsreg = DB::select("select * from laporan_pembayaran_cat where angsuran_ke = (?)", [$id]);
         $clientsreg = $clientsreg[0];
        $headsreg = ["Angsuran ke", "Tanggal Pembayaran Angsuran", "Pembayaran Angsuran"];
        $attsreg = ["angsuran_ke", "tanggal_pembayaran_angsuran", "pembayaran_angsuran"];
        return view('profile\transaction', ['route'=>'CAT/trans',  'clientsreg'=>$clientsreg, 'attsreg'=>$attsreg, 'headsreg'=>$headsreg]);
    }

    public function deleteTrans($id1, $id2){
        echo ($id1);
        echo ($id2);
        $err = [];
        try{
            DB::select("call delete_laporan_pembayaran_cat(?,?)", [$id1, $id2]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        
        return redirect()->back()->withErrors($err);
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
                    if (($value->batch) === null) {
                        $msg = "Batch empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->user_id) === null) {
                        $msg = "User ID empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->no_induk) === null) {
                        $msg = "No Induk empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->pendaftaran) === null) {
                        $msg = "Pendaftaran empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->kelas_berakhir) === null) {
                        $msg = "Kelas Berakhir empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->nama) === null) {
                        $msg = "Nama empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->email) === null) {
                        $msg = "Email empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->telepon) === null) {
                        $msg = "Telepon empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->alamat) === null) {
                        $msg = "Alamat empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->username) === null) {
                        $msg = "Username empty on line ".$i;
                        $err[] = $msg;
                    }
                } //end validasi

                //Jika tidak ada error, import
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        echo $value->account . ' ' . $value->nama . ' ' . $value->tanggal_join . ' ' . $value->alamat . ' ' . $value->kota . ' ' . $value->telepon . ' ' . $value->email . ' ' . $value->type . ' ' . $value->sales . ' ' . "<br/>";
                        try { 
                            DB::select("call inputCAT(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$value->sales,$value->batch,$value->user_id,$value->no_induk,$value->pendaftaran,$value->kelas_berakhir,$value->username,$value->password,$value->nama,$value->jenis_kelamin,$value->email,$value->telepon,$value->alamat,$value->kota, $value->tanggal_lahir]);
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
}
