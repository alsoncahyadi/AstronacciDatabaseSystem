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
        $uobs = Uob::paginate(15);

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
                "Client ID" => "client_id",
                "Master ID" => "master_id",
                "Sales Name" => "sales_name",
                "Sumber Data" => "sumber_data",
                "Join Date" => "join_date",
                "Nomor KTP" => "nomor_ktp",
                "Tanggal Expired KTP" => "tanggal_expired_ktp",
                "Nomor NPWP" => "nomor_npwp",
                "Alamat Surat" => "alamat_surat",
                "Saudara Tidak Serumah" => "saudara_tidak_serumah",
                "Nama Ibu Kandung" => "nama_ibu_kandung",
                "Bank Pribadi" => "bank_pribadi",
                "Nomor Rekening Pribadi" => "nomor_rekening_pribadi",
                "Tanggal RDI Done" => "tanggal_rdi_done",
                "RDI Bank" => "rdi_bank",
                "Nomor RDI" => "nomor_rdi",
                "Tanggal Top-up" => "tanggal_top_up",
                "Nominal" => "nominal_top_up",
                "Tanggal Trading" => "tanggal_trading",
                "Status" => "status",
                "Trading via" => "trading_via",
                "Keterangan" => "keterangan"];

        $heads = $ins;

        //form transaction
        $insreg = ["Tanggal RDI Done", "RDI Bank", "Nomor RDI", "Tanggal Top Up", "Nominal Top Up", "Tanggal Trading", "Status", "Trading Via", "Keterangan"];

        //judul + sql transaction
        $headsreg = [  "Tanggal RDI Done" => 'tanggal_rdi_done',
                        "RDI Bank" => "rdi_bank",
                        "Nomor RDI" => 'nomor_rdi',
                        "Tanggal Top Up" => 'tanggal_top_up',
                        "Nominal Top Up" => 'nominal_top_up',
                        "Tanggal Trading" => 'tanggal_trading',
                        "Status" => 'status',
                        "Trading Via" => 'trading_via',
                        "Keterangan" => 'keterangan'
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
                'client_id' => '',
                'master_id' => '',
                'sales_name' => '',
                'sumber_data' => '',
                'join_date' => '',
                'nomor_ktp' => '',
                'tanggal_expired_ktp' => '',
                'nomor_npwp' => '',
                'alamat_surat' => '',
                'saudara_tidak_serumah' => '',
                'nama_ibu_kandung' => '',
                'bank_pribadi' => '',
                'nomor_rekening_pribadi' => '',
                'tanggal_rdi_done' => '',
                'rdi_bank' => '',
                'nomor_rdi' => '',
                'tanggal_top_up' => '',
                'nominal' => '',
                'tanggal_trading' => '',
                'status' => '',
                'trading_via' => '',
                'keterangan' => ''
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
            $uob->bank_pribadi = $request->bank_pribadi;
            $uob->nomor_rekening_pribadi = $request->nomor_rekening_pribadi;
            $uob->tanggal_rdi_done = $request->tanggal_rdi_done;
            $uob->rdi_bank = $request->rdi_bank;
            $uob->nomor_rdi = $request->nomor_rdi;
            $uob->tanggal_top_up = $request->tanggal_top_up;
            $uob->nominal_top_up = $request->nominal;
            $uob->tanggal_trading = $request->tanggal_trading;
            $uob->status = $request->status;
            $uob->trading_via = $request->trading_via;
            $uob->keterangan = $request->keterangan;

            $uob->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect()->back()->withErrors($err);
    }

    //VERSI LAMA

  //   public function addClient(Request $request) {
  //       //Validasi input
  //       $this->validate($request, [
  //               'client' => 'required',
  //               'nama' => 'required',
  //               'expired' => 'required',
  //               'email' => 'email',
  //               'telepon' => 'required',
  //               'alamat' => 'required',
  //           ]);
  //       //Inisialisasi array error
  //       $err = [];
  //       DB::beginTransaction();
		// try {
  //           //Input data ke SQL
		// 	DB::select("call inputUOB(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->client,$request->nama,$this->nullify($request->class),$this->nullify($request->nomor),$request->expired,$request->alamat,$this->nullify($request->kota),$this->nullify($request->tanggal_lahir),$this->nullify($request->kategori), $this->nullify($request->bulan), $request->telepon, $request->email, $this->nullify($request->bank), $this->nullify($request->nomor_rekening), $this->nullify($request->jenis_kelamin), $this->nullify($request->rdi_niaga), $this->nullify($request->rdi_bca), $this->nullify($request->trading_via), $this->nullify($request->source), $this->nullify($request->sales)]);
		// }  catch(\Illuminate\Database\QueryException $ex){ 
  //           DB::rollback();
  //           $err[] = $ex->getMessage();
  //       }
  //       DB::commit();
  //       return redirect()->back()->withErrors($err);
  //   }

    public function deleteClient($id) {
        //Menghapus client dengan ID tertentu
        try {
            DB::select("call delete_uob(?)", [$id]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        return redirect("home");
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
                    if (($value->client) === null) {
                        $msg = "Client empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->nama) === null) {
                        $msg = "Nama empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->expired) === null) {
                        $msg = "Expired empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->email) === null) {
                        $msg = "Email empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->telepon) === null) {
                        $msg = "Telepon empty on line ".$i;
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
                        try { 
                            DB::select("call inputUOB(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$value->client,$value->nama,$value->class,$value->nomor,$value->expired,$value->alamat,$value->kota,$value->tanggal_lahir,$value->kategori, $value->bulan, $value->telepon, $value->email, $value->bank, $value->nomor_rekening, $value->jenis_kelamin, $value->rdi_niaga, $value->rdi_bca, $value->trading_via, $value->source, $value->sales]);
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
