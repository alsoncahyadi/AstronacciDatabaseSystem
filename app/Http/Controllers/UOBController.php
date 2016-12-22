<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UOBController extends Controller
{
    //
    public function getTable() {
        //Select seluruh tabel
        
    }

    public function clientDetail($id) {
        //Select seluruh data client $id yang ditampilkan di detail
        echo "UOB detail" . $id;
    }

    public function addClient(Request $request) {
        //Insert
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
                    
                } //end validasi

                //Jika tidak ada error, import
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        try { 

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


        //foreach ($err as $er) 
        //    echo $er . "<br/>";
        return redirect()->back()->withErrors([$err]);
    }
}
