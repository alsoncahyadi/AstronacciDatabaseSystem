<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;
use App\Uob;

class UOBController extends Controller
{
    
    private function nullify($string)
    {
        $newstring = trim($string);
        if ($newstring === ''){
           return null;
        }
        return $newstring;
    }

    public function getTable(Request $request) {
        //$uobs = Uob::paginate(15);

        $keyword = $request['q'];

        $uobs = Uob::where('sales_name', 'like', "%{$keyword}%")
                ->orWhere('sumber_data', 'like', "%{$keyword}%")
                ->orWhere('nomor_ktp', 'like', "%{$keyword}%")
                ->orWhere('nomor_npwp', 'like', "%{$keyword}%")
                ->orWhere('alamat_surat', 'like', "%{$keyword}%")
                ->orWhere('saudara_tidak_serumah', 'like', "%{$keyword}%")
                ->orWhere('nama_ibu_kandung', 'like', "%{$keyword}%")
                ->orWhere('bank_pribadi', 'like', "%{$keyword}%")
                ->orWhere('rdi_bank', 'like', "%{$keyword}%")
                ->orWhere('nomor_rdi', 'like', "%{$keyword}%")
                ->orWhere('status', 'like', "%{$keyword}%")
                ->orWhere('trading_via', 'like', "%{$keyword}%")
                ->orWhere('keterangan', 'like', "%{$keyword}%")
                ->paginate(15);

        //judul kolom
        $heads = ["Client ID", "Master ID", "Sales", "Sumber Data", "Join Date", "Nomor KTP", "Tanggal Expired KTP", "Nomor NPWP", "Alamat Surat", "Saudara Tidak Serumah", "Nama Ibu Kandung", "Bank Pribadi", "Nomor Rekening Pribadi", "Tanggal RDI Done", "RDI Bank", "Nomor RDI", "Tanggal Top Up", "Nominal Top Up", "Tanggal Trading", "Status", "Trading Via", "Keterangan", "Created At", "Updated At", "Created By", "Updated By"];

        //attribute sql
        $atts = ["client_id","master_id", "sales_name", "sumber_data", "join_date", "nomor_ktp", "tanggal_expired_ktp", "nomor_npwp", "alamat_surat", "saudara_tidak_serumah", "nama_ibu_kandung", "bank_pribadi", "nomor_rekening_pribadi", "tanggal_rdi_done", "rdi_bank", "nomor_rdi", "tanggal_top_up", "nominal_top_up", "tanggal_trading", "status", "trading_via", "keterangan", "created_at", "updated_at", "created_by", "updated_by"];

        return view('content/table', ['route' => 'UOB', 'clients' => $uobs, 'heads'=>$heads, 'atts'=>$atts]);
    }

