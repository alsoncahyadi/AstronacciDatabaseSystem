<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;

class GreenController extends Controller
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
        $greens = DB::select("select * from green");
        //dd($mrgs);

        //Data untuk insert
        $ins = ["Nama", "No HP", "Keterangan Perintah", "Sumber", "Progress", "Sales", "Share to AClub", "Share to MRG", "Share to CAT", "Share to UOB"];

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["Green ID", "Fullname", "No HP", "Keterangan Perintah", "Sumber", "Sales", "Progress", "AClub Stock", "AClub Future", "CAT", "MRG", "UOB", "Red Club", "Share To AClub", "Share To CAT", "Share to MRG", "Share to UOB"];

        //Nama attribute pada sql
        $atts = ["green_id", "fullname", "no_hp", "keterangan_perintah", "sumber", "sales_username", "progress", "is_aclub_stock", "is_aclub_future", "is_cat", "is_mrg_premiere", "is_UOB", "is_red_club", "share_to_aclub", "share_to_cat", "share_to_mrg", "share_to_uob"];

        foreach ($greens as $green) {
            $green->is_UOB = $green->is_UOB ? "Yes" : "No";
            $green->is_cat = $green->is_cat ? "Yes" : "No";
            $green->is_mrg_premiere = $green->is_mrg_premiere ? "Yes" : "No";
            $green->is_aclub_stock = $green->is_aclub_stock ? "Yes" : "No";
            $green->is_aclub_future = $green->is_aclub_future ? "Yes" : "No";
            $green->is_red_club = $green->is_red_club ? "Yes" : "No";
            $green->share_to_aclub = $green->share_to_aclub ? "Yes" : "No";
            $green->share_to_cat = $green->share_to_cat ? "Yes" : "No";
            $green->share_to_mrg = $green->share_to_mrg ? "Yes" : "No";
            $green->share_to_uob = $green->share_to_uob ? "Yes" : "No";

            foreach ($atts as $att) {
                if (!$green->$att) $green->$att = "-";
            }
        }

        return view('content\table', ['route' => 'green', 'clients' => $greens, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins]);
   // }
        //$tab = ["asdf", "bsb", "adf"];
        //$a = 'a';
        //return $tab['a'];
        //return view('table/table', ['posts' => $tab, 'route' => 'CAT.detail']);
    }

    public function clientDetail($id) {
        //echo "Green Detail <br>";
        //echo $id;
		return view('profile\profile');
    }

    public function addClient(Request $request) {
        $this->validate($request, [
                'nama' => 'required',
                'no_hp' => 'required'
            ]);


        //echo $request;
        $aclub = strtolower($request->share_to_aclub) == "yes" ? 1 : 0;
        $mrg = strtolower($request->share_to_mrg) == "yes" ? 1 : 0;
        $cat = strtolower($request->share_to_cat) == "yes" ? 1 : 0;
        $uob = strtolower($request->share_to_uob) == "yes" ? 1 : 0;
        $err = [];
        try {
            DB::select("call input_green(?,?,?,?,?,?,?,?,?,?)", [$request->nama, $request->no_hp, $request->keterangan_perintah, $request->sumber, $request->progress, $request->sales, $aclub, $mrg, $cat, $uob]);
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
                    if (($value->nama) === null) {
                        $msg = "Nama empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->no_hp) === null) {
                        $msg = "No HP empty on line ".$i;
                        $err[] = $msg;
                    }
                } //end validasi

                //Jika tidak ada error, import
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        echo $value->account . ' ' . $value->nama . ' ' . $value->tanggal_join . ' ' . $value->alamat . ' ' . $value->kota . ' ' . $value->telepon . ' ' . $value->email . ' ' . $value->type . ' ' . $value->sales . ' ' . "<br/>";
                        $aclub = strtolower($value->share_to_aclub) == "yes" ? 1 : 0;
                        $mrg = strtolower($value->share_to_mrg) == "yes" ? 1 : 0;
                        $cat = strtolower($value->share_to_cat) == "yes" ? 1 : 0;
                        $uob = strtolower($value->share_to_uob) == "yes" ? 1 : 0;
                        try { 
                            DB::select("call input_green(?,?,?,?,?,?,?,?,?,?)", [$value->nama, $value->no_hp, $value->keterangan_perintah, $value->sumber, $value->progress, $value->sales, $aclub, $mrg, $cat, $uob]);
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
