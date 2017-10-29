<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\MasterClient;
use Excel;
use DB;
use App\Cat;
use App\Mrg;
use App\Uob;
use App\AclubMember;
class MockupController extends Controller
{
    private $id;

    public function index()
    {
        $clients = MasterClient::all();
        //Data untuk insert
        $ins = ["Red Club User ID", "Red Club Password", "Nama", "No Telepon", "Email", "Birthdate", "Alamat", "Kota", "Provinsi", "Gender", "Line ID", "BBM", "Whatsapp", "Facebook"];
        //ACLUB exclusive form
        $aclubforms = ["User ID",
                        "Payment Date",
                        "Group",
                        "Sales Name",
                        "Kode",
                        "Status",
                        "Nominal",
                        "Start Date",
                        "Expired Date",
                        "Masa Tenggang",
                        "Yellow Zone",
                        "Red Zone",
                        "Sumber Data",
                        "Keterangan"];

        //UOB exclusive form
        $uobforms = ["Client ID", 
                "Sales Name", 
                "Tanggal Join", 
                "Nomor KTP", 
                "Tanggal Expired KTP", 
                "Nomor NPWP", 
                "Alamat Surat", 
                "Saudara Tidak Serumah", 
                "Nama Ibu Kandung",
                "Bank Pribadi",
                "Nomer Rekening Pribadi",
                "Sumber Data",
                "Keterangan"];

        //MRG exclusive form
        $mrgforms = ["Sumber Data", 
                    "Tanggal Join", 
                    "Account Number", 
                    "Account Type", 
                    "Sales Name"];
        
        //CAT exclusive form
        $catforms = ["User ID", 
                    "Nomor Induk", 
                    "Batch", 
                    "Sales", 
                    "Sumber Data",
                    "DP Date",
                    "DP Nominal",
                    "Opening Class",
                    "Status",
                    "Keterangan"];

        //AShop exclusive form
        $ashopforms = ["Product Type", 
                    "Product Name", 
                    "Nominal"];
       
        return view('content/addclient', 
            ['clients' => $clients, 
                'ins'=>$ins, 'aclub' => $aclubforms, 'uob' => $uobforms, 
                'mrg' => $mrgforms, 'cat' => $catforms, 'ashop' => $ashopforms]
            );
    }

     public function addClient(Request $request) {
        if ($request->master == 0) {
            $this->addMaster($request);
        }

        if ($request->flag == 'cat') {
            $this->addCAT($request);
        } else if ($request->flag == 'uob') {
            $this->addUOB($request);
        } else if ($request->flag == 'mrg') {
            $this->addMRG($request);
        } else if ($request->flag == 'aclub') {
            $this->addAclub($request);
        } else if ($request->flag == 'ashop') {
            $this->addAShop($request);
        }
    }

    
    public function getClientInfo(Request $request) {
        $dummy = DB::select("select * from master_clients where master_id = " . $request['id']);

        //$iscat = DB::select("select * from ");
        $iscat = count(Cat::where("master_id", $request['id'])->get());
        if ($iscat > 0) $iscat = 1;

        $ismrg = count(Mrg::where("master_id", $request['id'])->get());
        if ($ismrg > 0) $ismrg = 1;

        $isuob = count(Uob::where("master_id", $request['id'])->get());
        if ($isuob > 0) $isuob = 1;

        $isacl = count(AclubMember::where("master_id", $request['id'])->get());
        if ($isacl > 0) $isacl = 1;
        
        //Data untuk insert
        $ins = ["User ID", "No Telepon", "Alamat", "Kota", "Provinsi", "Email", "Tanggal Lahir", "Line ID", "Pin BB", "Facebook", "Whatsapp", "Jenis Kelamin"];
        //Nama kolom
        $colname = ["master_id", "telephone_number", "address", "city", "province", "email", "birthdate", "line_id", "bbm", "facebook", "whatsapp", "gender"];
        //Return view table dengan parameter
        return view('content/clientdetail', 
            ['colname' => $colname, 'ins'=>$ins, 'dummy' => $dummy, 
            'iscat' => $iscat, 'ismrg' => $ismrg, 'isuob' => $isuob, 'isacl' => $isacl]
            );
        //return $request['id'];
    }

