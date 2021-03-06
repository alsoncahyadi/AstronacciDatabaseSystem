<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Excel;
use App\MasterClient;
use App\Cat;
use App\Mrg;
use App\AclubInformation;
use App\AlubTransactions;
use App\Uob;
use App\Http\QueryModifier;

class DetailController extends Controller
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

    public function clientDetail($id) {
        //Select seluruh data client $id yang ditampilkan di detail
        $master = MasterClient::where('master_id', $id)->first();
        $aclub = $master->aclubInformation;
        $mrg = $master->mrg;
        $uob = $master->uob;
        $cat = $master->cat;

        //Nama atribut form yang ditampilkan dan nama pada SQL
        $ins= [
                "User ID Redclub" => "redclub_user_id",
                "Password Redclub" => "redclub_password",
                "Nama" => "name",
                "Telephone" => "telephone_number",
                "Email" => "email",
                "Tanggal Lahir" => "birthdate",
                "Alamat" => "address",
                "Provinsi" => "province",
                "Kota" => "city",
                "Gender" => "gender",
                "Line ID" => "line_id",
                "BBM" => "bbm",
                "WhatsApp" => "whatsapp",
                "Facebook" => "facebook"];
        //Untuk input pada database, ditambahkan PC ID yang tidak ada pada form
        $heads = ["Master ID"=> "master_id",
                "User ID Redclub" => "redclub_user_id",
                "Password Redclub" => "redclub_password",
                "Nama" => "name",
                "Telephone" => "telephone_number",
                "Email" => "email",
                "Tanggal Lahir" => "birthdate",
                "Alamat" => "address",
                "Provinsi" => "province",
                "Kota" => "city",
                "Gender" => "gender",
                "Line ID" => "line_id",
                "BBM" => "bbm",
                "WhatsApp" => "whatsapp",
                "Facebook" => "facebook"];
        $insreg = ["Cuki"];
        //dd($cat);   
		return view('profile/pcdetail', ['route'=>'detail', 'client'=>$master, 'heads'=>$heads, 'ins'=>$ins, 'insreg'=>$insreg, 'cat'=> $cat, 'mrg'=> $mrg, 'aclub'=> $aclub , 'uob'=> $uob]);
    }
  
    public function deleteClient($id) {
        //Menghapus client dengan ID tertentu
        try {
            $master = MasterClient::find($id);
            $master->delete();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect("home");
    }
  
    public function editClient(Request $request) {
         $this->validate($request, [
                'redclub_user_id' => '',
                'name' => '',
                'telephone_number' => '',
                'email' => 'required|email',
                'birthdate' => 'date',
                'address' => '',
                'province' => '',
                'city' => '',
                'gender' => '',
                'line_id' => '',
                'bbm' => '',
                'whatsapp' => '',
                'facebook' => '',
            ]);
        $err = [];

        try {
            $master = MasterClient::find($request->user_id);

            $master->redclub_user_id = $request->redclub_user_id;
            $master->name = $request->name;
            $master->telephone_number = $request->telephone_number;
            $master->email = $request->email;
            $master->birthdate = $request->birthdate;
            $master->address = $request->address;
            $master->province = $request->province;
            $master->city = $request->city;
            $master->gender = $request->gender;
            $master->line_id = $request->line_id;
            $master->bbm = $request->bbm;
            $master->whatsapp = $request->whatsapp;
            $master->facebook = $request->facebook;

            $master->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect()->back()->withErrors($err);
    }

    public function allPCDetail($id)
    {
        //Master
        $client_master = MasterClient::where('master_id', $id)->first();
        $aclub = $client_master->aclubInformation;
        $mrg = $client_master->mrg;
        $uob = $client_master->uob;
        $cat = $client_master->cat;

        //Nama atribut form yang ditampilkan dan nama pada SQL
        $ins_master = [
                "User ID Redclub" => ["redclub_user_id", 0],
                "Password Redclub" => ["redclub_password", 0],
                "Nama" => ["name", 0],
                "Telephone" => ["telephone_number",0],
                "Email" => ["email",1],
                "Tanggal Lahir" => ["birthdate",0],
                "Alamat" => ["address",0],
                "Provinsi" => ["province",0],
                "Kota" => ["city",0],
                "Gender" => ["gender",0],
                "Line ID" => ["line_id",0],
                "BBM" => ["bbm",0],
                "WhatsApp" => ["whatsapp",0],
                "Facebook" => ["facebook",0]];
        //Untuk input pada database, ditambahkan PC ID yang tidak ada pada form
        $heads_master = ["Master ID"=> "master_id",
                "User ID Redclub" => "redclub_user_id",
                "Password Redclub" => "redclub_password",
                "Nama" => "name",
                "Telephone" => "telephone_number",
                "Email" => "email",
                "Tanggal Lahir" => "birthdate",
                "Alamat" => "address",
                "Provinsi" => "province",
                "Kota" => "city",
                "Gender" => "gender",
                "Line ID" => "line_id",
                "BBM" => "bbm",
                "WhatsApp" => "whatsapp",
                "Facebook" => "facebook"];

        //CAT
        $query_cat = QueryModifier::queryGetCat($id);
        $client_cat = collect(DB::select($query_cat))->first();

        if ($client_cat == null) {
            $client_cat = new \App\Cat();

            $client_cat->user_id = 'dummy';
            $client_cat->nomor_induk = 'dummy';
            $client_cat->master_id = MasterClient::first()->master_id;
        }

        $ins_cat = [
                "Batch" => "batch",
                "Sales" => "sales_name",
                "Sumber Data" => "sumber_data"
                ];

        $heads_cat = ["User ID" => "user_id",
                "Batch" => "batch",
                "Sales" => "sales_name",
                "Sumber Data" => "sumber_data"
                ];

        $insreg_cat = [ "Nomer Induk" => 'nomor_induk',
                    "DP Date" => 'DP_date',
                    "DP Nominal" => 'DP_nominal',
                    "Payment Date" => 'payment_date',
                    "Payment Nominal" => 'payment_nominal',
                    "Opening Class" => "tanggal_opening_class",
                    "End Class" => 'tanggal_end_class',
                    "Ujian" => 'tanggal_ujian',
                    "Status" => 'status',
                    "Keterangan" => 'keterangan'
                    ];

        $headsreg_cat = [   "Nomer Induk" => 'nomor_induk',
                        "DP Date" => 'DP_date',
                        "DP Nominal" => 'DP_nominal',
                        "Payment Date" => 'payment_date',
                        "Payment Nominal" => 'payment_nominal',
                        "Opening Class" => "tanggal_opening_class",
                        "End Class" => 'tanggal_end_class',
                        "Ujian" => 'tanggal_ujian',
                        "Status" => 'status',
                        "Keterangan" => 'keterangan'
                    ];


        //UOB
        $query_uob = QueryModifier::queryGetUob($id);
        $client_uob = collect(DB::select($query_uob))->first();
        // $client_uob = Uob::where('master_id', $id)->first();

        if ($client_uob == null) {
            $client_uob = new \App\Uob();

            $client_uob->client_id = 'dummy';
            $client_uob->master_id = MasterClient::first()->master_id;
        }

        $ins_uob = [
                "Sales" => "sales_name",
                "Sumber Data" => "sumber_data",
                "Tanggal Join" => "join_date",
                "Nomor KTP" => "nomor_ktp",
                "Expired KTP" => "tanggal_expired_ktp",
                "Nomor NPWP" => "nomor_npwp",
                "Alamat Surat Menyurat" => "alamat_surat",
                "Saudara Tidak Serumah" => "saudara_tidak_serumah",
                "Nama Ibu Kandung" => "nama_ibu_kandung",
            ];

        $heads_uob = [
                "Kode Client" => "client_id",
                "Sales" => "sales_name",
                "Sumber Data" => "sumber_data",
                "Tanggal Join" => "join_date",
                "Nomor KTP" => "nomor_ktp",
                "Expired KTP" => "tanggal_expired_ktp",
                "Nomor NPWP" => "nomor_npwp",
                "Alamat Surat Menyurat" => "alamat_surat",
                "Saudara Tidak Serumah" => "saudara_tidak_serumah",
                "Nama Ibu Kandung" => "nama_ibu_kandung",
            ];

        $insreg_uob = ["Bank Pribadi" => "bank_pribadi",
                        "Nomor Rekening Pribadi" => "nomor_rekening_pribadi",
                        "Tanggal RDI Done" => 'tanggal_rdi_done',
                        "RDI Bank" => "rdi_bank",
                        "Nomor RDI" => 'nomor_rdi',
                        "Tanggal Top Up" => 'tanggal_top_up',
                        "Nominal Top Up" => 'nominal_top_up',
                        "Tanggal Trading" => 'tanggal_trading',
                        "Status" => 'status',
                        "Trading Via" => 'trading_via',
                        "Keterangan" => 'keterangan'];

        $headsreg_uob = [  "Bank Pribadi" => "bank_pribadi",
                        "Nomor Rekening Pribadi" => "nomor_rekening_pribadi",
                        "Tanggal RDI Done" => 'tanggal_rdi_done',
                        "RDI Bank" => "rdi_bank",
                        "Nomor RDI" => 'nomor_rdi',
                        "Tanggal Top Up" => 'tanggal_top_up',
                        "Nominal Top Up" => 'nominal_top_up',
                        "Tanggal Trading" => 'tanggal_trading',
                        "Status" => 'status',
                        "Trading Via" => 'trading_via',
                        "Keterangan" => 'keterangan',
                    ];

        //MRG
        $client_mrg = Mrg::where('master_id', $id)->first();

        if ($client_mrg == null) {
            $client_mrg = new \App\Mrg();

            $client_mrg->master_id = MasterClient::first()->master_id;
        }

        $ins_mrg = ["Sumber Data MRG" => "sumber_data",
                "Join Date MRG" => "join_date"];

        $heads_mrg = $ins_mrg;

        $insreg_mrg = ["Account Number" => "accounts_number",
                        "Account Type" => "account_type",
                        "Sales Name" => "sales_name"];

        $clientsreg_mrg = $client_mrg->accounts()->get();
        
        $headsreg_mrg = ["Account Number" => "accounts_number",
                        "Account Type" => "account_type",
                        "Sales Name" => "sales_name"];

        //ACLUB
        $client_aclub = AclubInformation::find($id);

        if ($client_aclub == null) {
            $client_aclub = new \App\AclubInformation();

            $client_aclub->master_id = MasterClient::first()->master_id;
        }

        $ins_aclub = [
                "Sumber Data" => "sumber_data", 
                "Keterangan" => "keterangan"];

        $heads_aclub = [ 
                "Sumber Data" => "sumber_data", 
                "Keterangan" => "keterangan",
                "User ID" => "user_id"];

        // $clientsreg_aclub= $aclub_master->aclubMembers()->get();
        if ($client_aclub->aclubMembers()->first() == null) {
            $clientsreg_aclub = null;
            $client_aclub->user_id = 'dummy';
        } else {
            $query_member = QueryModifier::queryGetAclubMember($client_aclub->master_id);
            $aclub_members = collect(DB::select($query_member))->first();
            $query = QueryModifier::queryGetTransactions($aclub_members->user_id);
            $clientsreg_aclub = DB::select($query);
            $client_aclub->user_id = $clientsreg_aclub[0]->user_id;     
        }
        
        
        $headsreg_aclub = [ "Payment Date",
                            "Kode",
                            "Status",
                            "Nominal",
                            "Start Date",
                            "Expired Date",
                            "Masa Tenggang"];
        $attsreg_aclub = ["payment_date", 
                          "kode", 
                          "status", 
                          "nominal", 
                          "start_date", 
                          "expired_date", 
                          "masa_tenggang"];

        // dd($clientsreg_aclub);

        $insreg_aclub = [
                    "Sales Name" => "sales_name",
                    "Payment Date" => "payment_date",
                    "Kode" => "kode",
                    "Status" => "status",
                    "Nominal" => "nominal",
                    "Start Date" => "start_date",
                    "Expired Date" => "expired_date",
                    "Masa Tenggang" => "masa_tenggang",
                    "Red Zone" => "red_zone",
                    "Yellow Zone" => "yellow_zone"];

        // Pilihan Kota
        $city = [];
        $row = 1;
        if (($handle = fopen("kota.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                if (array_key_exists($data[0], $city)) {
                    array_push($city[$data[0]], $data[1]);
                } else {
                    $city[$data[0]] = array($data[1]);
                }
            }
            fclose($handle);
        }

        return view('profile/pcdetail', [
            'client_master'=>$client_master, 'cat'=> $cat, 'mrg'=> $mrg, 'aclub'=> $aclub , 'uob'=> $uob, 'heads_master'=>$heads_master, 'ins_master'=>$ins_master,
            'client_cat'=>$client_cat, 'heads_cat'=>$heads_cat, 'ins_cat'=>$ins_cat, 'insreg_cat'=>$insreg_cat, 'headsreg_cat'=>$headsreg_cat,
            'client_uob'=>$client_uob, 'heads_uob'=>$heads_uob, 'ins_uob'=>$ins_uob, 'insreg_uob'=>$insreg_uob, 'headsreg_uob'=>$headsreg_uob,
            'client_mrg'=>$client_mrg, 'heads_mrg'=>$heads_mrg, 'ins_mrg'=>$ins_mrg, 'insreg_mrg'=>$insreg_mrg, 'headsreg_mrg'=>$headsreg_mrg, 'clientsreg_mrg'=>$clientsreg_mrg, 
            'client_aclub'=>$client_aclub, 'heads_aclub'=>$heads_aclub, 'ins_aclub'=>$ins_aclub, 'insreg_aclub'=>$insreg_aclub, 'headsreg_aclub'=>$headsreg_aclub, 'attsreg_aclub'=>$attsreg_aclub, 'clientsreg_aclub'=>$clientsreg_aclub, 'city' => $city]);
    }
}
