<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;


class UOBController extends Controller
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
        $uobs = DB::select("call select_uob()");
        //Daftar username sales
        $salesusers = DB::select("SELECT sales_username FROM sales");

        //Data untuk insert
        $ins = ["Client", "Nama", "Class", "Nomor", "Expired", "Alamat", "Kota", "Tanggal Lahir", "Kategori", "Bulan", "Email", "Telepon",  "Bank", "Nomor Rekening", "Jenis Kelamin", "RDI Niaga", "RDI BCA", "Trading via", "Source", "Sales"];

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["PC ID", "Client ID", "Nama", "Email", "No HP", "Tanggal Lahir", "Line ID", "BB Pin", "Twitter", "Address", "City", "Status Pernikahan", "Jenis Kelamin", "No Telepon", "Provinsi", "Facebook", "Class", "Nomor", "Expired", "Kategori", "Bulan", "Bank", "Nomor Rekening", "RDI Niaga", "RDI BCA", "Trading Via", "Source", "Sales", "Tanggal Ditambahkan"]; //kecuali is" an dan add_time

        //Nama attribute pada sql
        $atts = ["all_pc_id", "client_id", "fullname", "email", "no_hp", "birthdate", "line_id", "bb_pin", "twitter", "address", "city", "marital_status", "jenis_kelamin", "no_telp", "provinsi", "facebook", "class", "nomor", "expired_date", "kategori", "bulan", "bank", "nomor_rekening", "RDI_niaga", "RDI_BCA", "trading_via", "source", "sales_username", "add_time"];
        //Return view table dengan parameter
        return view('content\table', ['route' => 'UOB', 'clients' => $uobs, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins, 'sales'=>$salesusers]);
    }

    public function clientDetail($id) {
        //Select seluruh data client $id yang ditampilkan di detail
        $uob = DB::select("call select_detail_uob(?)", [$id]);
        $uob = $uob[0];
        //Nama atribut form yang ditampilkan dan nama pada SQL
        $ins = ["Client ID" => "client_id", "Nama" => "fullname", "Email" => "email", "No HP" => "no_hp", "Tanggal Lahir" =>"birthdate", "Line ID" => "line_id", "BB Pin" => "bb_pin", "Twitter" => "twitter", "Alamat" => "address", "Kota" => "city", "Status Pernikahan" => "marital_status", "Jenis Kelamin" => "jenis_kelamin", "No Telepon" => "no_telp", "Provinsi" => "provinsi", "Facebook" => "facebook", "Class" => "class", "Nomor" => "nomor", "Expired" => "expired_date", "Kategori" => "kategori", "Bulan" => "bulan", "Bank" => "bank", "Nomor Rekening" => "nomor_rekening", "RDI Niaga" => "RDI_niaga", "RDI BCA" => "RDI_BCA", "Trading Via" => "trading_via", "Source" => "source", "Sales" => "sales_username", "Tanggal Ditambahkan" => "add_time"];
        //Untuk input pada database, ditambahkan PC ID yang tidak ada pada form
        $heads = ["PC ID" => "all_pc_id"] + $ins;
        //Return view profile dengan parameter
        return view('profile\profile', ['route'=>'UOB', 'client'=>$uob, 'heads'=>$heads, 'ins'=>$ins]);
    }

    public function editClient(Request $request) {
        //Validasi input
        $this->validate($request, [
                'all_pc_id' => 'required',
                'client_id' => 'required',
                'fullname' => 'required',
                'expired_date' => 'required',
                'email' => 'email',
                'no_hp' => 'required',
                'address' => 'required',
            ]);
        //Inisialisasi array error
        DB::beginTransaction();
        $err = [];
        try {
            //Untuk parameter yang tidak boleh null, digunakan nullify untuk menjadikan input empty string menjadi null
            //Edit atribut master client
            DB::select("call edit_master_client(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->all_pc_id, $request->fullname, $this->nullify($request->email), $request->no_hp, $this->nullify($request->birthdate), $this->nullify($request->line_id), $this->nullify($request->bb_pin), $this->nullify($request->twitter), $request->address, $this->nullify($request->city), $this->nullify($request->marital_status), $this->nullify($request->jenis_kelamin), $this->nullify($request->no_telp), $this->nullify($request->provinsi), $this->nullify($request->facebook)]);
            //Edit atribut UOB
            DB::select("call edit_uob(?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->all_pc_id, $request->client_id, $this->nullify($request->class), $this->nullify($request->nomor), $this->nullify($request->expired_date), $this->nullify($request->kategori), $this->nullify($request->bulan), $this->nullify($request->bank), $this->nullify($request->nomor_rekening), $this->nullify($request->RDI_niaga), $this->nullify($request->RDI_BCA), $this->nullify($request->trading_via), $this->nullify($request->source), $this->nullify($request->sales_username)]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            $err[] = $ex->getMessage();
        }
        DB::commit();
        return redirect()->back()->withErrors($err);
    }

    public function addClient(Request $request) {
        //Validasi input
        $this->validate($request, [
                'client' => 'required',
                'nama' => 'required',
                'expired' => 'required',
                'email' => 'email',
                'telepon' => 'required',
                'alamat' => 'required',
            ]);
        //Inisialisasi array error
        $err = [];
        DB::beginTransaction();
		try {
            //Input data ke SQL
			DB::select("call inputUOB(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->client,$request->nama,$this->nullify($request->class),$this->nullify($request->nomor),$request->expired,$request->alamat,$this->nullify($request->kota),$this->nullify($request->tanggal_lahir),$this->nullify($request->kategori), $this->nullify($request->bulan), $request->telepon, $request->email, $this->nullify($request->bank), $this->nullify($request->nomor_rekening), $this->nullify($request->jenis_kelamin), $this->nullify($request->rdi_niaga), $this->nullify($request->rdi_bca), $this->nullify($request->trading_via), $this->nullify($request->source), $this->nullify($request->sales)]);
		}  catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            $err[] = $ex->getMessage();
        }
        DB::commit();
        return redirect()->back()->withErrors($err);
    }

    public function deleteClient($id) {
        //Menghapus client dengan ID tertentu
        try {
            DB::select("call delete_uob(?)", [$id]);
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
                    if (($value->client) === null) {
                        $msg = "Client empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->nama) === null) {
                        $msg = "Nama empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->expired) === null) {
                        $msg = "Expired empty on line ".$i;
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
                    
                } //end validasi

                //Jika tidak ada error, import dengan cara insert satu per satu
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        try { 
                            DB::select("call inputUOB(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$value->client,$value->nama,$value->class,$value->nomor,$value->expired,$value->alamat,$value->kota,$value->tanggal_lahir,$value->kategori, $value->bulan, $value->telepon, $value->email, $value->bank, $value->nomor_rekening, $value->jenis_kelamin, $value->rdi_niaga, $value->rdi_bca, $value->trading_via, $value->source, $value->sales]);
                        } catch(\Illuminate\Database\QueryException $ex){ 
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
}
