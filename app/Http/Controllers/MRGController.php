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
        $mrgs = MRG::all();
        //dd($mrgs);

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["Account", "Tanggal Join", "Type", "Sales"];

        //Nama attribute pada sql
        $atts = ["account", "join_date", "type", "sales_username"];
        return view('table\table', ['route' => 'MRG', 'clients' => $mrgs, 'heads'=>$heads, 'atts'=>$atts]);
    }

    public function clientDetail($id) {
        //Select seluruh data client $id yang ditampilkan di detail
        echo "MRG detail" . $id;
    }

    public function addClient(Request $request) {
        //Insert
        echo $request["account"] . "<br/>";
        echo $request["nama"] . "<br/>";
        echo $request["tgljoin"] . "<br/>";
        echo $request["alamat"] . "<br/>";
        echo $request["kota"] . "<br/>";
        echo $request["telepon"] . "<br/>";
        echo $request["email"] . "<br/>";
        echo $request["type"] . "<br/>";
        echo $request["sales"] . "<br/>";

        //input ke database
        DB::select("call inputMRG($request->account,'$request->nama',$request->tgljoin,'$request->alamat','$request->kota','$request->telepon','$request->email','$request->type','$request->sales')");
    }

    public function importExcel() {
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                $i = 1;
                foreach ($data as $key => $value) {
                    $i++;
                    if (($value->account) === null) {
                        $msg = "Account empty on line ".$i;
                        return redirect()->back()->withErrors([$msg]);
                    }
                    if (($value->nama) === null) {
                        $msg = "Nama empty on line ".$i;
                        return redirect()->back()->withErrors([$msg]);
                    }
                    if (($value->tanggal_join) === null) {
                        $msg = "Tanggal Join empty on line ".$i;
                        return redirect()->back()->withErrors([$msg]);
                    }
                    if (($value->alamat) === null) {
                        $msg = "Alamat empty on line ".$i;
                        return redirect()->back()->withErrors([$msg]);
                    }
                    if (($value->kota) === null) {
                        $msg = "Kota empty on line ".$i;
                        return redirect()->back()->withErrors([$msg]);
                    }
                    if (($value->telepon) === null) {
                        $msg = "Telepon empty on line ".$i;
                        return redirect()->back()->withErrors([$msg]);
                    }
                    if (($value->email) === null) {
                        $msg = "Email empty on line ".$i;
                        return redirect()->back()->withErrors([$msg]);
                    }
                    if (($value->type) === null) {
                        $msg = "Type empty on line ".$i;
                        return redirect()->back()->withErrors([$msg]);
                    }
                    if (($value->sales) === null) {
                        $msg = "Sales empty on line ".$i;
                        return redirect()->back()->withErrors([$msg]);
                    }

                        echo $value->account . ' ' . $value->nama . ' ' . $value->tanggal_join . ' ' . $value->alamat . ' ' . $value->kota . ' ' . $value->telepon . ' ' . $value->email . ' ' . $value->type . ' ' . $value->sales . ' ' . "<br/>";                

                    DB::select("call inputMRG($value->account,'$value->nama','$value->tanggal_join','$value->alamat','$value->kota','$value->telepon','$value->email','$value->type','$value->sales')");
                }
            }
        } else {
            $msg = "No file supplied";
            return redirect()->back()->withErrors([$msg]);
        }
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
