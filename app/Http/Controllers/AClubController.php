<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;
use App\AclubInformation;
use App\MasterClient;

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
        $aclub_info = AclubInformation::paginate(15);
        foreach ($aclub_info as $aclub_master) {
            $master = $aclub_master->master;
            $aclub_master->redclub_user_id = $master->redclub_user_id;
            $aclub_master->redclub_password = $master->redclub_password;
            $aclub_master->name = $master->name;
            $aclub_master->telephone_number = $master->telephone_number;
            $aclub_master->email = $master->email;
            $aclub_master->birthdate = $master->birthdate;
            $aclub_master->address = $master->address;
            $aclub_master->city = $master->city;
            $aclub_master->province = $master->province;
            $aclub_master->gender = $master->gender;
            $aclub_master->line_id = $master->line_id;
            $aclub_master->bbm = $master->bbm;
            $aclub_master->whatsapp = $master->whatsapp;
            $aclub_master->facebook = $master->facebook;
        }
        //Daftar username sales
        //$salesusers = DB::select("SELECT sales_username FROM sales");

        //Data untuk insert
        $ins = [];

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["Master ID",
                "RedClub User ID",
                "RedClub Password",
                "Nama",
                "Nomor Telepon",
                "Email",
                "Tanggal Lahir",
                "Alamat",
                "Kota",
                "Provinsi",
                "Gender",
                "Line ID",
                "BBM",
                "WhatsApp",
                "Facebook",
                "Sumber Data (A-Club)",
                "Keterangan (A-Club)"];


        //Nama attribute pada sql
        $atts = ["master_id",
                "redclub_user_id",
                "redclub_password",
                "name",
                "telephone_number",
                "email",
                "birthdate",
                "address",
                "city",
                "province",
                "gender",
                "line_id",
                "bbm",
                "whatsapp",
                "facebook",
                "sumber_data",
                "keterangan"];

        // dd($aclub_info);
        //Return view table dengan parameter
        return view('content/table', ['route' => 'AClub', 'clients' => $aclub_info, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins]);
    }

    public function clientDetail($id) {
        //Select seluruh data client $id yang ditampilkan di detail
        $aclub_master = MasterClient::where('master_id', $id)->first();
        $aclub_information = $aclub_master->aclubInformation;

        $aclub_master->keterangan = $aclub_information->keterangan;
        $aclub_master->sumber_data = $aclub_information->sumber_data;

        //Nama atribut form yang ditampilkan dan nama pada SQL
        $ins= ["Sumber Data (A-Club)"=> "sumber_data",
                "Keterangan (A-Club)"=> "keterangan"];
        $heads = $ins;

        $aclub_members = $aclub_master->aclubMembers()->get();

        // dd($aclub_members);

        return view('profile/profile', ['route'=>'AClub', 'client'=>$aclub_master, 'heads'=>$heads, 'ins'=>$ins]);
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