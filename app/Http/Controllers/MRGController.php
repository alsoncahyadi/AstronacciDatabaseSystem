<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;

class MRGController extends Controller
{
    //
    public function getTable() {
        //Select seluruh tabel
        

        //return view('table', ['posts' => $table]);

        $tab = ["ini MRG"];
        return view('table\table', ['posts' => $tab, 'route' => 'MRG.detail']);
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

                    else
                        echo $value->account . ' ' . $value->nama . ' ' . $value->tanggal_join . ' ' . $value->alamat . ' ' . $value->kota . ' ' . $value->telepon . ' ' . $value->email . ' ' . $value->type . ' ' . $value->sales . ' ' . "<br/>";                
                }
                //if(!empty($insert)){
                  //  DB::table('items')->insert($insert);
                    //dd('Insert Record successfully.');
                //}
            }
        } else {
            echo "no file";
        }
    }

    public function exportExcel() {
        /*$data = Item::get()->toArray();
        print_r($data);
        return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download('xls');*/
    }
}