    public function clientDetail($id) {
        $uob = Uob::where('client_id', $id)->first();

        //judul + sql
        $ins= [
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

        $heads = $ins;

        //form transaction
        $insreg = ["Bank Pribadi" => "bank_pribadi",
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

        //judul + sql transaction
        $headsreg = [  "Bank Pribadi" => "bank_pribadi",
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

        return view('profile/profile', ['route'=>'UOB', 'client'=>$uob, 'heads' => $heads, 'ins'=>$ins, 'insreg'=>$insreg, 'headsreg'=>$headsreg]);
    }

    public function addTrans(Request $request) {
        $this->validate($request, [
                'bank_pribadi' => '',
                'nomor_rekening_pribadi' => '',
                'tanggal_rdi_done' => 'date',
                'rdi_bank' => '',
                'nomor_rdi' => '',
                'tanggal_top_up' => 'date',
                'nominal_top_up' => '',
                'tanggal_trading' => '',
                'status' => '',
                'trading_via' => '',
                'keterangan' => ''
            ]);

        $uob = Uob::where('client_id',$request->user_id)->first();

        $err =[];

        $uob->bank_pribadi = $request->bank_pribadi;
        $uob->nomor_rekening_pribadi = $request->nomor_rekening_pribadi;
        $uob->tanggal_rdi_done = $request->tanggal_rdi_done;
        $uob->rdi_bank = $request->rdi_bank;
        $uob->nomor_rdi = $request->nomor_rdi;
        $uob->tanggal_top_up = $request->tanggal_top_up;
        $uob->nominal_top_up = $request->nominal_top_up;
        $uob->tanggal_trading = $request->tanggal_trading;
        $uob->status = $request->status;
        $uob->trading_via = $request->trading_via;
        $uob->keterangan = $request->keterangan;

        $uob->update();

        return redirect()->back()->withErrors($err);
    }

    public function editClient(Request $request) {
        //Validasi input
        $this->validate($request, [
                'kode_client' => '',
                'master_id' => '',
                'sales' => '',
                'sumber_data' => '',
                'tanggal_join' => '',
                'nomor_ktp' => '',
                'expired_ktp' => '',
                'nomor_npwp' => '',
                'alamat_surat_menyurat' => '',
                'saudara_tidak_serumah' => '',
                'nama_ibu_kandung' => '',
            ]);

        //Inisialisasi array error
        $err = [];
        try {
            $uob = UOB::where('client_id',$request->client_id)->first();

            $err =[];

            $uob->client_id = $request->client_id;
            $uob->master_id = $request->master_id;
            $uob->sales_name = $request->sales_name;
            $uob->sumber_data = $request->sumber_data;
            $uob->join_date = $request->join_date;
            $uob->nomor_ktp = $request->nomor_ktp;
            $uob->tanggal_expired_ktp = $request->tanggal_expired_ktp;
            $uob->nomor_npwp = $request->nomor_npwp;
            $uob->alamat_surat = $request->alamat_surat;
            $uob->saudara_tidak_serumah = $request->saudara_tidak_serumah;
            $uob->nama_ibu_kandung = $request->nama_ibu_kandung;

            $uob->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect()->back()->withErrors($err);
    }

    public function importExcel() {
        $err = []; //Inisialisasi array error
        if(Input::hasFile('import_file')){ //Mengecek apakah file diberikan
            $path = Input::file('import_file')->getRealPath(); //Mendapatkan path
            $data = Excel::load($path, function($reader) { //Load excel
            })->get();

            
            if(!empty($data) && $data->count()){
                $i = 1;
                //Cek apakah ada error
                foreach ($data as $key => $value) {
                    $i++;
                    if (($value->kode_client) === null) {
                        $msg = "Kode Client empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->master_id) === null) {
                        $msg = "Master ID empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->sales) === null) {
                        $msg = "Sales empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->sumber_data) === null) {
                        $msg = "Sumber Data empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->tanggal_join) === null) {
                        $msg = "Tanggal Join empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->nomer_ktp) === null) {
                        $msg = "Nomer KTP empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->expired_ktp) === null) {
                        $msg = "Expired KTP empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->nomer_npwp) === null) {
                        $msg = "Nomer NPWP empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->alamat_surat) === null) {
                        $msg = "Alamat Surat empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->saudara_tidak_serumah) === null) {
                        $msg = "Saudara Tidak Serumah empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->ibu_kandung) === null) {
                        $msg = "Ibu Kandung empty on line ".$i;
                        $err[] = $msg;
                    }
                    
                } //end validasi

                //Jika tidak ada error, import dengan cara insert satu per satu
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        try { 
                            $uob = new \App\Uob;

                            $uob->client_id = $value->kode_client;
                            $uob->master_id = $value->master_id;
                            $uob->sales_name = $value->sales;
                            $uob->sumber_data = $value->sumber_data;
                            $uob->join_date = $value->tanggal_join;
                            $uob->nomor_ktp = $value->nomer_ktp;
                            $uob->tanggal_expired_ktp = $value->expired_ktp;
                            $uob->nomor_npwp = $value->nomer_npwp;
                            $uob->alamat_surat = $value->alamat_surat;
                            $uob->saudara_tidak_serumah = $value->saudara_tidak_serumah;
                            $uob->nama_ibu_kandung = $value->ibu_kandung;

                            $uob->save();
                        } catch(\Illuminate\Database\QueryException $ex){ 
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
