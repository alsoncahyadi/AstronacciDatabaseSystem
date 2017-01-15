<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;

class GreenController extends Controller
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
        $greens = DB::select("SELECT * FROM green");
		
		$salesusers = DB::select("SELECT sales_username FROM sales");
		//dd($salesusers);
        //dd($mrgs);

        //Data untuk insert
        $ins = ["Nama", "No HP", "Keterangan Perintah", "Sumber", "Progress", "Sales", "Share to AClub", "Share to MRG", "Share to CAT", "Share to UOB"];

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["Green ID", "Fullname", "No HP", "Keterangan Perintah", "Sumber", "Sales", "Progress", "AClub Stock", "AClub Future", "CAT", "MRG", "UOB", "Red Club", "Share To AClub", "Share To CAT", "Share to MRG", "Share to UOB"];

        //Nama attribute pada sql
        $atts = ["green_id", "fullname", "no_hp", "keterangan_perintah", "sumber", "sales_username", "progress", "is_aclub_stock", "is_aclub_future", "is_cat", "is_mrg_premiere", "is_UOB", "is_red_club", "share_to_aclub", "share_to_cat", "share_to_mrg", "share_to_uob"];

        foreach ($greens as $green) {
            $green->is_UOB = $green->is_UOB ? "Yes" : "No";
            $green->is_cat = $green->is_cat ? "Yes" : "No";
            $green->is_mrg_premiere = $green->is_mrg_premiere ? "Yes" : "No";
            $green->is_aclub_stock = $green->is_aclub_stock ? "Yes" : "No";
            $green->is_aclub_future = $green->is_aclub_future ? "Yes" : "No";
            $green->is_red_club = $green->is_red_club ? "Yes" : "No";
            $green->share_to_aclub = $green->share_to_aclub ? "Yes" : "No";
            $green->share_to_cat = $green->share_to_cat ? "Yes" : "No";
            $green->share_to_mrg = $green->share_to_mrg ? "Yes" : "No";
            $green->share_to_uob = $green->share_to_uob ? "Yes" : "No";

            foreach ($atts as $att) {
                if (!$green->$att) $green->$att = "-";
            }
        }

        return view('content\table', ['route' => 'green', 'clients' => $greens, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins, 'sales'=>$salesusers]);
   // }
        //$tab = ["asdf", "bsb", "adf"];
        //$a = 'a';
        //return $tab['a'];
        //return view('table/table', ['posts' => $tab, 'route' => 'CAT.detail']);
    }

    public function clientDetail($id) {
        //echo "CAT Detail <br>";
        //echo $id;
        $green = DB::select("SELECT * FROM green WHERE green_id = ?", [$id]);
        $green = $green[0];
        $green->is_UOB = $green->is_UOB ? "Yes" : "No";
        $green->is_cat = $green->is_cat ? "Yes" : "No";
        $green->is_mrg_premiere = $green->is_mrg_premiere ? "Yes" : "No";
        $green->is_aclub_stock = $green->is_aclub_stock ? "Yes" : "No";
        $green->is_aclub_future = $green->is_aclub_future ? "Yes" : "No";
        $green->is_red_club = $green->is_red_club ? "Yes" : "No";
        $green->share_to_aclub = $green->share_to_aclub ? "Yes" : "No";
        $green->share_to_cat = $green->share_to_cat ? "Yes" : "No";
        $green->share_to_mrg = $green->share_to_mrg ? "Yes" : "No";
        $green->share_to_uob = $green->share_to_uob ? "Yes" : "No";
        $ins = ["Green ID" => "green_id", "Fullname" => "fullname", "No HP" => "no_hp", "Keterangan Perintah" =>"keterangan_perintah", "Sumber" => "sumber", "Sales" => "sales_username", "Progress" => "progress", "AClub Stock" => "is_aclub_stock", "AClub Future" => "is_aclub_future", "CAT" => "is_cat", "MRG" => "is_mrg_premiere", "UOB" => "is_UOB", "Red Club" => "is_red_club", "Share To AClub" => "share_to_aclub", "Share To CAT" => "share_to_cat", "Share to MRG" => "share_to_mrg", "Share to UOB" => "share_to_uob"];
        $heads = $ins;
        return view('profile\profile', ['route'=>'green', 'client'=>$green, 'heads'=>$heads, 'ins'=>$ins]);
    }

    public function editClient(Request $request) {
        $this->validate($request, [
                'green_id' => 'required',
                'fullname' => 'required',
                'no_hp' => 'required'
            ]);
        DB::beginTransaction();
        $err = [];
        $isaclubstock = strtolower($request->is_aclub_stock) == "yes" ? 1 : 0;
        $isaclubfuture = strtolower($request->is_aclub_stock) == "yes" ? 1 : 0;
        $ismrg = strtolower($request->is_mrg_premiere) == "yes" ? 1 : 0;
        $iscat = strtolower($request->is_cat) == "yes" ? 1 : 0;
        $isuob = strtolower($request->is_UOB) == "yes" ? 1 : 0;
        $isred = strtolower($request->is_red_club) == "yes" ? 1 : 0;
        $aclub = strtolower($request->share_to_aclub) == "yes" ? 1 : 0;
        $mrg = strtolower($request->share_to_mrg) == "yes" ? 1 : 0;
        $cat = strtolower($request->share_to_cat) == "yes" ? 1 : 0;
        $uob = strtolower($request->share_to_uob) == "yes" ? 1 : 0;
        try {
            DB::select("call edit_green(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->green_id, $request->fullname, $request->no_hp, $this->nullify($request->keterangan_perintah), $this->nullify($request->sumber), $this->nullify($request->sales_username), $this->nullify($request->progress), $isaclubstock, $isaclubfuture, $iscat, $ismrg, $isuob, $isred, $aclub, $mrg, $cat, $uob]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            $err[] = $ex->getMessage();
        }
        DB::commit();
        return redirect()->back()->withErrors($err);
    }

    public function addClient(Request $request) {
        $this->validate($request, [
                'nama' => 'required',
                'no_hp' => 'required'
            ]);


        //echo $request;
        DB::beginTransaction();
        $aclub = strtolower($request->share_to_aclub) == "yes" ? 1 : 0;
        $mrg = strtolower($request->share_to_mrg) == "yes" ? 1 : 0;
        $cat = strtolower($request->share_to_cat) == "yes" ? 1 : 0;
        $uob = strtolower($request->share_to_uob) == "yes" ? 1 : 0;
        $err = [];
        try {
            DB::select("call input_green(?,?,?,?,?,?,?,?,?,?)", [$request->nama, $request->no_hp, $request->keterangan_perintah, $request->sumber, $request->progress, $request->sales, $aclub, $mrg, $cat, $uob]);
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
            DB::select("call delete_green(?)", [$id]);
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
                    if (($value->nama) === null) {
                        $msg = "Nama empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->no_hp) === null) {
                        $msg = "No HP empty on line ".$i;
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
                            DB::select("call input_green(?,?,?,?,?,?,?,?,?,?)", [$value->nama, $value->no_hp, $value->keterangan_perintah, $value->sumber, $value->progress, $value->sales, $aclub, $mrg, $cat, $uob]);
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
						DB::select("call input_assign_green(?,?,?,?,?)", [$request['id'.$idx], $request['assign'], $request['prospect'], $request['username'], 'to be added']);
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
