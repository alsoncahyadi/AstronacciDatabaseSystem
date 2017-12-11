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
use App\Uob;

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
        $ins= ["Master ID"=> "master_id",
                "User ID Redclub" => "redclub_user_id",
                "Password Redclub" => "redclub_password",
                "Nama" => "name",
                "Telephone" => "telephone_number",
                "Email" => "email",
                "Tanggal Lahir" => "birthdate",
                "Alamat" => "address",
                "Kota" => "city",
                "Provinsi" => "province",
                "Gender" => "gender",
                "Line ID" => "line_id",
                "BBM" => "bbm",
                "WhatsApp" => "whatsapp",
                "Facebook" => "facebook"];
        //Untuk input pada database, ditambahkan PC ID yang tidak ada pada form
        $heads = $ins;
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
                'master_id' => '',
                'redclub_user_id' => '',
                'name' => '',
                'telephone_number' => '',
                'email' => '',
                'birthdate' => '',
                'address' => '',
                'city' => '',
                'province' => '',
                'gender' => '',
                'line_id' => '',
                'bbm' => '',
                'whatsapp' => '',
                'facebook' => '',
            ]);
        $err = [];

        try {
            $master = MasterClient::find($request->user_id);

            $master->master_id = $request->master_id;
            $master->redclub_user_id = $request->redclub_user_id;
            $master->name = $request->name;
            $master->telephone_number = $request->telephone_number;
            $master->email = $request->email;
            $master->birthdate = $request->birthdate;
            $master->address = $request->address;
            $master->city = $request->city;
            $master->province = $request->province;
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
        $ins_master = ["Master ID"=> "master_id",
                "User ID Redclub" => "redclub_user_id",
                "Password Redclub" => "redclub_password",
                "Nama" => "name",
                "Telephone" => "telephone_number",
                "Email" => "email",
                "Tanggal Lahir" => "birthdate",
                "Alamat" => "address",
                "Kota" => "city",
                "Provinsi" => "province",
                "Gender" => "gender",
                "Line ID" => "line_id",
                "BBM" => "bbm",
                "WhatsApp" => "whatsapp",
                "Facebook" => "facebook"];
        //Untuk input pada database, ditambahkan PC ID yang tidak ada pada form
        $heads_master = $ins_master;

        //CAT
        $client_cat = Cat::where('master_id', $id)->first();

        if ($client_cat == null) {
            $client_cat = Cat::first();
        }

        $ins_cat = ["User ID" => "user_id",
                "Nomor Induk" => "nomor_induk",
                "Batch" => "batch",
                "Sales" => "sales_name",
                ];

        $heads_cat = $ins_cat;

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
        $client_uob = Uob::where('master_id', $id)->first();

        if ($client_uob == null) {
            $client_uob = Uob::first();
        }

        $ins_uob = [
                "Kode Client" => "client_id",
                "Master ID" => "master_id",
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

        $heads_uob = $ins_uob;

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
            $client_mrg = Mrg::first();
        }

        $ins_mrg = ["Sumber Data (MRG)" => "sumber_data",
                "Join Date (MRG)" => "join_date",
                "Sales" => "sales_name"];

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
            $client_aclub = AclubInformation::first();
        }

        $aclub_master = $client_aclub->master;

        $ins_aclub = ["Master_id" => "master_id", 
                "Sumber Data" => "sumber_data", 
                "Keterangan" => "keterangan"];

        $heads_aclub = $ins_aclub;

        $clientsreg_aclub= $aclub_master->aclubMembers()->get();

        $headsreg_aclub = ["User ID",
                    "Group"];

        $attsreg_aclub = ["user_id", "group"];

        $insreg_aclub = ["User ID" => "user_id",
                    "Group" => "group",
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


        return view('profile/pcdetail', [
            'client_master'=>$client_master, 'cat'=> $cat, 'mrg'=> $mrg, 'aclub'=> $aclub , 'uob'=> $uob, 'heads_master'=>$heads_master, 'ins_master'=>$ins_master,
            'client_cat'=>$client_cat, 'heads_cat'=>$heads_cat, 'ins_cat'=>$ins_cat, 'insreg_cat'=>$insreg_cat, 'headsreg_cat'=>$headsreg_cat,
            'client_uob'=>$client_uob, 'heads_uob'=>$heads_uob, 'ins_uob'=>$ins_uob, 'insreg_uob'=>$insreg_uob, 'headsreg_uob'=>$headsreg_uob,
            'client_mrg'=>$client_mrg, 'heads_mrg'=>$heads_mrg, 'ins_mrg'=>$ins_mrg, 'insreg_mrg'=>$insreg_mrg, 'headsreg_mrg'=>$headsreg_mrg, 'clientsreg_mrg'=>$clientsreg_mrg, 
            'client_aclub'=>$client_aclub, 'heads_aclub'=>$heads_aclub, 'ins_aclub'=>$ins_aclub, 'insreg_aclub'=>$insreg_aclub, 'headsreg_aclub'=>$headsreg_aclub, 'attsreg_aclub'=>$attsreg_aclub, 'clientsreg_aclub'=>$clientsreg_aclub]);
    }
}
