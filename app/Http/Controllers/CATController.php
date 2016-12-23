<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Excel;

class CATController extends Controller
{
    //
    private function nullify($string)
    {
        $newstring = trim($string);
        if ($newstring === ''){
           return null;
        }

        //echo "masuk sini";
        return $newstring;
    }

    public function getTable() {
        $cats = DB::select("call select_cat()");
        //dd($mrgs);

        //Data untuk insert
        $ins = ["Sales", "Batch", "User ID", "No Induk", "Pendaftaran", "Kelas Berakhir", "Nama", "Jenis Kelamin", "Email", "Telepon", "Alamat", "Kota", "Tanggal Lahir", "Username", "Password"];

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["ID", "Fullname", "Username", "Tanggal Daftar"];

        //Nama attribute pada sql
        $atts = ["cat_user_id", "fullname", "cat_username", "tanggal_pendaftaran"];
        return view('content\table', ['route' => 'CAT', 'clients' => $cats, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins]);
   // }
        //$tab = ["asdf", "bsb", "adf"];
        //$a = 'a';
        //return $tab['a'];
        //return view('table/table', ['posts' => $tab, 'route' => 'CAT.detail']);
    }

    public function clientDetail($id) {
        echo "CAT Detail <br>";
        echo $id;
    }

    public function addClient(Request $request) {
        $this->validate($request, [
                'batch' => 'required',
                'user_id' => 'required',
                'no_induk' => 'required',
                'pendaftaran' => 'required',
                'kelas_berakhir' => 'required',
                'nama' => 'required',
                'email' => 'required|email',
                'telepon' => 'required',
                'alamat' => 'required',
                'username' => 'required'
            ]);

        //echo $request;
        $err = [];
        try {
            DB::select("call inputCAT(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$this->nullify($request->sales),$request->batch,$request->user_id,$request->no_induk,$request->pendaftaran,$request->kelas_berakhir,$request->username,$this->nullify($request->password),$request->nama,$this->nullify($request->jenis_kelamin),$request->email,$request->telepon,$request->alamat,$this->nullify($request->kota), $this->nullify($request->tanggal_lahir)]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        return redirect()->back()->withErrors($err);

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

                //Jika tidak ada error, import
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        echo $value->account . ' ' . $value->nama . ' ' . $value->tanggal_join . ' ' . $value->alamat . ' ' . $value->kota . ' ' . $value->telepon . ' ' . $value->email . ' ' . $value->type . ' ' . $value->sales . ' ' . "<br/>";
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


        //foreach ($err as $er) 
        //    echo $er . "<br/>";
        return redirect()->back()->withErrors([$err]);
    }
}
