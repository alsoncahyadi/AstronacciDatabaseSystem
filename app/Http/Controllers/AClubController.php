<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;

class AClubController extends Controller
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
        $aclubs = DB::select("call selectaclub_member()");
        //dd($mrgs);

        //Data untuk insert
        $ins = ["User ID", "Nama", "No HP", "No Telepon", "Alamat", "Kota", "Provinsi", "Email", "Tanggal Lahir", "Line ID", "Pin BB", "Facebook", "Twitter", "Jenis Kelamin", "Occupation", "Website", "State", "Interest and Hobby", "Trading Experience Year", "Your Stock and Future Broker", "Annual Income", "Status", "Security Question", "Security Answer"];

        // "Registration Date", "Kode Paket",  "Sales", "Registration Type", "Start Date", "Bulan Member", "Bonus Member", "Sumber Data", "Broker", "Message", "Keterangan", "Jenis", "Nominal Member", "Percentage", "Paid", "Paid Date", "Debt", "Frekuensi"

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["PC ID", "Fullname", "Email", "No HP", "Birthday", "Line ID", "BB Pin", "Twitter", "Alamat", "Kota", "Marital Status", "Jenis Kelamin", "Interest and Hobby", "Trading Experience Year", "Your Stocks & Futures Broker", ""];

        //Nama attribute pada sql
        $atts = ["all_pc_id", "fullname", "email", "no_hp", "birthdate", "line_id", "bb_pin", "twitter", "address", "city", "marital_status", "jenis_kelamin", "interest_and_hobby", "trading_experience_year", "your_stock_future_broker"];
        return view('content\table', ['route' => 'AClub', 'clients' => $aclubs, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins]);
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
        $this->validate($request, [
                'user_id' => 'required',
                'nama' => 'required',
                'email' => 'required|email',
                'no_hp' => 'required',
                'alamat' => 'required',
            ]);

        //echo $request;
        $err = [];
        try {
            DB::select("call inputaclub_member(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->user_id, $request->nama, $request->no_hp, $request->no_telepon, $request->alamat, $request->kota, $request->provinsi, $request->email, $this->nullify($request->tanggal_lahir), $request->line_id, $request->pin_bb, $request->facebook, $request->twitter, $request->jenis_kelamin, $request->occupation, $request->website, $request->state, $request->interest_and_hobby, $this->nullify($request->trading_experience_year), $request->your_stock_and_future_broker, $this->nullify($request->annual_income), $request->status, $request->security_question, $request->security_answer]);
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