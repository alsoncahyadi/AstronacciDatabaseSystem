<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;

class RedClubController extends Controller
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
        $aclubs = DB::select("select * from redclub");
		//Daftar username sales
		$salesusers = DB::select("SELECT sales_username FROM sales");
        
        //Daftar dropdown
        $foreigns = DB::select("SELECT all_pc_id, fullname FROM master_client");
        //Data untuk insert
        $ins = ["Username", "Firstname", "Lastname", "Email", "Tanggal Join", "No HP", "PC ID", "Occupation", "Jenis Kelamin", "Status Perkawinan", "Alamat", "Kota", " Line ID", "BB Pin", " Annual Come", "Country", "Birthdate", "Interest", "Hobby", "Spesific", "Stock and Future Broker", "Trading Experience Year", "Trading Type", "Security Question", "Security Answer", "Facebook", "Share to AClub", "Share to MRG", "Share to CAT", "Share to UOB"];

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["Username", "Firstname", "Lastname", "Email", "Tanggal Join", "No HP", "PC ID", "Occupation", "Jenis Kelamin", "Status Perkawinan", "Alamat", "Kota", " Line ID", "BB Pin", " Annual Come", "Country", "Tanggal Lahir", "Interest", "Hobby", "Spesific", "Your Stock and Future Broker", "Trading Experience Year", "Trading Type", "Security Question", "Security Answer", "Facebook", "Share to AClub", "Share to MRG", "Share to CAT", "Share to UOB", "Tanggal Ditambahkan"];

        //Nama attribute pada sql
         $atts = ["username", "firstname", "lastname", "email", "join_date", "no_hp","all_pc_id", "occupation", "jenis_kelamin", "status_perkawinan", "alamat", "kota", "line_id", "blackberry_pin", "annual_come", "country", "birthdate", "interest", "hobby", "spesific", "your_stock_and_future_broker", "trading_experience_year", "trading_type", "security_question", "security_answer", "facebook", "share_to_aclub", "share_to_mrg", "share_to_cat", "share_to_uob", "added_time"];
         //Return view table dengan parameter
        return view('content\table', ['route' => 'RedClub', 'clients' => $aclubs, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins, 'sales'=>$salesusers, 'foreigns'=>$foreigns]);
    }

    public function clientDetail($id) {
        //Select seluruh data client $id yang ditampilkan di detail
        $red = DB::select("SELECT * FROM RedClub WHERE username = ?", [$id]);
        $red = $red[0];
        //Nama atribut form yang ditampilkan dan nama pada SQL
        $ins = ["Username" => "username", "Firstname" => "firstname", "Lastname" => "lastname", "Email" => "email", "Join Date" => "join_date", "No HP" => "no_hp", "Occupation" => "occupation", "Jenis Kelamin" => "jenis_kelamin", "Status Perkawinan" => "status_perkawinan", "Alamat" => "alamat", "Kota" => "kota", "Line ID" => "line_id", "Blackberry PIN" => "blackberry_pin", "Annual Come" => "annual_come", "Country" => "country", "Tanggal Lahir" => "birthdate", "Interest" => "interest", "Hobby" => "hobby", "Specific" => "spesific", "Your Stock and Future Broker" => "your_stock_and_future_broker", "Trading Experience Year" => "trading_experience_year", "Trading Type" => "trading_type", "Security Question" => "security_question", "Security Answer" => "security_answer", "Facebook" => "facebook", "Share to AClub" => "share_to_aclub", "Share to MRG" => "share_to_mrg", "Share to CAT" => "share_to_cat", "Share to UOB" => "share_to_uob", "Tanggal Ditambahkan" => "added_time"];
        //Untuk input pada database, ditambahkan PC ID yang tidak ada pada form
        $heads = ["PC ID" => "all_pc_id"] + $ins;
        //Mengganti boolean dengan yes atau no
        $red->share_to_aclub = $red->share_to_aclub ? "Yes" : "No";
        $red->share_to_cat = $red->share_to_cat ? "Yes" : "No";
        $red->share_to_mrg = $red->share_to_mrg ? "Yes" : "No";
        $red->share_to_uob = $red->share_to_uob ? "Yes" : "No";
        //Return view profile dengan parameter
        return view('profile\profile', ['route'=>'RedClub', 'client'=>$red, 'heads'=>$heads, 'ins'=>$ins]);
    }

    public function editClient(Request $request) {
        //Validasi input
        $this->validate($request, [
                'username' => 'required',
                'firstname' => 'required',
                'email' => 'required|email',
                'lastname' => 'required',
            ]);
        DB::beginTransaction();
        $err = [];
        //Mengubah yes atau no menjadi boolean
        $aclub = strtolower($request->share_to_aclub) == "yes" ? 1 : 0;
        $mrg = strtolower($request->share_to_mrg) == "yes" ? 1 : 0;
        $cat = strtolower($request->share_to_cat) == "yes" ? 1 : 0;
        $uob = strtolower($request->share_to_uob) == "yes" ? 1 : 0;
        try {
            //Untuk parameter yang tidak boleh null, digunakan nullify untuk menjadikan input empty string menjadi null
            //Edit atribut Red Club
            DB::select("call edit_redclub(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->username, $request->firstname, $request->lastname, $request->email, $this->nullify($request->join_date), $this->nullify($request->no_hp), $this->nullify($request->all_pc_id), $this->nullify($request->occupation), $this->nullify($request->jenis_kelamin), $this->nullify($request->status_perkawinan), $this->nullify($request->alamat), $this->nullify($request->kota), $this->nullify($request->line_id), $this->nullify($request->blackberry_pin), $this->nullify($request->annual_come), $this->nullify($request->country), $this->nullify($request->birthdate), $this->nullify($request->interest), $this->nullify($request->hobby), $this->nullify($request->spesific),  $this->nullify($request->your_stock_and_future_broker), $this->nullify($request->trading_experience_year),$this->nullify($request->trading_type), $this->nullify($request->security_question), $this->nullify($request->security_answer), $this->nullify($request->facebook), $aclub, $mrg, $cat, $uob]);
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
                'username' => 'required',
                'firstname' => 'required',
                'email' => 'required|email',
                'lastname' => 'required',
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
            //Input data ke SQL
            DB::select("call input_redclub(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->username, $request->firstname, $request->lastname, $request->email, $this->nullify($request->tanggal_join), $this->nullify($request->no_hp), $this->nullify($request->pc_id), $this->nullify($request->occupation), $this->nullify($request->jenis_kelamin), $this->nullify($request->status_perkawinan), $this->nullify($request->alamat), $this->nullify($request->kota), $this->nullify($request->line_id), $this->nullify($request->bb_pin), $this->nullify($request->annual_come), $this->nullify($request->country), $this->nullify($request->birthdate), $this->nullify($request->interest), $this->nullify($request->hobby), $this->nullify($request->spesific),  $this->nullify($request->your_stock_and_future_broker), $this->nullify($request->trading_experience_year),$this->nullify($request->trading_type), $this->nullify($request->security_question), $this->nullify($request->security_answer), $this->nullify($request->facebook), $aclub, $mrg, $cat, $uob]);
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
            DB::select("call delete_redclub(?)", [$id]);
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
                    if (($value->username) === null) {
                        $msg = "Username empty on line ".$i;
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
                            DB::select("call input_redclub(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$value->username, $value->firstname, $value->lastname, $value->email, $value->tanggal_join, $value->no_hp, $value->pc_id, $value->occupation, $this->nullify($value->jenis_kelamin), $value->status_perkawinan, $value->alamat, $value->kota, $value->line_id, $value->bb_pin, $value->annual_come, $value->country, $value->birthdate, $value->interest, $value->hobby, $value->spesific,  $value->your_stock_and_future_broker, $this->nullify($value->trading_experience_year),$this->nullify($value->trading_type), $value->security_question, $value->security_answer, $value->facebook, $aclub, $mrg, $cat, $uob]);
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
						DB::select("call input_assign_redclub(?,?,?,?,?)", [$request['id'.$idx], $request['assign'], $request['prospect'], $request['username'], 'to be added']);
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