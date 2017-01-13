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

        //echo "masuk sini";
        return $newstring;
    }

    public function getTable() {
        $aclubs = DB::select("SELECT * FROM grow INNER JOIN master_client ON (master_client.all_pc_id = grow.all_pc_id)");
		
		$salesusers = DB::select("SELECT sales_username FROM sales");
        //dd($mrgs);

        //Data untuk insert
        $ins = ["PC ID", "Share to AClub", "Share to MRG", "Share to CAT", "Share to UOB"];

        // "Registration Date", "Kode Paket",  "Sales", "Registration Type", "Start Date", "Bulan Member", "Bonus Member", "Sumber Data", "Broker", "Message", "Keterangan", "Jenis", "Nominal Member", "Percentage", "Paid", "Paid Date", "Debt", "Frekuensi"

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["PC ID", "Grow ID", "Share to AClub", "Share to MRG", "Share to CAT", "Share to UOB", "Created At", "Fullname", "Email", "No HP", "Birthdate", "Line ID", "BB Pin", "Twitter", "Alamat", "Kota", "Marital Status", "Jenis Kelamin", "No Telepon", "Provinsi", "Facebook"]; //kecuali is"an dan add_time

        //Nama attribute pada sql
        $atts = ["all_pc_id", "grow_id", "share_to_aclub", "share_to_mrg", "share_to_cat", "share_to_uob", "created_at", "fullname", "email", "no_hp", "birthdate", "line_id", "bb_pin", "twitter", "address", "city", "marital_status", "jenis_kelamin", "no_telp", "provinsi", "facebook"];
        return view('content\table', ['route' => 'grow', 'clients' => $aclubs, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins, 'sales'=>$salesusers]);
   // }
        //$tab = ["asdf", "bsb", "adf"];
        //$a = 'a';
        //return $tab['a'];
        //return view('table/table', ['posts' => $tab, 'route' => 'CAT.detail']);
    }

    public function clientDetail($id) {
        //echo "CAT Detail <br>";
        //echo $id;
        $grow = DB::select("SELECT * FROM grow INNER JOIN master_client ON (master_client.all_pc_id = grow.all_pc_id) WHERE master_client.all_pc_id = ?", [$id]);
        $grow = $grow[0];
        $grow->share_to_aclub = $grow->share_to_aclub ? "Yes" : "No";
        $grow->share_to_cat = $grow->share_to_cat ? "Yes" : "No";
        $grow->share_to_mrg = $grow->share_to_mrg ? "Yes" : "No";
        $grow->share_to_uob = $grow->share_to_uob ? "Yes" : "No";
        $ins = ["Grow ID" => "grow_id", "Fullname" => "fullname", "Email" => "email", "No HP" => "no_hp", "Birthdate" =>"birthdate", "Line ID" => "line_id", "BB Pin" => "bb_pin", "Twitter" => "twitter", "Alamat" => "address", "Kota" => "city", "Marital Status" => "marital_status", "Jenis Kelamin" => "jenis_kelamin", "No Telepon" => "no_telp", "Provinsi" => "provinsi", "Facebook" => "facebook", "Share To AClub" => "share_to_aclub", "Share To CAT" => "share_to_cat", "Share to MRG" => "share_to_mrg", "Share to UOB" => "share_to_uob"];
        $heads = ["PC ID" => "all_pc_id"] + $ins;
        return view('profile\profile', ['route'=>'grow', 'client'=>$grow, 'heads'=>$heads, 'ins'=>$ins]);
    }

    public function editClient(Request $request) {
        $this->validate($request, [
                'all_pc_id' => 'required',
                'grow_id' => 'required',
                'fullname' => 'required',
                'no_hp' => 'required',
                'email' => 'email',
                'address' => 'required'
            ]);
        DB::beginTransaction();
        $err = [];
        $aclub = strtolower($request->share_to_aclub) == "yes" ? 1 : 0;
        $mrg = strtolower($request->share_to_mrg) == "yes" ? 1 : 0;
        $cat = strtolower($request->share_to_cat) == "yes" ? 1 : 0;
        $uob = strtolower($request->share_to_uob) == "yes" ? 1 : 0;
        try {
            DB::select("call edit_master_client(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->all_pc_id, $request->fullname, $this->nullify($request->email), $request->no_hp, $this->nullify($request->birthdate), $this->nullify($request->line_id), $this->nullify($request->bb_pin), $this->nullify($request->twitter), $request->address, $this->nullify($request->city), $this->nullify($request->marital_status), $this->nullify($request->jenis_kelamin), $this->nullify($request->no_telp), $this->nullify($request->provinsi), $this->nullify($request->facebook)]);
            DB::select("call edit_grow(?,?,?,?,?,?)", [$request->grow_id, $aclub, $mrg, $cat, $uob, $request->all_pc_id]);
        } catch(\Illuminate\Database\QueryException $ex){
            DB::rollback(); 
            $err[] = $ex->getMessage();
        }
        DB::commit();
        return redirect()->back()->withErrors($err);
    }

    public function addClient(Request $request) {
        $this->validate($request, [
                'pc_id' => 'required',
            ]);

        //echo $request;
        DB::beginTransaction();
        $aclub = strtolower($request->share_to_aclub) == "yes" ? 1 : 0;
        $mrg = strtolower($request->share_to_mrg) == "yes" ? 1 : 0;
        $cat = strtolower($request->share_to_cat) == "yes" ? 1 : 0;
        $uob = strtolower($request->share_to_uob) == "yes" ? 1 : 0;
        $err = [];
        try {
            DB::select("call input_grow(?,?,?,?,?)", [$request->pc_id, $aclub, $mrg, $cat, $uob]);
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
            DB::select("call delete_grow(?)", [$id]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        return redirect("home");
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
                    if (($value->pc_id) === null) {
                        $msg = "PC ID empty on line ".$i;
                        $err[] = $msg;
                    }
                } //end validasi

                //Jika tidak ada error, import
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        echo $value->account . ' ' . $value->nama . ' ' . $value->tanggal_join . ' ' . $value->alamat . ' ' . $value->kota . ' ' . $value->telepon . ' ' . $value->email . ' ' . $value->type . ' ' . $value->sales . ' ' . "<br/>";
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


        //foreach ($err as $er) 
        //    echo $er . "<br/>";
        return redirect()->back()->withErrors([$err]);
    }
	
	public function assignClient (Request $request) {
		if (isset($request['assbut'])){
			$err = [];
			for ($idx = 0;$idx < $request['numusers'];$idx++){
				if ($request['assigned'.$idx]){
					try {
						DB::select("call input_assign_grow(?,?,?,?,?,?)", [$request['id'.$idx], $request['assign'], $request['prospect'], date('Y-m-d H:i:s'), $request['username'], 'to be added']);
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