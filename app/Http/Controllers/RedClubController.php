<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;

class RedClubController extends Controller
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
        $aclubs = DB::select("select * from redclub");
        //dd($mrgs);

        //Data untuk insert
        $ins = ["Username", "Firstname", "Lastname", "Email", "Tanggal Join", "No HP", "PC ID", "Occupation", "Jenis Kelamin", "Status Perkawinan", "Alamat", "Kota", " Line ID", "BB Pin", " Annual Come", "Country", "Birthdate", "Interest", "Hobby", "Spesific", "Stock and Future Broker", "Trading Experience Year", "Trading Type", "Security Question", "Security Answer", "Facebook", "Share to AClub", "Share to MRG", "Share to CAT", "Share to UOB"];

        // "Registration Date", "Kode Paket",  "Sales", "Registration Type", "Start Date", "Bulan Member", "Bonus Member", "Sumber Data", "Broker", "Message", "Keterangan", "Jenis", "Nominal Member", "Percentage", "Paid", "Paid Date", "Debt", "Frekuensi"

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["Username", "Firstname", "Lastname", "Email", "Tanggal Join", "No HP", "PC ID", "Occupation", "Jenis Kelamin", "Status Perkawinan", "Alamat", "Kota", " Line ID", "BB Pin", " Annual Come", "Country", "Birthdate", "Interest", "Hobby", "Spesific", "Stock and Future Broker", "Trading Experience Year", "Trading Type", "Facebook"];

        //Nama attribute pada sql
        $atts = ["username", "firstname", "lastname", "email", "join_date", "no_hp","all_pc_id", "occupation", "jenis_kelamin", "status_perkawinan", "alamat", "kota", "line_id", "blackberry_pin", "annual_come", "country", "birthdate", "interest", "hobby", "spesific", "your_stock_and_future_broker", "trading_experience_year", "trading_type", "facebook"];
        return view('content\table', ['route' => 'RedClub', 'clients' => $aclubs, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins]);
   // }
        //$tab = ["asdf", "bsb", "adf"];
        //$a = 'a';
        //return $tab['a'];
        //return view('table/table', ['posts' => $tab, 'route' => 'CAT.detail']);
    }

    public function clientDetail($id) {
        echo "Aclub Detail <br>";
        echo $id;
    }

    public function addClient(Request $request) {
        /*$this->validate($request, [
                'user_id' => 'required',
                'nama' => 'required',
                'email' => 'required|email',
                'no_hp' => 'required',
                'alamat' => 'required',
            ]);*/

        //echo $request;
            DB::beginTransaction();
        $err = [];
        $aclub = strtolower($request->share_to_aclub) == "yes" ? 1 : 0;
        $mrg = strtolower($request->share_to_mrg) == "yes" ? 1 : 0;
        $cat = strtolower($request->share_to_cat) == "yes" ? 1 : 0;
        $uob = strtolower($request->share_to_uob) == "yes" ? 1 : 0;
        try {
            DB::select("call input_redclub(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->username, $request->firstname, $request->lastname, $request->email, $request->tanggal_join, $request->no_hp, $request->pc_id, $request->occupation, $this->nullify($request->jenis_kelamin), $request->status_perkawinan, $request->alamat, $request->kota, $request->line_id, $request->bb_pin, $request->annual_come, $request->country, $request->birthdate, $request->interest, $request->hobby, $request->spesific,  $request->your_stock_and_future_broker, $this->nullify($request->trading_experience_year),$this->nullify($request->trading_type), $request->security_question, $request->security_answer, $request->facebook, $aclub, $mrg, $cat, $uob]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            $err[] = $ex->getMessage();
        }
        DB::commit();
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
                    if (($value->username) === null) {
                        $msg = "Username empty on line ".$i;
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
}