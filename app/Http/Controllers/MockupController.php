<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\MasterClient;
use Excel;
use DB;
class MockupController extends Controller
{
    private $id;

    public function index()
    {
        $clients = MasterClient::all();
        //Data untuk insert
        $ins = ["Red Club User ID", "Red Club Password", "Nama", "No Telepon", "Email", "Birthdate", "Alamat", "Kota", "Provinsi", "Gender", "Line ID", "BBM", "Whatsapp", "Facebook"];
        //ACLUB exclusive form
        $aclubforms = ["User ID", "Group", "Sumber Data", "Keterangan"];
        //UOB exclusive form
        $uobforms = ["Client ID", "Sales Name", "Sumber Data", "Tanggal Gabung", "Nomor KTP", "Tanggal Expired KTP", "Nomor NPWP", "Alamat Surat", "Saudara Tidak Serumah", "Nama Ibu Kandung"];
        //MRG exclusive form
        $mrgforms = ["Sumber Data", "Tanggal Join"];
        //CAT exclusive form
        $catforms = ["User ID", "Nomor Induk", "Batch", "Sales"];
       
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
    }

    
    public function getClientInfo(Request $request) {
        $dummy = DB::select("select * from master_clients where master_id = " . $request['id']);
        //Data untuk insert
        $ins = ["User ID", "No Telepon", "Alamat", "Kota", "Provinsi", "Email", "Tanggal Lahir", "Line ID", "Pin BB", "Facebook", "Whatsapp", "Jenis Kelamin"];
        //Nama kolom
        $colname = ["master_id", "telephone_number", "address", "city", "province", "email", "birthdate", "line_id", "bbm", "facebook", "whatsapp", "gender"];
        //Return view table dengan parameter
        return view('content/clientdetail', 
            ['colname' => $colname, 'ins'=>$ins, 'dummy' => $dummy]
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
            // 'sumber_data' => 'string:20',
            // 'tanggal_dp' => 'date',
            // 'nominal_dp' => 'integer',
            // 'tanggal_payment' => 'date',
            // 'nominal_payment' => 'integer',
            // 'tanggal_opening_class' => 'date',
            // 'tanggal_end_class' => 'date|after:tanggal_opening_class',
            // 'tanggal_ujian' => 'date',
            // 'status_Cat' => 'string:20',
            // 'keterangan_cat' => ''
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
        // $cat->sumber_data = $request->sumber_data;
        // $cat->DP_date = $request->tanggal_dp;
        // $cat->DP_nominal = $request->nominal_dp;
        // $cat->payment_date = $request->tanggal_payment;
        // $cat->payment_nominal = $request->nominal_payment;
        // $cat->tanggal_opening_class = $request->tanggal_opening_class;
        // $cat->tanggal_end_class = $request->tanggal_end_class;
        // $cat->tanggal_ujian = $request->tanggal_ujian;
        // $cat->status = $request->status_cat;
        // $cat->keterangan = $request->keterangan_cat;

        $cat->save();

        return redirect()->back();
    }

    public function addUOB(Request $request) {
        $this->validate($request, [
            'master_id' => '',
            'client_id' => 'required|string:50',
            'sales_name' => 'required',
            'sumber_data' => 'required',
            'tanggal_gabung' => 'required|date',
            'nomor_ktp' => 'required|string:20',
            'tanggal_expired_ktp' => 'required|date',
            'nomor_npwp' => 'required|string:40',
            'alamat_surat' => 'required',
            'saudara_tidak_serumah' => 'required',
            'nama_ibu_kandung' => 'required',
            // 'bank_pribadi' => 'required',
            // 'nomor_rekening_pribadi' => 'required|string:50',
            // 'tanggal_rdi_done' => 'required|date',
            // 'rdi_bank' => 'required|string:20',
            // 'nomor_rdi' => 'required',
            // 'tanggal_top_up' => 'required|date',
            // 'nominal_top_up' =>  'required',
            // 'tanggal_trading' => 'required|date',
            // 'status_uob' => 'required',
            // 'trading_via' => 'required',
            // 'keterangan_uob' => 'required'
        ]);

        $uob = new \App\Uob;

        if ($request->master == 0) {
            $uob->master_id = $this->id;
        } else {
            $uob->master_id = $request->master_id;
        }
        $uob->client_id = $request->client_id;
        $uob->sales_name = $request->sales_name;
        $uob->sumber_data = $request->sumber_data;
        $uob->join_date = $request->tanggal_gabung;
        $uob->nomor_ktp = $request->nomor_ktp;
        $uob->tanggal_expired_ktp = $request->tanggal_expired_ktp;
        $uob->nomor_npwp = $request->nomor_npwp;
        $uob->alamat_surat = $request->alamat_surat;
        $uob->saudara_tidak_serumah = $request->saudara_tidak_serumah;
        $uob->nama_ibu_kandung = $request->nama_ibu_kandung;
        // $uob->bank_pribadi = $request->bank_pribadi;
        // $uob->nomor_rekening_pribadi = $request->nomor_rekening_pribadi;
        // $uob->tanggal_rdi_done = $request->tanggal_rdi_done;
        // $uob->rdi_bank = $request->rdi_bank;
        // $uob->nomor_rdi = $request->nomor_rdi;
        // $uob->tanggal_top_up = $request->tanggal_top_up;
        // $uob->nominal_top_up = $request->nominal_top_up;
        // $uob->tanggal_trading = $request->tanggal_trading;
        // $uob->status = $request->status_uob;
        // $uob->trading_via = $request->trading_via;
        // $uob->keterangan = $request->keterangan_uob;

        $uob->save();

        return redirect()->back();
    }

    public function addMRG(Request $request) {
        $this->validate($request, [
            'master_id' => '',
            'sumber_data_mrg' => '',
            'tanggal_join' => 'date'
        ]);

        $mrg = new \App\Mrg;

        if ($request->master == 0) {
            $mrg->master_id = $this->id;
        } else {
            $mrg->master_id = $request->master_id;
        }
        $mrg->sumber_data = $request->sumber_data_mrg;
        $mrg->join_date = $request->tanggal_join;

        $mrg->save();

        return redirect()->back();
    }

    public function addAClub(Request $request) {
        $this->validate($request, [
            'master_id' => '',
            'user_id_aclub' => 'required|string:50',
            'group' => 'required|string:5',
            'sumber_data_aclub' => '',
            'keterangan_aclub' => ''
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

        return redirect()->back();
    }
}