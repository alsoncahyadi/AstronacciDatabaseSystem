<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MRGController extends Controller
{
    //
    public function getTable() {
        //Select seluruh tabel
        

        //return view('table', ['posts' => $table]);

        $tab = ["ini MRG"];
        return view('table', ['posts' => $tab, 'route' => 'MRG.detail']);
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
                $i = 0;
                foreach ($data as $key => $value) {

                }
                /*if(!empty($insert)){
                    DB::table('items')->insert($insert);
                    dd('Insert Record successfully.');
                } */
            }
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
