<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Excel;
use App\MasterClient;

class DetailController extends Controller
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

    public function clientDetail($id) {
        //Select seluruh data client $id yang ditampilkan di detail
        $master = MasterClient::where('master_id', $id)->first();
        $aclub = $master->aclubInformation;
        $mrg = $master->mrg;
        $uob = $master->uob;
        $cat = $master->cat;

        //Nama atribut form yang ditampilkan dan nama pada SQL
        $ins= ["Master ID"=> "master_id",
                "User ID Redclub" => "redclub_user_id",
                "Password Redclub" => "redclub_password",
                "Nama" => "name",
                "Telephone" => "telephone_number",
                "Email" => "email",
                "Tanggal Lahir" => "birthdate",
                "Alamat" => "address",
                "Kota" => "city",
                "Provinsi" => "province",
                "Gender" => "gender",
                "Line ID" => "line_id",
                "BBM" => "bbm",
                "WhatsApp" => "whatsapp",
                "Facebook" => "facebook"];
        //Untuk input pada database, ditambahkan PC ID yang tidak ada pada form
        $heads = $ins;
        $insreg = ["Cuki"];
        //dd($cat);   
		return view('profile/pcdetail', ['route'=>'detail', 'client'=>$master, 'heads'=>$heads, 'ins'=>$ins, 'insreg'=>$insreg, 'cat'=> $cat, 'mrg'=> $mrg, 'aclub'=> $aclub , 'uob'=> $uob]);
    }
  
    public function deleteClient($id) {
        //Menghapus client dengan ID tertentu
        try {
            $master = MasterClient::find($id);
            $master->delete();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect("home");
    }
  
    public function editClient(Request $request) {
         $this->validate($request, [
                'master_id' => '',
                'redclub_user_id' => '',
                'name' => '',
                'telephone_number' => '',
                'email' => '',
                'birthdate' => '',
                'address' => '',
                'city' => '',
                'province' => '',
                'gender' => '',
                'line_id' => '',
                'bbm' => '',
                'whatsapp' => '',
                'facebook' => '',
            ]);
        $err = [];

        try {
            $master = MasterClient::find($request->user_id);

            $master->master_id = $request->master_id;
            $master->redclub_user_id = $request->redclub_user_id;
            $master->name = $request->name;
            $master->telephone_number = $request->telephone_number;
            $master->email = $request->email;
            $master->birthdate = $request->birthdate;
            $master->address = $request->address;
            $master->city = $request->city;
            $master->province = $request->province;
            $master->gender = $request->gender;
            $master->line_id = $request->line_id;
            $master->bbm = $request->bbm;
            $master->whatsapp = $request->whatsapp;
            $master->facebook = $request->facebook;

            $master->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect()->back()->withErrors($err);
    }

}
