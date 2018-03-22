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

        //Form master client
        $ins = ["User ID Redclub",
                "Password Redclub",
                "Telepon",
                "Email",
                "Tanggal Lahir",
                "Alamat",
                "Provinsi",
                "Kota",
                "Gender",
                "Line ID",
                "BBM",
                "Whatsapp",
                "Facebook"];

        //ACLUB exclusive form
        $aclubforms = ["User ID",
                        "Payment Date",
                        "Sumber Data",
                        "Sales",
                        "Kode",
                        "Status",
                        "Nominal",
                        "Start Date",
                        "Expired Date",
                        "Masa Tenggang",
                        "Yellow Zone",
                        "Red Zone",
                        "Keterangan"];

        //UOB exclusive form
        $uobforms = ["Kode Client", 
                "Sales", 
                "Tanggal Join", 
                "Nomer KTP", 
                "Expired KTP", 
                "Nomer NPWP", 
                "Alamat Surat", 
                "Saudara Tidak Serumah", 
                "Ibu Kandung",
                "Bank Pribadi",
                "Nomer Rekening Pribadi",
                "Sumber Data",
                "Keterangan"];

        //MRG exclusive form
        $mrgforms = ["Sales",
                    "Tanggal Join", 
                    "Account Number", 
                    "Account Type", 
                    "Sumber Data"
                    ];
        
        //CAT exclusive form
        $catforms = ["User ID", 
                    "Batch", 
                    "Nomer Induk", 
                    "Sales", 
                    "Sumber Data",
                    "DP Date",
                    "DP Nominal",
                    "Opening Class",
                    "Status",
                    "Keterangan"];
       
        return view('content/addclient', 
            ['clients' => $clients, 
                'ins'=>$ins, 'aclub' => $aclubforms, 'uob' => $uobforms, 
                'mrg' => $mrgforms, 'cat' => $catforms]
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
        }

        return redirect("home");
    }

    
    public function getClientInfo(Request $request) {
        // $dummy = DB::select("select * from master_clients where master_id = " . $request['id']);
        // dd($dummy);
        $dummy = MasterClient::where('master_id',$request['id'])->get();

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
        $ins = ["Master ID", "No Telepon", "Alamat", "Kota", "Provinsi", "Email", "Tanggal Lahir", "Line ID", "Pin BB", "Facebook", "Whatsapp", "Jenis Kelamin"];
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
           'redclub_user_id' => '',
            'name' => '',
            'telephone_number' => '',
            'email' => 'required|email|unique:master_clients',
            'birthdate' => 'date',
            'address' => '',
            'city' => '',
            'province' => '',
            'gender' => '',
            'line_id' => '',
            'bbm' => '',
            'whatsapp' => '',
            'facebook' => '',
        ]);

        $master = new \App\MasterClient;

        $master->redclub_user_id = $request->user_id_redclub;
        $master->redclub_password = $request->password_redclub;
        $master->name = $request->nama;
        $master->telephone_number = $request->telepon;
        $master->email = $request->email;
        $master->birthdate = $request->tanggal_lahir;
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
            $this->id = $master->master_id;
        }
    }

    public function autoFill(Request $request) {
        
    }

    public function addCAT(Request $request) {
        $this->validate($request, [
            'master_id' => 'required',
            'user_id_cat' => 'required|unique:cats,user_id',
            'nomer_induk' => 'required|unique:cats,nomor_induk',
            'batch' => '',
            'sales_cat' => '',
            'sumber_data_cat' => '',
            'dp_date' => 'date',
            'dp_nominal' => 'integer',
            'opening_class' => 'date',
            'status_cat' => '',
            'keterangan_cat' => ''
        ]);

        $cat = new \App\Cat;

        if ($request->master == 0) {
            $cat->master_id = $this->id;
        } else {
            $cat->master_id = $request->master_id;
        }
        $cat->user_id = $request->user_id_cat;
        $cat->nomor_induk = $request->nomer_induk;
        $cat->batch = $request->batch;
        $cat->sales_name = $request->sales_cat;
        $cat->sumber_data = $request->sumber_data_cat;
        $cat->DP_date = $request->dp_date;
        $cat->DP_nominal = $request->dp_nominal;
        $cat->tanggal_opening_class = $request->opening_class;
        $cat->status = $request->status_cat;
        $cat->keterangan = $request->keterangan_cat;

        $cat->save();

        return redirect()->back();
    }

    public function addUOB(Request $request) {
        $this->validate($request, [
            'master_id' => 'required',
            'kode_client' => 'required|unique:uobs,client_id',
            'sales_uob' => '',
            'sumber_data_uob' => '',
            'tanggal_join_uob' => 'date',
            'nomer_ktp' => 'string:20',
            'expired_ktp' => 'date',
            'nomer_npwp' => 'string:40',
            'alamat_surat' => '',
            'saudara_tidak_serumah' => '',
            'ibu_kandung' => '',
            'bank_pribadi' => '',
            'nomer_rekening_pribadi' => 'string:50',
            'keterangan_uob' => ''
        ]);

        $uob = new \App\Uob;

        if ($request->master == 0) {
            $uob->master_id = $this->id;
        } else {
            $uob->master_id = $request->master_id;
        }
        $uob->client_id = $request->kode_client;
        $uob->sales_name = $request->sales_uob;
        $uob->sumber_data = $request->sumber_data_uob;
        $uob->join_date = $request->tanggal_join_uob;
        $uob->nomor_ktp = $request->nomer_ktp;
        $uob->tanggal_expired_ktp = $request->expired_ktp;
        $uob->nomor_npwp = $request->nomer_npwp;
        $uob->alamat_surat = $request->alamat_surat;
        $uob->saudara_tidak_serumah = $request->saudara_tidak_serumah;
        $uob->nama_ibu_kandung = $request->ibu_kandung;
        $uob->bank_pribadi = $request->bank_pribadi;
        $uob->nomor_rekening_pribadi = $request->nomer_rekening_pribadi;
        $uob->sumber_data = $request->sumber_data_uob;
        $uob->keterangan = $request->keterangan_uob;

        $uob->save();

        return redirect()->back();
    }

    public function addMRG(Request $request) {
        $this->validate($request, [
            'master_id' => 'required',
            'sumber_data_mrg' => '',
            'tanggal_join_mrg' => 'date',
            "account_number" => 'required|unique:mrg_accounts,accounts_number|string:20', 
            "account_type" => 'string:20', 
            "sales_mrg" => ''
        ]);

        $mrgforms = ["Sales",
                    "Tanggal Join", 
                    "Account Number", 
                    "Account Type", 
                    "Sumber Data"
                    ];

        $mrg = new \App\Mrg;

        if ($request->master == 0) {
            $mrg->master_id = $this->id;
        } else {
            $mrg->master_id = $request->master_id;
        }
        $mrg->sumber_data = $request->sumber_data_mrg;
        $mrg->join_date = $request->tanggal_join_mrg;

        $mrg_account = new \App\MrgAccount;

        if ($request->master == 0) {
            $mrg_account->master_id = $this->id;
        } else {
            $mrg_account->master_id = $request->master_id;
        }
        $mrg_account->accounts_number = $request->account_number;
        $mrg_account->account_type = $request->account_type;
        $mrg_account->sales_name = $request->sales_mrg;

        $mrg->save();
        $mrg_account->save();

        return redirect()->back();
    }

    public function addAClub(Request $request) {
        $this->validate($request, [
            'user_id_aclub' => 'required|unique:aclub_members,user_id|string:50',
            'payment_date' => 'date',
            'sales_aclub' => '',
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
        ]);

        $errors = [];

        $aclubInfo = new \App\AclubInformation;
        if ($request->master == 0) {
            $aclubInfo->master_id = $this->id;
        } else {
            $aclubInfo->master_id = $request->master_id;
        }
        $aclubInfo->sumber_data = $request->sumber_data_aclub;
        $aclubInfo->keterangan = $request->keterangan_aclub;

        $aclubInfo->save();

        $aclubMember = new \App\AclubMember;

        if ($request->master == 0) {
            $aclubMember->master_id = $this->id;
        } else {
            $aclubMember->master_id = $request->master_id;
        }
        $aclubMember->user_id = $request->user_id_aclub;

        $aclubMember->save();

        $aclubTrans = new \App\AclubTransaction;
        $aclubTrans->user_id = $request->user_id_aclub;
        $aclubTrans->payment_date = $request->payment_date;
        $aclubTrans->sales_name = $request->sales_aclub;
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
}