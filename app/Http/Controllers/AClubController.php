<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;

class AClubController extends Controller
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
        $aclubs = DB::select("call selectaclub_member()");

        //Data untuk insert
        $ins = ["User ID", "Nama", "No HP", "No Telepon", "Alamat", "Kota", "Provinsi", "Email", "Tanggal Lahir", "Line ID", "Pin BB", "Facebook", "Twitter", "Jenis Kelamin", "Occupation", "Website", "State", "Interest and Hobby", "Trading Experience Year", "Your Stock and Future Broker", "Annual Income", "Status", "Keterangan", "Security Question", "Security Answer"];

        //Judul kolom yang ditampilkan pada tabel
       $heads = ["PC ID", "User ID", "Nama", "Email", "No HP", "Tanggal Lahir", "Line ID", "BB Pin", "Twitter", "Alamat", "Kota", "Status Pernikahan", "Jenis Kelamin", "No Telepon", "Provinsi", "Facebook", "Interest and Hobby", "Trading Experience Year", "Your Stock & Future Broker", "Annual Income", "Security Question", "Security Answer", "Status", "Keterangan", "Website", "State", "Occupation", "Tanggal Ditambahkan"];//kecuali is"an dan add_time

        //Nama attribute pada sql
        $atts = ["all_pc_id", "user_id", "fullname", "email", "no_hp", "birthdate", "line_id", "bb_pin", "twitter", "address", "city", "marital_status", "jenis_kelamin", "no_telp", "provinsi", "facebook", "interest_and_hobby", "trading_experience_year", "your_stock_future_broker", "annual_income", "security_question", "security_answer", "status", "keterangan", "website","state", "occupation", "add_time"];
        //Return view table dengan parameter
        return view('content\table', ['route' => 'AClub', 'clients' => $aclubs, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins]);
    }

    public function clientDetail($id) {
        //Select seluruh data client $id yang ditampilkan di detail
        $aclub = DB::select("call select_detail_aclub(?)", [$id]);
        $aclub = $aclub[0];
        //Nama atribut form yang ditampilkan dan nama pada SQL
        $ins = ["User ID" => "user_id", "Nama" => "fullname", "Email" => "email", "No HP" => "no_hp", "Tanggal Lahir" =>"birthdate", "Line ID" => "line_id", "BB Pin" => "bb_pin", "Twitter" => "twitter", "Alamat" => "address", "Kota" => "city", " Status Pernikahan" => "marital_status", "Jenis Kelamin" => "jenis_kelamin", "No Telepon" => "no_telp", "Provinsi" => "provinsi", "Facebook" => "facebook", "Interest and Hobby" => "interest_and_hobby", "Trading Year Experience" => "trading_experience_year", "Your Stock & Future Broker" => "your_stock_future_broker", "Annual Income" => "annual_income", "Security Question" => "security_question", "Security Answer" => "security_answer", "Status" => "status", "Keterangan" => "keterangan", "Website" => "website", "State" => "state", "Occupation" => "occupation", "Tanggal Ditambahkan" => "add_time"];
        //Untuk input pada database, ditambahkan PC ID yang tidak ada pada form
        $heads = ["PC ID" => "all_pc_id"] + $ins;

        $clientsreg = DB::select("call select_detail_aclub_2(?)", [$id]);
        $headsreg = ["Registration ID", "Sales", "Broker", "Paket", "Registration Type", "Registration Date", "Jenis", "Nominal", "Percentage", "Comission", "Paid", "Paid Date", "Debt", "Frekuensi", "Keterangan Ref", "Message", "Start Date", "Bulan Member", "Expired Date", "Bonus Member Day", "Expired Date Bonus", "Sumber Data"];
        $attsreg = ["registration_id", "sales_username", "broker", "paket", "registration_type", "registration_date", "jenis", "nominal", "percentage", "comission_for_sales", "paid", "paid_date", "debt", "frekuensi", "keterangan_ref", "message", "start_date", "bulan_member", "expired_date", "bonus_member_day", "expired_date_bonus", "sumber_data"];
        //ADD TRANSAKSI
        $insreg = ["Registration Date", "Kode Paket", "Sales Username", "Registration Type", "Start Date", "Bulan Member", "Bonus Member", "Sumber Data", "Broker", "Message", "Jenis", "Nominal Member", "Percentage", "Paid", "Paid Date", "Debt", "Frekuensi"];
        //Return view profile dengan parameter
        return view('profile\profile', ['route'=>'AClub', 'client'=>$aclub, 'heads'=>$heads, 'ins'=>$ins, 'clientsreg'=>$clientsreg, 'insreg'=>$insreg, 'attsreg'=>$attsreg, 'headsreg'=>$headsreg]);
    }

    public function editClient(Request $request) {
        //Validasi input
        $this->validate($request, [
                'all_pc_id' => 'required',
                'user_id' => 'required',
                'fullname' => 'required',
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
            //Edit atribut AClub
            DB::select("call edit_aclub(?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->all_pc_id, $request->user_id, $this->nullify($request->interest_and_hobby), $this->nullify($request->trading_experience_year), $this->nullify($request->your_stock_future_broker), $this->nullify($request->annual_income), $this->nullify($request->security_question), $this->nullify($request->security_answer), $this->nullify($request->status), $this->nullify($request->keterangan), $this->nullify($request->website), $this->nullify($request->state), $this->nullify($request->occupation)]);
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
                'user_id' => 'required',
                'nama' => 'required',
                'email' => 'email',
                'no_hp' => 'required',
                'alamat' => 'required',
            ]);

        //Inisialisasi array error
        DB::beginTransaction();
        $err = [];
        try {
            //Input data ke SQL
             DB::select("call inputaclub_member(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->user_id, $request->nama, $request->no_hp, $this->nullify($request->no_telepon), $request->alamat, $this->nullify($request->kota), $this->nullify($request->provinsi), $request->email, $this->nullify($request->tanggal_lahir), $this->nullify($request->line_id), $this->nullify($request->pin_bb), $this->nullify($request->facebook), $this->nullify($request->twitter), $this->nullify($request->jenis_kelamin), $this->nullify($request->occupation), $this->nullify($request->website), $this->nullify($request->state), $this->nullify($request->interest_and_hobby), $this->nullify($request->trading_experience_year), $this->nullify($request->your_stock_and_future_broker), $this->nullify($request->annual_income), $this->nullify($request->status), $this->nullify($request->keterangan),$this->nullify($request->security_question), $this->nullify($request->security_answer)]);
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
            DB::select("call delete_aclub(?)", [$id]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        return redirect("home");
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

    public function deleteTrans($id){
        echo ($id);
        $err = [];
        try{
            DB::select("call delete_aclub_registration_alt(?)", [$id]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        
        return redirect()->back()->withErrors($err);
    }

    public function importExcel() {
        //Inisialisasi array error
        $err = [];
        if(Input::hasFile('import_file')){ //Mengecek apakah file diberikan
            $path = Input::file('import_file')->getRealPath(); //Mendapatkan path
            $data = Excel::load($path, function($reader) { //Load excel
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

                //Jika tidak ada error, import dengan cara insert satu per satu
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
        return redirect()->back()->withErrors([$err]);
    }
}