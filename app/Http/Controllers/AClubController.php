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
        $ins = ["User ID", "Nama", "No HP", "No Telepon", "Alamat", "Kota", "Provinsi", "Email", "Tanggal Lahir", "Line ID", "Pin BB", "Facebook", "Twitter", "Jenis Kelamin", "Occupation", "Website", "State", "Interest and Hobby", "Trading Experience Year", "Your Stock and Future Broker", "Annual Income", "Status", "Keterangan", "Security Question", "Security Answer"];

        // "Registration Date", "Kode Paket",  "Sales", "Registration Type", "Start Date", "Bulan Member", "Bonus Member", "Sumber Data", "Broker", "Message", "Keterangan", "Jenis", "Nominal Member", "Percentage", "Paid", "Paid Date", "Debt", "Frekuensi"

        //Judul kolom yang ditampilkan pada tabel
       $heads = ["PC ID", "User ID", "Fullname", "Email", "No HP", "Birthdate", "Line ID", "BB Pin", "Twitter", "Alamat", "Kota", "Marital Status", "Jenis Kelamin", "No Telepon", "Provinsi", "Facebook", "Interest and Hobby", "Trading Experience Year", "Your Stock Future Broker", "Annual Income", "Security Question", "Security Answer", "Status", "Keterangan", "Website", "State", "Occupation"];//kecuali is"an dan add_time

        //Nama attribute pada sql
        $atts = ["all_pc_id", "user_id", "fullname", "email", "no_hp", "birthdate", "line_id", "bb_pin", "twitter", "address", "city", "marital_status", "jenis_kelamin", "no_telp", "provinsi", "facebook", "interest_and_hobby", "trading_experience_year", "your_stock_future_broker", "annual_income", "security_question", "security_answer", "status", "keterangan", "website","state", "occupation"];
        return view('content\table', ['route' => 'AClub', 'clients' => $aclubs, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins]);
   // }
        //$tab = ["asdf", "bsb", "adf"];
        //$a = 'a';
        //return $tab['a'];
        //return view('table/table', ['posts' => $tab, 'route' => 'CAT.detail']);
    }

    public function clientDetail($id) {
        //echo "CAT Detail <br>";
        //echo $id;
        $aclub = DB::select("call select_detail_aclub(?)", [$id]);
        $aclub = $aclub[0];
        $ins = ["User ID" => "user_id", "Fullname" => "fullname", "Email" => "email", "No HP" => "no_hp", "Birthdate" =>"birthdate", "Line ID" => "line_id", "BB Pin" => "bb_pin", "Twitter" => "twitter", "Alamat" => "address", "Kota" => "city", "Marital Status" => "marital_status", "Jenis Kelamin" => "jenis_kelamin", "No Telepon" => "no_telp", "Provinsi" => "provinsi", "Facebook" => "facebook", "Interest and Hobby" => "interest_and_hobby", "Trading Year Experience" => "trading_experience_year", "Your Stock and Future Broker" => "your_stock_future_broker", "Annual Income" => "annual_income", "Security Question" => "security_question", "Security Answer" => "security_answer", "Status" => "status", "Keterangan" => "keterangan", "Website" => "website", "State" => "state", "Occupation" => "occupation"];
        $heads = ["PC ID" => "all_pc_id"] + $ins;

        $clientsreg = DB::select("call select_detail_aclub_2(?)", [$id]);
        $headsreg = ["Registration ID", "Sales", "Broker", "Paket", "Registration Type", "Registration Date", "Jenis", "Nominal", "Percentage", "Comission", "Paid", "Paid Date", "Debt", "Frekuensi", "Keterangan Ref", "Message", "Start Date", "Bulan Member", "Expired Date", "Bonus Member Day", "Expired Date Bonus", "Sumber Data"];
        $attsreg = ["registration_id", "sales_username", "broker", "paket", "registration_type", "registration_date", "jenis", "nominal", "percentage", "comission_for_sales", "paid", "paid_date", "debt", "frekuensi", "keterangan_ref", "message", "start_date", "bulan_member", "expired_date", "bonus_member_day", "expired_date_bonus", "sumber_data"];
        //ADD TRANSAKSI
        $insreg = ["User_ID", "Registration Date", "Kode Paket", "Sales Username", "Registration Type", "Start Date", "Bulan Member", "Bonus Member", "Sumber Data", "Broker", "Message", "Jenis", "Nominal Member", "Percentage", "Paid", "Paid Date", "Debt", "Frekuensi"];
        return view('profile\profile', ['route'=>'AClub', 'client'=>$aclub, 'heads'=>$heads, 'ins'=>$ins, 'clientsreg'=>$clientsreg, 'insreg'=>$insreg, 'attsreg'=>$attsreg, 'headsreg'=>$headsreg]);
    }

    public function editClient(Request $request) {
        $this->validate($request, [
                'all_pc_id' => 'required',
                'user_id' => 'required',
                'fullname' => 'required',
                'email' => 'email',
                'no_hp' => 'required',
                'address' => 'required',
            ]);
        DB::beginTransaction();
        $err = [];
        try {
            DB::select("call edit_master_client(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->all_pc_id, $request->fullname, $this->nullify($request->email), $request->no_hp, $this->nullify($request->birthdate), $this->nullify($request->line_id), $this->nullify($request->bb_pin), $this->nullify($request->twitter), $request->address, $this->nullify($request->city), $this->nullify($request->marital_status), $this->nullify($request->jenis_kelamin), $this->nullify($request->no_telp), $this->nullify($request->provinsi), $this->nullify($request->facebook)]);
            DB::select("call edit_aclub(?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->all_pc_id, $request->user_id, $this->nullify($request->interest_and_hobby), $this->nullify($request->trading_experience_year), $this->nullify($request->your_stock_future_broker), $this->nullify($request->annual_income), $this->nullify($request->security_question), $this->nullify($request->security_answer), $this->nullify($request->status), $this->nullify($request->keterangan), $this->nullify($request->website), $this->nullify($request->state), $this->nullify($request->occupation)]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            $err[] = $ex->getMessage();
        }
        DB::commit();
        return redirect()->back()->withErrors($err);
    }

    public function addClient(Request $request) {
        $this->validate($request, [
                'user_id' => 'required',
                'nama' => 'required',
                'email' => 'email',
                'no_hp' => 'required',
                'alamat' => 'required',
            ]);

        //echo $request;
        DB::beginTransaction();
        $err = [];
        try {
             DB::select("call inputaclub_member(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->user_id, $request->nama, $request->no_hp, $this->nullify($request->no_telepon), $request->alamat, $this->nullify($request->kota), $this->nullify($request->provinsi), $request->email, $this->nullify($request->tanggal_lahir), $this->nullify($request->line_id), $this->nullify($request->pin_bb), $this->nullify($request->facebook), $this->nullify($request->twitter), $this->nullify($request->jenis_kelamin), $this->nullify($request->occupation), $this->nullify($request->website), $this->nullify($request->state), $this->nullify($request->interest_and_hobby), $this->nullify($request->trading_experience_year), $this->nullify($request->your_stock_and_future_broker), $this->nullify($request->annual_income), $this->nullify($request->status), $this->nullify($request->keterangan),$this->nullify($request->security_question), $this->nullify($request->security_answer)]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            $err[] = $ex->getMessage();
        }
        DB::commit();
        return redirect()->back()->withErrors($err);

    }

    public function addTrans(Request $request) {
         DB::beginTransaction();
        $err = [];
        try {
            DB::select("call inputaclub_registration(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$this->nullify($request->user_id),$request->registration_date,$request->kode_paket,$request->sales_username, $request->registration_type,$request->start_date,$request->bulan_member, $request->bonus_member, $request->sumber_data, $request->broker, $request->message, $request->jenis, $request->nominal_number, $request->percentage, $request->paid, $request->paid_date, $request->debt, $request->frekuensi]);
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
                            DB::select("call inputaclub_member(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$value->user_id, $value->nama, $value->no_hp, $value->no_telepon, $value->alamat, $value->kota, $value->provinsi, $value->email, $this->nullify($value->tanggal_lahir), $value->line_id, $value->pin_bb, $value->facebook, $value->twitter, $value->jenis_kelamin, $value->occupation, $value->website, $value->state, $value->interest_and_hobby, $this->nullify($value->trading_experience_year), $value->your_stock_and_future_broker, $this->nullify($value->annual_income), $value->status, $value->keterangan, $value->security_question, $value->security_answer]);
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