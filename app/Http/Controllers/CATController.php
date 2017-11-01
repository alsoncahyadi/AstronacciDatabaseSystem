<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Excel;
use App\Cat;

class CATController extends Controller
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

    public function getTable(Request $request) {
        //Select seluruh tabel
        //$cats = Cat::paginate(15);
        //Daftar username sales
        //$salesusers = DB::select("SELECT sales_username FROM sales");

        $keyword = $request['q'];
        
        $cats = Cat::where('batch', 'like', "%{$keyword}%")
                ->orWhere('sales_name', 'like', "%{$keyword}%")
                ->orWhere('sumber_data', 'like', "%{$keyword}%")
                ->orWhere('status', 'like', "%{$keyword}%")
                ->orWhere('keterangan', 'like', "%{$keyword}%")
                ->paginate(15);

        //Data untuk insert
        $ins = [];

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["User Id", "No Induk", "Master Id", "Batch", "Sales", "Sumber Data", "Tanggal DP", "Nominal DP", "Tanggal Payment", "Nominal Payment", "Opening Class", "End Class", "Tanggal Ujian", "Status", "Keterangan", "Created At", "Updated At", "Created By", "Updated By"]; //kecuali is" an, sm add_time

        //Nama attribute pada sql
        $atts = ["user_id", "nomor_induk", "master_id", "batch", "sales", "sumber_data", "DP_date", "DP_nominal", "payment_date", "payment_nominal", "tanggal_opening_class", "tanggal_end_class", "tanggal_ujian", "status", "keterangan", "created_at", "updated_at", "created_by", "updated_by"];

        //Return view table dengan parameter
        return view('content/table', ['route' => 'CAT', 'clients' => $cats, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins]);
    }

    public function clientDetail($id) {
        //Select seluruh data client $id yang ditampilkan di detail
        $cat = Cat::where('user_id', $id)->first();

        //Nama atribut form yang ditampilkan dan nama pada SQL
        $ins= ["User ID" => "user_id",
                "Nomor Induk" => "nomor_induk",
                "Batch" => "batch",
                "Sales" => "sales_name",
                "Sumber Data" => "sumber_data",
                "DP Date" => "DP_date",
                "DP Nominal " => "DP_nominal",
                "Payment Date" => "payment_date",
                "Payment Nominal" => "payment_nominal",
                "Tanggal Opening Class" => "tanggal_opening_class",
                "Tanggal End Class"=> "tanggal_end_class",
                "Tanggal Ujian" => "tanggal_ujian",
                "Status" => "status",
                "Keterangan" => "keterangan"];
        $heads = $ins;

        dd($cat);
        
		return view('profile/profile', ['route'=>'CAT', 'client'=>$cat, 'heads'=>$heads, 'ins'=>$ins]);
    }


    public function editClient(Request $request) {
        //Validasi input
        $this->validate($request, [
                'email' => 'email',
                'address' => 'required',
                'no_hp' => 'required',
                //'batch' => 'required',
                'cat_user_id' => 'required',
                //'cat_no_induk' => 'required',
                'tanggal_pendaftaran' => 'required',
                'tanggal_kelas_berakhir' => 'required',
                'cat_username' => 'required',
                'fullname' => 'required',
                'all_pc_id' => 'required'
            ]);
        DB::beginTransaction();
        //Inisialisasi array error
        $err = [];
        try {
            //Untuk parameter yang tidak boleh null, digunakan nullify untuk menjadikan input empty string menjadi null
            //Edit atribut master client
            DB::select("call edit_master_client(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$request->all_pc_id, $request->fullname, $request->email, $request->no_hp, $this->nullify($request->birthdate), $this->nullify($request->line_id), $this->nullify($request->bb_pin), $this->nullify($request->twitter), $request->address, $this->nullify($request->city), $this->nullify($request->marital_status), $this->nullify($request->jenis_kelamin), $this->nullify($request->no_telp), $this->nullify($request->provinsi), $this->nullify($request->facebook)]);
            //Edit atribut CAT
            DB::select("call edit_cat(?,?,?,?,?,?,?,?,?)", [$request->all_pc_id, $request->cat_user_id, $request->cat_no_induk, $request->cat_username, $this->nullify($request->password), $request->batch, $request->tanggal_pendaftaran, $request->tanggal_kelas_berakhir, $this->nullify($request->sales_username)]);
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
                'batch' => 'required',
                'user_id' => 'required',
                'no_induk' => 'required',
                'pendaftaran' => 'required',
                'kelas_berakhir' => 'required',
                'nama' => 'required',
                'email' => 'email',
                'telepon' => 'required',
                'alamat' => 'required',
                'username' => 'required'
            ]);

        //Inisialisasi array error
        DB::beginTransaction();
        $err = [];
        try {
            //Input data ke SQL
            DB::select("call inputCAT(?,?,?,?)", [$this->nullify($request->user_id),$request->batch,$request->user_id,$request->no_induk,$request->pendaftaran,$request->kelas_berakhir,$request->username,$this->nullify($request->password),$request->nama,$this->nullify($request->jenis_kelamin),$request->email,$request->telepon,$request->alamat,$this->nullify($request->kota), $this->nullify($request->tanggal_lahir)]);
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
            DB::select("call delete_cat(?)", [$id]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        return redirect("home");
    }

    public function addTrans(Request $request) {
         DB::beginTransaction();
        $err = [];
        try {
            DB::select("call inputCAT_pembayaran(?,?,?,?)", [$this->nullify($request->user_id),$request->angsuran_ke,$request->tanggal_pembayaran_angsuran,$request->pembayaran_angsuran]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            $err[] = $ex->getMessage();
        }
        DB::commit();
        return redirect()->back()->withErrors($err);
    }

    public function detailTrans($id){
        echo ($id);
         $clientsreg = DB::select("select * from laporan_pembayaran_cat where angsuran_ke = (?)", [$id]);
         $clientsreg = $clientsreg[0];
        $headsreg = ["Angsuran ke", "Tanggal Pembayaran Angsuran", "Pembayaran Angsuran"];
        $attsreg = ["angsuran_ke", "tanggal_pembayaran_angsuran", "pembayaran_angsuran"];
        return view('profile/transaction', ['route'=>'CAT/trans',  'clientsreg'=>$clientsreg, 'attsreg'=>$attsreg, 'headsreg'=>$headsreg]);
    }

    public function deleteTrans($id1, $id2){
        echo ($id1);
        echo ($id2);
        $err = [];
        try{
            DB::select("call delete_laporan_pembayaran_cat(?,?)", [$id1, $id2]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        
        return redirect()->back()->withErrors($err);
    }

    public function importExcel() {
        $err = []; //Inisialisasi array error
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath(); //Mengecek apakah file diberikan
            $data = Excel::load($path, function($reader) { //Load excel
            })->get();
            if(!empty($data) && $data->count()){
                $i = 1;
                //Cek apakah ada error
                foreach ($data as $key => $value) {
                    $i++;
                    if (($value->batch) === null) {
                        $msg = "Batch empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->user_id) === null) {
                        $msg = "User ID empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->no_induk) === null) {
                        $msg = "No Induk empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->pendaftaran) === null) {
                        $msg = "Pendaftaran empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->kelas_berakhir) === null) {
                        $msg = "Kelas Berakhir empty on line ".$i;
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
                    if (($value->telepon) === null) {
                        $msg = "Telepon empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->alamat) === null) {
                        $msg = "Alamat empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->username) === null) {
                        $msg = "Username empty on line ".$i;
                        $err[] = $msg;
                    }
                } //end validasi

                //Jika tidak ada error, import dengan cara insert satu per satu
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        try {
                            DB::select("call inputCAT(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$value->sales,$value->batch,$value->user_id,$value->no_induk,$value->pendaftaran,$value->kelas_berakhir,$value->username,$value->password,$value->nama,$value->jenis_kelamin,$value->email,$value->telepon,$value->alamat,$value->kota, $value->tanggal_lahir]);
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
