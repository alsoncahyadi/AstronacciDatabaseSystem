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
        try {
            DB::select("call input_redclub(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->username, $request->firstname, $request->lastname, $request->email, $request->tanggal_join, $request->no_hp, $request->pc_id, $request->occupation, $this->nullify($request->jenis_kelamin), $request->status_perkawinan, $request->alamat, $request->kota, $request->line_id, $request->bb_pin, $request->annual_come, $request->country, $request->birthdate, $request->interest, $request->hobby, $request->spesific,  $request->your_stock_and_future_broker, $this->nullify($request->trading_experience_year),$this->nullify($request->trading_type), $request->security_question, $request->security_answer, $request->facebook, $request->share_to_aclub, $request->share_to_mrg, $request->share_to_cat, $request->share_to_uob]);
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
                    if (($value->user_id) === null) {
                        $msg = "User ID empty on line ".$i;
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
                    if (($value->no_hp) === null) {
                        $msg = "No HP empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->alamat) === null) {
                        $msg = "Alamat empty on line ".$i;
                        $err[] = $msg;
                    }
                } //end validasi

                //Jika tidak ada error, import
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        echo $value->account . ' ' . $value->nama . ' ' . $value->tanggal_join . ' ' . $value->alamat . ' ' . $value->kota . ' ' . $value->telepon . ' ' . $value->email . ' ' . $value->type . ' ' . $value->sales . ' ' . "<br/>";
                        try { 
                            DB::select("call inputaclub_member(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$value->user_id, $value->nama, $value->no_hp, $value->no_telepon, $value->alamat, $value->kota, $value->provinsi, $value->email, $this->nullify($value->tanggal_lahir), $value->line_id, $value->pin_bb, $value->facebook, $value->twitter, $value->jenis_kelamin, $value->occupation, $value->website, $value->state, $value->interest_and_hobby, $this->nullify($value->trading_experience_year), $value->your_stock_and_future_broker, $this->nullify($value->annual_income), $value->status, $value->security_question, $value->security_answer]);
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