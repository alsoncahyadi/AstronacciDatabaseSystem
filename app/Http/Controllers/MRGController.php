<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use App\MRG;
use DB;

class MRGController extends Controller
{
    //
    public function getTable() {
        //Select seluruh tabel
        //$mrgs = MRG::all();
        $mrgs = DB::select("call select_mrg()");
        //dd($mrgs);

        //Data untuk insert
        $ins = ["Account", "Nama", "Tanggal Join", "Alamat", "Kota", "Telepon", "Email", "Type", "Sales"];

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["Account", "Tanggal Join", "Type", "Sales", "Birthday", "UOB"];

        //Nama attribute pada sql
        $atts = ["account", "join_date", "type", "sales_username", "birthdate", "is_UOB"];
        foreach ($mrgs as $mrg) {
            $mrg->is_UOB = $mrg->is_UOB ? "Yes" : "No";
            $mrg->is_cat = $mrg->is_cat ? "Yes" : "No";
            $mrg->is_mrg_premiere = $mrg->is_mrg_premiere ? "Yes" : "No";
            $mrg->is_aclub_stock = $mrg->is_aclub_stock ? "Yes" : "No";
            $mrg->is_aclub_future = $mrg->is_aclub_future ? "Yes" : "No";
            foreach ($atts as $att) {
                if (!$mrg->$att) $mrg->$att = "-";
            }
        }
        return view('table\table', ['route' => 'MRG', 'clients' => $mrgs, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins]);
    }

    public function clientDetail($id) {
        //Select seluruh data client $id yang ditampilkan di detail
        echo "MRG detail" . $id;
    }

    public function addClient(Request $request) {
        //Insert
        $this->validate($request, [
                'account' => 'required',
                'nama' => 'required',
                'tanggal_join' => 'required',
                'alamat' => 'required',
                'kota' => 'required',
                'telepon' => 'required',
                'email' => 'required|email',
                'type' => 'required',
                'sales' => 'required'
            ]);

        echo $request["account"] . "<br/>";
        echo $request["nama"] . "<br/>";
        echo $request["tanggal_join"] . "<br/>";
        echo $request["alamat"] . "<br/>";
        echo $request["kota"] . "<br/>";
        echo $request["telepon"] . "<br/>";
        echo $request["email"] . "<br/>";
        echo $request["type"] . "<br/>";
        echo $request["sales"] . "<br/>";

        //input ke database
        DB::select("call inputMRG($request->account,'$request->nama','$request->tanggal_join','$request->alamat','$request->kota','$request->telepon','$request->email','$request->type','$request->sales')");
    }

    public function importExcel() {
        $err = [];
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                $i = 1;
                //Cek apakah ada error
                foreach ($data as $key => $value) {
                    $i++;
                    if (($value->account) === null) {
                        $msg = "Account empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->nama) === null) {
                        $msg = "Nama empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->tanggal_join) === null) {
                        $msg = "Tanggal Join empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->alamat) === null) {
                        $msg = "Alamat empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->kota) === null) {
                        $msg = "Kota empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->telepon) === null) {
                        $msg = "Telepon empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->email) === null) {
                        $msg = "Email empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->type) === null) {
                        $msg = "Type empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->sales) === null) {
                        $msg = "Sales empty on line ".$i;
                        $err[] = $msg;
                    }
                } //end validasi

                //Jika tidak ada error, import
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        echo $value->account . ' ' . $value->nama . ' ' . $value->tanggal_join . ' ' . $value->alamat . ' ' . $value->kota . ' ' . $value->telepon . ' ' . $value->email . ' ' . $value->type . ' ' . $value->sales . ' ' . "<br/>";
                        try { 
                          DB::select("call inputMRG($value->account,'$value->nama','$value->tanggal_join','$value->alamat','$value->kota','$value->telepon','$value->email','$value->type','$value->sales')");
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


        //foreach ($err as $er) 
        //    echo $er . "<br/>";
        return redirect()->back()->withErrors([$err]);
    }

    /*public function exportExcel() {
            $data = MRG::get()->toArray();
            print_r($data);
            return Excel::create('testexportmrg', function($excel) use ($data) {
                $excel->sheet('Sheet1', function($sheet) use ($data)
                {
                    $sheet->fromArray($data);
                });
            })->download('xls');
        }*/
}