    public function addMaster(Request $request) {
        $this->validate($request, [
            'red_club_user_id' => 'string:100',
            'red_club_password' => '',
            'nama' => 'string:100',
            'no_telepon' => 'string:50',
            'email' => 'required|string:255',
            'birthdate' => 'date',
            'alamat' => 'string:100',
            'kota' => 'string:100',
            'provinsi' => 'string:100',
            'gender' => '',
            'line_id' => 'string:20',
            'bbm' => 'string:20',
            'whatsapp' => 'string:20',
            'facebook' => 'string:20',
        ]);

        $master = new \App\MasterClient;

        $master->redclub_user_id = $request->red_club_user_id;
        $master->redclub_password = $request->red_club_password;
        $master->name = $request->nama;
        $master->telephone_number = $request->no_telepon;
        $master->email = $request->email;
        $master->birthdate = $request->birthdate;
        $master->address = $request->alamat;
        $master->city = $request->kota;
        $master->province = $request->provinsi;
        $master->gender = $request->gender;
        $master->line_id = $request->line_id;
        $master->bbm = $request->bbm;
        $master->whatsapp = $request->whatsapp;
        $master->facebook = $request->facebook;

        $master->save();

        if ($request->master == 0) {
            $this->id = $master->id;
        }
    }

    public function autoFill(Request $request) {
        
    }

    public function addCAT(Request $request) {
        $this->validate($request, [
            'master_id' => '',
            'user_id_cat' => 'required|string:50',
            'nomor_induk' => 'required|string:50',
            'batch' => 'string:20',
            'sales' => 'string:100',
            'sumber_data_cat' => 'string:20',
            'dp_date' => 'date',
            'dp_nominal' => 'integer',
            // 'tanggal_payment' => 'date',
            // 'nominal_payment' => 'integer',
            'opening_class' => 'date',
            // 'tanggal_end_class' => 'date|after:tanggal_opening_class',
            // 'tanggal_ujian' => 'date',
            'status_cat' => 'string:20',
            'keterangan_cat' => ''
        ]);

        $cat = new \App\Cat;

        if ($request->master == 0) {
            $cat->master_id = $this->id;
        } else {
            $cat->master_id = $request->master_id;
        }
        $cat->user_id = $request->user_id_cat;
        $cat->nomor_induk = $request->nomor_induk;
        $cat->batch = $request->batch;
        $cat->sales_name = $request->sales;
        $cat->sumber_data = $request->sumber_data;
        $cat->DP_date = $request->dp_date;
        $cat->DP_nominal = $request->dp_nominal;
        // $cat->payment_date = $request->tanggal_payment;
        // $cat->payment_nominal = $request->nominal_payment;
        $cat->tanggal_opening_class = $request->opening_class;
        // $cat->tanggal_end_class = $request->tanggal_end_class;
        // $cat->tanggal_ujian = $request->tanggal_ujian;
        $cat->status = $request->status_cat;
        $cat->keterangan = $request->keterangan_cat;

        $cat->save();

        return redirect()->back();
    }

    public function addUOB(Request $request) {
        $this->validate($request, [
            'master_id' => '',
            'client_id' => 'required|string:50',
            'sales_name_uob' => 'required',
            'sumber_data_uob' => 'required',
            'tanggal_join' => 'required|date',
            'nomor_ktp' => 'required|string:20',
            'tanggal_expired_ktp' => 'required|date',
            'nomor_npwp' => 'required|string:40',
            'alamat_surat' => 'required',
            'saudara_tidak_serumah' => 'required',
            'nama_ibu_kandung' => 'required',
            'bank_pribadi' => 'required',
            'nomer_rekening_pribadi' => 'required|string:50',
            // 'tanggal_rdi_done' => 'required|date',
            // 'rdi_bank' => 'required|string:20',
            // 'nomor_rdi' => 'required',
            // 'tanggal_top_up' => 'required|date',
            // 'nominal_top_up' =>  'required',
            // 'tanggal_trading' => 'required|date',
            // 'status_uob' => 'required',
            // 'trading_via' => 'required',
            'keterangan_uob' => 'required'
        ]);

        $uob = new \App\Uob;

        if ($request->master == 0) {
            $uob->master_id = $this->id;
        } else {
            $uob->master_id = $request->master_id;
        }
        $uob->client_id = $request->client_id;
        $uob->sales_name = $request->sales_name_uob;
        $uob->sumber_data = $request->sumber_data;
        $uob->join_date = $request->tanggal_join;
        $uob->nomor_ktp = $request->nomor_ktp;
        $uob->tanggal_expired_ktp = $request->tanggal_expired_ktp;
        $uob->nomor_npwp = $request->nomor_npwp;
        $uob->alamat_surat = $request->alamat_surat;
        $uob->saudara_tidak_serumah = $request->saudara_tidak_serumah;
        $uob->nama_ibu_kandung = $request->nama_ibu_kandung;
        $uob->bank_pribadi = $request->bank_pribadi;
        $uob->nomor_rekening_pribadi = $request->nomer_rekening_pribadi;
        $uob->sumber_data = $request->sumber_data_uob;
        // $uob->tanggal_rdi_done = $request->tanggal_rdi_done;
        // $uob->rdi_bank = $request->rdi_bank;
        // $uob->nomor_rdi = $request->nomor_rdi;
        // $uob->tanggal_top_up = $request->tanggal_top_up;
        // $uob->nominal_top_up = $request->nominal_top_up;
        // $uob->tanggal_trading = $request->tanggal_trading;
        // $uob->status = $request->status_uob;
        // $uob->trading_via = $request->trading_via;
        $uob->keterangan = $request->keterangan_uob;

        $uob->save();

        return redirect()->back();
    }

