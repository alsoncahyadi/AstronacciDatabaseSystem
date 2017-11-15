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
        //$cats = Cat::paginate(15);

        $keyword = $request['q'];

        $cats = Cat::where('batch', 'like', "%{$keyword}%")
                ->orWhere('sales_name', 'like', "%{$keyword}%")
                ->orWhere('sumber_data', 'like', "%{$keyword}%")
                ->orWhere('status', 'like', "%{$keyword}%")
                ->orWhere('keterangan', 'like', "%{$keyword}%")
                ->paginate(15);

        //judul kolom
        $heads = ["User Id", "No Induk", "Master Id", "Batch", "Sales", "Sumber Data", "Tanggal DP", "Nominal DP", "Tanggal Payment", "Nominal Payment", "Opening Class", "End Class", "Tanggal Ujian", "Status", "Keterangan", "Created At", "Updated At", "Created By", "Updated By"];

        //attribute sql
        $atts = ["user_id", "nomor_induk", "master_id", "batch", "sales", "sumber_data", "DP_date", "DP_nominal", "payment_date", "payment_nominal", "tanggal_opening_class", "tanggal_end_class", "tanggal_ujian", "status", "keterangan", "created_at", "updated_at", "created_by", "updated_by"];

        return view('content/table', ['route' => 'CAT', 'clients' => $cats, 'heads'=>$heads, 'atts'=>$atts]);
    }

    public function clientDetail($id) {
        $cat = Cat::where('user_id', $id)->first();

        //judul + sql
        $ins= ["User ID" => "user_id",
                "Nomor Induk" => "nomor_induk",
                "Batch" => "batch",
                "Sales" => "sales_name",
                ];
        $heads = $ins;

        //form transaction
        $insreg = ["Payment Date",
                    "Payment Nominal",
                    "Tanggal End Class",
                    "Tanggal Ujian",
                    "Status",
                    "Keterangan"
                    ];

        //transaction
        $headsreg = [ "Payment Date" => 'payment_date',
                        "Tanggal Opening Class" => "tanggal_opening_class",
                        "Tanggal End Class" => 'tanggal_end_class',
                        "Tanggal Ujian" => 'tanggal_ujian',
                        "Status" => 'status',
                        "Keterangan" => 'keterangan'
                    ];

		return view('profile/profile', ['route'=>'CAT', 'client'=>$cat, 'heads'=>$heads, 'ins'=>$ins, 'insreg'=>$insreg, 'headsreg'=>$headsreg]);
    }

    public function addTrans(Request $request) {
        $this->validate($request, [
                'payment_date' => 'date',
                'nominal' => '',
                'tanggal_end_class' => 'date',
                'tanggal_ujian' => 'date',
                'status' => '',
                'keterangan' => ''
            ]);

        $cat = Cat::where('user_id',$request->user_id)->first();

        $err =[];

        $cat->payment_date = $request->payment_date;
        $cat->payment_nominal = $request->nominal;
        $cat->tanggal_end_class = $request->tanggal_end_class;
        $cat->tanggal_ujian = $request->tanggal_ujian;
        $cat->status = $request->status;
        $cat->keterangan = $request->keterangan;

        $cat->update();

        return redirect()->back()->withErrors($err);
    }

    public function editClient(Request $request) {
        //Validasi input
        $this->validate($request, [
                'user_id' => '',
                'nomor_induk' => '',
                'batch' => '',
                'sales' => ''
            ]);
        $cat = Cat::where('user_id',$request->user_id)->first();
        //Inisialisasi array error
        $err = [];

        try {
            $cat->user_id = $request->user_id;
            $cat->nomor_induk = $request->nomor_induk;
            $cat->batch = $request->batch;
            $cat->sales_name = $request->sales;

            $cat->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect()->back()->withErrors($err);
    }

    //VERSI LAMA

    public function deleteClient($id) {
        //Menghapus client dengan ID tertentu
        try {
            DB::select("call delete_cat(?)", [$id]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        return redirect("home");
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
                    if (($value->user_id) === null) {
                        $msg = "User ID empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->master_id) === null) {
                        $msg = "Master ID empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->batch) === null) {
                        $msg = "Batch empty on line ".$i;
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
                } //end validasi

                //Jika tidak ada error, import dengan cara insert satu per satu
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        try {
                            $cat = new \App\Cat;

                            $cat->user_id = $value->user_id;
                            $cat->master_id = $value->master_id;
                            $cat->batch = $value->batch;
                            $cat->sales_name = $value->sales;
                            $cat->sumber_data = $value->sumber_data;

                            $cat->save();
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
