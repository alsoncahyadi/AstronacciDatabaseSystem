<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;

class GrowController extends Controller
{
    //
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
        $aclubs = DB::select("SELECT * FROM grow INNER JOIN master_client ON (master_client.all_pc_id = grow.all_pc_id)");
		//Daftar username sales
		$salesusers = DB::select("SELECT sales_username FROM sales");
        //Daftar foreign key untuk dropdown
		$foreigns = DB::select("SELECT all_pc_id, fullname FROM master_client");
        //Data untuk insert
        $ins = ["PC ID", "Share to AClub", "Share to MRG", "Share to CAT", "Share to UOB"];

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["PC ID", "Grow ID", "Share to AClub", "Share to MRG", "Share to CAT", "Share to UOB", "Created At", "Nama", "Email", "No HP", "Birthdate", "Line ID", "BB Pin", "Twitter", "Alamat", "Kota", "Status Pernikahan", "Jenis Kelamin", "No Telepon", "Provinsi", "Facebook", "Tanggal Ditambahkan"]; //kecuali is"an dan add_time

        //Nama attribute pada sql
        $atts = ["all_pc_id", "grow_id", "share_to_aclub", "share_to_mrg", "share_to_cat", "share_to_uob", "created_at", "fullname", "email", "no_hp", "birthdate", "line_id", "bb_pin", "twitter", "address", "city", "marital_status", "jenis_kelamin", "no_telp", "provinsi", "facebook", "created_at"];
        //Return view table dengan parameter
        return view('content\table', ['route' => 'grow', 'clients' => $aclubs, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins, 'sales'=>$salesusers, 'foreigns'=>$foreigns]);
    }

    public function clientDetail($id) {
        //Select seluruh data client $id yang ditampilkan di detail
        $grow = DB::select("SELECT * FROM grow INNER JOIN master_client ON (master_client.all_pc_id = grow.all_pc_id) WHERE master_client.all_pc_id = ?", [$id]);
        $grow = $grow[0];
        //Mengganti boolean menjadi yes atau no
        $grow->share_to_aclub = $grow->share_to_aclub ? "Yes" : "No";
        $grow->share_to_cat = $grow->share_to_cat ? "Yes" : "No";
        $grow->share_to_mrg = $grow->share_to_mrg ? "Yes" : "No";
        $grow->share_to_uob = $grow->share_to_uob ? "Yes" : "No";
        //Nama atribut form yang ditampilkan dan nama pada SQL
        $ins = ["Grow ID" => "grow_id", "Nama" => "fullname", "Email" => "email", "No HP" => "no_hp", "Birthdate" =>"birthdate", "Line ID" => "line_id", "BB Pin" => "bb_pin", "Twitter" => "twitter", "Alamat" => "address", "Kota" => "city", "Status Pernikahan" => "marital_status", "Jenis Kelamin" => "jenis_kelamin", "No Telepon" => "no_telp", "Provinsi" => "provinsi", "Facebook" => "facebook", "Share To AClub" => "share_to_aclub", "Share To CAT" => "share_to_cat", "Share to MRG" => "share_to_mrg", "Share to UOB" => "share_to_uob", "Tanggal Ditambahkan" => "created_at"];
        //Untuk input pada database, ditambahkan PC ID yang tidak ada pada form
        $heads = ["PC ID" => "all_pc_id"] + $ins;
        //Return view profile dengan parameter
        return view('profile\profile', ['route'=>'grow', 'client'=>$grow, 'heads'=>$heads, 'ins'=>$ins]);
    }

    public function editClient(Request $request) {
        //Validasi input
        $this->validate($request, [
                'all_pc_id' => 'required',
                'grow_id' => 'required',
                'fullname' => 'required',
                'no_hp' => 'required',
                'email' => 'email',
                'address' => 'required'
            ]);
        //Inisialisasi array error
        DB::beginTransaction();
        $err = [];
        //Mengubah yes atau no menjadi boolean
        $aclub = strtolower($request->share_to_aclub) == "yes" ? 1 : 0;
        $mrg = strtolower($request->share_to_mrg) == "yes" ? 1 : 0;
        $cat = strtolower($request->share_to_cat) == "yes" ? 1 : 0;
        $uob = strtolower($request->share_to_uob) == "yes" ? 1 : 0;
        try {
            //Untuk parameter yang tidak boleh null, digunakan nullify untuk menjadikan input empty string menjadi null
            //Edit atribut master client
            DB::select("call edit_master_client(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->all_pc_id, $request->fullname, $this->nullify($request->email), $request->no_hp, $this->nullify($request->birthdate), $this->nullify($request->line_id), $this->nullify($request->bb_pin), $this->nullify($request->twitter), $request->address, $this->nullify($request->city), $this->nullify($request->marital_status), $this->nullify($request->jenis_kelamin), $this->nullify($request->no_telp), $this->nullify($request->provinsi), $this->nullify($request->facebook)]);
            //Edit atribut Grow
            DB::select("call edit_grow(?,?,?,?,?,?)", [$request->grow_id, $aclub, $mrg, $cat, $uob, $request->all_pc_id]);
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
                'pc_id' => 'required',
            ]);

        DB::beginTransaction();
        //Mengubah yes atau no menjadi boolean
        $aclub = strtolower($request->share_to_aclub) == "yes" ? 1 : 0;
        $mrg = strtolower($request->share_to_mrg) == "yes" ? 1 : 0;
        $cat = strtolower($request->share_to_cat) == "yes" ? 1 : 0;
        $uob = strtolower($request->share_to_uob) == "yes" ? 1 : 0;
        $err = [];
        try {
            //Input data ke SQL
            DB::select("call input_grow(?,?,?,?,?)", [$request->pc_id, $aclub, $mrg, $cat, $uob]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            $err[] = $ex->getMessage();
        }
        DB::commit();
        return redirect()->back()->withErrors($err);

    }

    public function deleteClient($id) {
        //Menghapus client dengan ID tertentu
        try {
            DB::select("call delete_grow(?)", [$id]);
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
                    if (($value->pc_id) === null) {
                        $msg = "PC ID empty on line ".$i;
                        $err[] = $msg;
                    }
                } //end validasi

                //Jika tidak ada error, import dengan cara insert satu per satu
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        //Mengubah yes atau no menjadi boolean
                        $aclub = strtolower($value->share_to_aclub) == "yes" ? 1 : 0;
                        $mrg = strtolower($value->share_to_mrg) == "yes" ? 1 : 0;
                        $cat = strtolower($value->share_to_cat) == "yes" ? 1 : 0;
                        $uob = strtolower($value->share_to_uob) == "yes" ? 1 : 0;
                        try { 
                            DB::select("call input_grow(?,?,?,?,?)", [$value->pc_id, $aclub, $mrg, $cat, $uob]);
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
	
	public function assignClient (Request $request) {
		if (isset($request['assbut'])){
			$err = [];
			for ($idx = 0;$idx < $request['numusers'];$idx++){
				if ($request['assigned'.$idx]){
					try {
						DB::select("call input_assign_grow(?,?,?,?,?)", [$request['id'.$idx], $request['assign'], $request['prospect'], $request['username'], 'to be added']);
					} catch(\Illuminate\Database\QueryException $ex){
						echo ($ex->getMessage());
						$err[] = $ex->getMessage();
					}
					DB::commit();
				}
			}
			return redirect()->back()->withErrors([$err]);
		}
	}
}