    public function addMRG(Request $request) {
        $this->validate($request, [
            'master_id' => '',
            'sumber_data_mrg' => '',
            'tanggal_join' => 'date',
            "account_number" => 'required|string:20', 
            "account_type" => 'required|string:20', 
            "sales_name_mrg" => 'required|string:255'
        ]);

        $mrg = new \App\Mrg;

        if ($request->master == 0) {
            $mrg->master_id = $this->id;
        } else {
            $mrg->master_id = $request->master_id;
        }
        $mrg->sumber_data = $request->sumber_data_mrg;
        $mrg->join_date = $request->tanggal_join;

        $mrg_account = new \App\MrgAccount;

        if ($request->master == 0) {
            $mrg_account->master_id = $this->id;
        } else {
            $mrg_account->master_id = $request->master_id;
        }
        $mrg_account->accounts_number = $request->account_number;
        $mrg_account->account_type = $request->account_type;
        $mrg_account->sales_name = $request->sales_name_mrg;

        $mrg->save();
        $mrg_account->save();

        return redirect()->back();
    }

    public function addAClub(Request $request) {
        $this->validate($request, [
            'user_id_aclub' => 'required|string:50',
            'payment_date' => 'date',
            'sales_name_aclub' => '',
            'kode' => '',
            'status_aclub' => '',
            'nominal' => '',
            'start_date' => 'date',
            'expired_date' => 'date',
            'masa_tenggang' => 'date',
            'yellow_zone' => 'date',
            'red_zone' => 'date',
            'sumber_data_aclub' => '',
            'keterangan_aclub' => '',
            'group' => ''
        ]);

        $errors = [];

        $aclubMember = new \App\AclubMember;

        if ($request->master == 0) {
            $aclubMember->master_id = $this->id;
        } else {
            $aclubMember->master_id = $request->master_id;
        }
        $aclubMember->user_id = $request->user_id_aclub;
        $aclubMember->group = $request->group;

        $aclubMember->save();

        $aclubInfo = new \App\AclubInformation;
        if ($request->master == 0) {
            $aclubInfo->master_id = $this->id;
        } else {
            $aclubInfo->master_id = $request->master_id;
        }
        $aclubInfo->sumber_data = $request->sumber_data_aclub;
        $aclubInfo->keterangan = $request->keterangan_aclub;

        $aclubInfo->save();

        $aclubTrans = new \App\AclubTransaction;
        $aclubTrans->user_id = $request->user_id_aclub;
        $aclubTrans->payment_date = $request->payment_date;
        $aclubTrans->sales_name = $request->sales_name_aclub;
        $aclubTrans->kode = $request->kode;
        $aclubTrans->status = $request->status_aclub;
        $aclubTrans->nominal = $request->nominal;
        $aclubTrans->start_date = $request->start_date;
        $aclubTrans->expired_date = $request->expired_date;
        $aclubTrans->masa_tenggang = $request->masa_tenggang;
        $aclubTrans->red_zone = $request->red_zone;
        $aclubTrans->yellow_zone = $request->yellow_zone;

        $aclubTrans->save();
        return redirect()->back();
    }

    public function addAShop(Request $request) {
        $this->validate($request, [
            'product_type' => '',
            'product_name' => '',
            'nominal' => ''
        ]);

        $errors = [];

        $ashop = new \App\AshopTransaction;

        if ($request->master == 0) {
            $ashop->master_id = $this->id;
        } else {
            $ashop->master_id = $request->master_id;
        }
        $ashop->product_type = $request->product_type;
        $ashop->product_name = $request->product_name;
        $ashop->nominal = $request->nominal;

        $ashop->save();

        return redirect()->back();
    }
}