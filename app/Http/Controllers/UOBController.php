<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;


class UOBController extends Controller
{
    //
    public function getTable() {
        //Select seluruh tabel
        $uobs = [];

        //Data untuk insert
        $ins = ["Client", "Nama", "Class", "Nomor", "Expired", "Alamat", "Kota", "Tanggal Lahir", "Kategori", "Bulan", "Email", "Telepon",  "Bank", "Nomor Rekening", "Jenis Kelamin", "RDI Niaga", "RDI BCA", "Trading via", "Source", "Sales"];

        //Judul kolom yang ditampilkan pada tabel
        $heads = [];

        //Nama attribute pada sql
        $atts = [];
        return view('table\table', ['route' => 'UOB', 'clients' => $uobs, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins]);
    }

    public function clientDetail($id) {
        //Select seluruh data client $id yang ditampilkan di detail
        echo "UOB detail" . $id;
    }

    public function addClient(Request $request) {
        //Insert
        $this->validate($request, [
                'client' => 'required',
                'nama' => 'required',
                'expired' => 'required',
                'email' => 'required|email',
                'telepon' => 'required',
                'alamat' => 'required',
            ]);
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

                //Jika tidak ada error, import
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        try { 
                            //
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
