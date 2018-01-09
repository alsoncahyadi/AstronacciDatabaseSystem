<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;
use App\AclubInformation;
use App\AclubMember;
use App\AclubTransaction;
use App\MasterClient;
use Carbon\Carbon;

class AClubController extends Controller
{

    private function nullify($string)
    {
        $newstring = trim($string);
        if ($newstring === ''){
           return null;
        }
        return $newstring;
    }

    public function getData()
    {
        $aclub_members = AclubMember::paginate(15);

        foreach ($aclub_members as $aclub_member) {
            $master = $aclub_member->master;
            $aclub_member->redclub_user_id = $master->redclub_user_id;
            $aclub_member->redclub_password = $master->redclub_password;
            $aclub_member->name = $master->name;
            $aclub_member->telephone_number = $master->telephone_number;
            $aclub_member->email = $master->email;
            $aclub_member->birthdate = $master->birthdate;
            $aclub_member->address = $master->address;
            $aclub_member->city = $master->city;
            $aclub_member->province = $master->province;
            $aclub_member->gender = $master->gender;
            $aclub_member->line_id = $master->line_id;
            $aclub_member->bbm = $master->bbm;
            $aclub_member->whatsapp = $master->whatsapp;
            $aclub_member->facebook = $master->facebook;

            $last_transaction = $aclub_member->aclubTransactions()->orderBy('masa_tenggang','desc')->first();
            $aclub_member->sales_name = $last_transaction->sales_name;
            $aclub_member->payment_date = $last_transaction->payment_date;
            $aclub_member->kode = $last_transaction->kode;
            $aclub_member->status = $last_transaction->status;
            $aclub_member->start_date = $last_transaction->start_date;
            $aclub_member->expired_date = $last_transaction->expired_date;
            $aclub_member->yellow_zone = $last_transaction->yellow_zone;
            $aclub_member->red_zone = $last_transaction->red_zone;
        }

        return $aclub_members;
    }

    public function getTable(Request $request) {
        //Select seluruh tabel
        //$aclub_info = AclubInformation::paginate(15);

        // $keyword = $request['q'];

        // $aclub_info = AclubInformation::where('sumber_data', 'like', "%{$keyword}%")
        //         ->orWhere('keterangan', 'like', "%{$keyword}%")
        //         ->paginate(15);

        // $this->getAClubMember(100003);

        // $this->getAClubTransaction(124);

        $aclub_members = $this->getData();

        $headsMaster = [
                    "User ID",
                    "Nama",
                    "Email",
                    "Telepon",
                    "Tanggal Lahir"
                ];

        $attsMaster = [
                        "master_id",
                        "name",
                        "email",
                        "telephone_number",
                        "birthdate"
                    ];

        //Judul kolom yang ditampilkan pada tabel
        $heads = [
                "Alamat",
                "Kota",
                "Gender",
                "Line ID",
                "WhatsApp",
                "Sumber",
                "Sales",
                "Payment Date",
                "Kode",
                "Status",
                "Start Date",
                "Expire Date",
                "Yellow Zone",
                "Red Zone"
                ];


        //Nama attribute pada sql
        $atts = [
                "address",
                "city",
                "gender",
                "line_id",
                "whatsapp",
                "sumber_data",
                "sales_name",
                "payment_date",
                "kode",
                "status",
                "start_date",
                "expired_date",
                "yellow_zone",
                "red_zone"
                ];

        //Filter
        $master_clients = MasterClient::all();
        $array_month = array();
        foreach ($master_clients as $master_client) {
            array_push($array_month, date('m', strtotime($master_client->birthdate)));
        }
        $filter_birthdates = array_unique($array_month);
        sort($filter_birthdates);
        foreach ($filter_birthdates as $key => $filter_birthdate) {
            // dd(date('F', mktime(0, 0, 0, $filter_birthdate, 10)));
            $filter_birthdates[$key] = date('F', mktime(0, 0, 0, $filter_birthdate, 10));
        }

        $filter_cities = MasterClient::select('city')->distinct()->get();

        //Return view table dengan parameter
        return view('vpc/aclubview',
                    [
                        'route' => 'AClub',
                        'clients' => $aclub_info,
                        'heads'=>$heads, 'atts'=>$atts,
                        'headsMaster' => $headsMaster,
                        'attsMaster' => $attsMaster,
                        'filter_birthdates' => $filter_birthdates,
                        'filter_cities' => $filter_cities
                    ]);
    }

    public function clientDetail($id, Request $request) {
        // detail master dengan master_id = $id
        // dd(1);

        $aclub_information = AclubInformation::find($id);

        // aclub_master adalah aclub_master nya
        $aclub_master = $aclub_information->master;

        $ins = ["Master_id" => "master_id",
                "Sumber Data" => "sumber_data",
                "Keterangan" => "keterangan"];

        $heads = $ins;

        $keyword = $request['q'];

        // aclub_members adalah list member dari master_id = $id
        // $aclub_members = $aclub_master->aclubMembers();
        //                 ->where('user_id', 'like', "%{$keyword}%")
        //                 ->orWhere('group', 'like', "%{$keyword}%")
        //                 ->paginate(15);
        $aclub_members = $aclub_master->aclubMembers()->get();
        // dd($aclub_members);

        $headsreg = ["User ID",
                    "Group"];

        $insreg = ["User ID",
                    "Group",
                    "Sales Name",
                    "Payment Date",
                    "Kode",
                    "Status",
                    "Nominal",
                    "Start Date",
                    "Expired Date",
                    "Masa Tenggang",
                    "Red Zone",
                    "Yellow Zone"];

        $attsreg = ["user_id", "group"];

        // yang ditampilin di page member cuman aclub_information dan aclub_members aja

        return view('profile/transtable', ['route'=>'AClub', 'client'=>$aclub_information, 'clientsreg'=>$aclub_members, 'heads'=>$heads, 'ins'=>$ins, 'insreg'=>$insreg, 'headsreg'=>$headsreg, 'attsreg'=>$attsreg]);
    }

    public function addMember(Request $request) {
        $this->validate($request, [
                'user_id' => 'required|unique:aclub_members',
                'master_id' => 'required',
                'group' => 'required'
            ]);

        $aclub_member = new \App\AclubMember();

        $err = [];

        $aclub_member->user_id = $request->user_id;
        $aclub_member->master_id = $request->master_id;
        $aclub_member->group = $request->group;

        $aclub_member->save();

        $aclub_trans = new \App\AclubTransaction;
        $aclub_trans->user_id = $request->user_id;
        $aclub_trans->payment_date = $request->payment_date;
        $aclub_trans->sales_name = $request->sales_name;
        $aclub_trans->kode = $request->kode;
        $aclub_trans->status = $request->status_aclub;
        $aclub_trans->nominal = $request->nominal;
        $aclub_trans->start_date = $request->start_date;
        $aclub_trans->expired_date = $request->expired_date;
        $aclub_trans->masa_tenggang = $request->masa_tenggang;
        $aclub_trans->red_zone = $request->red_zone;
        $aclub_trans->yellow_zone = $request->yellow_zone;


        $aclub_trans->save();

        return redirect()->back()->withErrors($err);
    }

    public function deleteClient($id) {
        //Menghapus client dengan ID tertentu
        try {
            $aclub = AclubInformation::find($id);
            $aclub->delete();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect("home");
    }

    public function clientDetailMember($id, $member) {
        $aclub_member = AclubMember::where('user_id', $member)->first();

        $aclub_transaction = $aclub_member->aclubTransactions()->get();

        $heads = [  "User ID" => "user_id",
                    "Master ID" => "master_id",
                    "Group" => "group"];

        $ins =  [   "Sales Name" => "sales_name",
                    "Group" => "group"];

        $headsreg = [ "Payment Date",
                    "Kode",
                    "Status",
                    "Nominal",
                    "Sales Name",
                    "Start Date"
                    ];

        $insreg = [ "Payment Date",
                    "Kode",
                    "Status",
                    "Nominal",
                    "Sales Name",
                    "Start Date",
                    "Expired Date",
                    "Masa Tenggang",
                    "Yellow Zone",
                    "Red Zone"];

        $attsreg = ["payment_date",
                    "kode",
                    "status",
                    "nominal",
                    "sales_name",
                    "start_date",
                    ];


        return view('profile/aclubmember', ['route'=>'AClub', 'client'=>$aclub_member, 'clientsreg'=>$aclub_transaction, 'attsreg'=>$attsreg, 'insreg'=>$insreg, 'ins'=>$ins, 'headsreg'=>$headsreg, 'heads'=>$heads]);
    }

    public function editMember(Request $request) {
        $this->validate($request, [
                'group' => 'required'
            ]);

        $err = [];
        try {
            $aclub_member = AclubMember::find($request->user_id);

            $aclub_member->group = $request->group;

            $aclub_member->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }

        if(!empty($err)) {
            return redirect()->back()->withErrors($err);
        } else {
            return redirect()->route('detail', ['id' => $aclub_member->master_id]);
        }
    }

    public function deleteMember($id) {
        //Menghapus client dengan ID tertentu
        try {
            $aclub_member = AclubMember::find($id);
            $aclub_member->delete();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return back();
    }

    public function clientDetailPackage($id, $member, $package) {

        $aclub_transaction = AclubTransaction::where('transaction_id', $package)->first();
        // dd($aclub_transaction);

        $heads = [  "Transaction ID" => 'transaction_id',
                    "User ID" => 'user_id',
                    "Payment Date" => 'payment_date',
                    "Kode" => 'kode',
                    "Status" => 'status',
                    "Nominal" => 'nominal',
                    "Start Date" => 'start_date',
                    "Expired Date" => 'expired_date',
                    "Masa Tenggang" => 'masa_tenggang',
                    "Yellow Zone" => 'yellow_zone',
                    "Red Zone" => 'red_zone'];
        $ins = [      "Payment Date" => "payment_date",
                        "Kode" => "kode",
                        "Status" => "status",
                        "Nominal" => "nominal",
                        "Sales Name" => "sales_name",
                        "Start Date" => "start_date",
                        "Expired Date" => "expired_date",
                        "Masa Tenggang" => "masa_tenggang",
                        "Yellow Zone" => "yellow_zone",
                        "Red Zone" => "red_zone"];

        $insreg = [     "Payment Date",
                        "Kode",
                        "Status",
                        "Nominal",
                        "Sales Name",
                        "Start Date",
                        "Expired Date",
                        "Masa Tenggang",
                        "Yellow Zone",
                        "Red Zone"];

        $attsreg = ["payment_date",
                    "kode",
                    "status",
                    "nominal",
                    "sales_name",
                    "start_date",
                    "expired_date",
                    "masa_tenggang",
                    "yellow_zone",
                    "red_zone"];
//dd($aclub_transaction);
        return view('profile/aclubpackage', ['route'=>'AClub', 'client'=>$aclub_transaction, 'trans'=>$aclub_transaction, 'clientsreg'=>$aclub_transaction, 'attsreg'=>$attsreg, 'insreg'=>$insreg, 'ins'=>$ins, 'headsreg'=>$insreg, 'heads'=>$heads]);
    }

    public function editClient(Request $request) {
        //Validasi input
        $this->validate($request, [
                'master_id' => 'required|unique:aclub_informations',
                'sumber_data' => '',
                'keterangan' => ''
            ]);

        $err = [];
        try {
            $aclub = AclubInformation::find($request->user_id);

            $aclub->master_id = $request->master_id;
            $aclub->sumber_data = $request->sumber_data;
            $aclub->keterangan = $request->keterangan;

            $aclub->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect()->back()->withErrors($err);
    }

    public function addTrans(Request $request) {
         $this->validate($request, [
                'user_id' => 'required|integer',
                'payment_date' => 'date',
                'kode' => '',
                'status' => '',
                'nominal' => 'integer',
                'sales_name' => '',
                'start_date' => 'date',
                'expired_date' => 'date',
                'masa_tenggang' => 'date',
                'yellow_zone' => 'date',
                'red_zone' => 'date'
                ]);

        $err = [];

        $aclub_trans = new \App\AclubTransaction();

        $aclub_trans->user_id = $request->user_id;
        $aclub_trans->payment_date = $request->payment_date;
        $aclub_trans->kode = $request->kode;
        $aclub_trans->status = $request->status;
        $aclub_trans->nominal = $request->nominal;
        $aclub_trans->sales_name = $request->sales_name;
        $aclub_trans->start_date = $request->start_date;
        $aclub_trans->expired_date = $request->expired_date;
        $aclub_trans->masa_tenggang = $request->masa_tenggang;
        $aclub_trans->yellow_zone = $request->yellow_zone;
        $aclub_trans->red_zone = $request->red_zone;


        $aclub_trans->save();

        return redirect()->back()->withErrors($err);
    }

    public function deleteTrans($id){
        try {
            $aclub_transaction = AclubTransaction::find($id);
            $aclub_transaction->delete();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return back();
    }

    public function editTrans(Request $request) {
        //Validasi input
        $this->validate($request, [
                'payment_date' => 'date',
                'kode' => '',
                'status' => '',
                'nominal' => 'integer',
                'sales_name' => '',
                'start_date' => 'date',
                'expired_date' => 'date',
                'masa_tenggang' => 'date',
                'yellow_zone' => 'date',
                'red_zone' => 'date'
            ]);

        $err = [];
        try {
            $aclub_trans = AclubTransaction::find($request->user_id);

            $aclub_trans->payment_date = $request->payment_date;
            $aclub_trans->kode = $request->kode;
            $aclub_trans->status = $request->status;
            $aclub_trans->nominal = $request->nominal;
            $aclub_trans->sales_name = $request->sales_name;
            $aclub_trans->start_date = $request->start_date;
            $aclub_trans->expired_date = $request->expired_date;
            $aclub_trans->masa_tenggang = $request->masa_tenggang;
            $aclub_trans->yellow_zone = $request->yellow_zone;
            $aclub_trans->red_zone = $request->red_zone;

            $aclub_trans->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        if(!empty($err)) {
            return redirect()->back()->withErrors($err);
        } else {
            return redirect()->route('AClub.member', ['id' => $aclub_trans->aclubmember->first()->master_id, 'member' => $aclub_trans->user_id]);
        }
    }

    public function importExcel() {
        //Inisialisasi array error
        $err = [];
        if(Input::hasFile('import_file')){ //Mengecek apakah file diberikan
            $path = Input::file('import_file')->getRealPath(); //Mendapatkan path
            $data = Excel::load($path, function($reader) { //Load excel
            })->get();
            if(!empty($data) && $data->count()){
                $i = 1;
                //Cek apakah ada error
                foreach ($data as $key => $value) {
                    $i++;
                    if (($value->master_id) === null) {
                        $msg = "Master ID empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->sumber_data) === null) {
                        $msg = "Sumber Data empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->keterangan) === null) {
                        $msg = "Keterangan empty on line ".$i;
                        $err[] = $msg;
                    }
                } //end validasi

                //Jika tidak ada error, import dengan cara insert satu per satu
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        echo $value->account . ' ' . $value->nama . ' ' . $value->tanggal_join . ' ' . $value->alamat . ' ' . $value->kota . ' ' . $value->telepon . ' ' . $value->email . ' ' . $value->type . ' ' . $value->sales . ' ' . "<br/>";
                        try {
                            $aclubInfo = new \App\AclubInformation;

                            $aclubInfo->master_id = $value->master_id;
                            $aclubInfo->sumber_data = $value->sumber_data;
                            $aclubInfo->keterangan = $value->keterangan;

                            $aclubInfo->save();
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

    public function exportExcel() {
        $data = AclubInformation::all();
        $array = [];
        $heads = ["Master ID" => "master_id", "Sumber Data" => "sumber_data", "Keterangan" => "keterangan"];
        foreach ($data as $dat) {
            $arr = [];
            foreach ($heads as $key => $value) {
                //echo $key . " " . $value . "<br>";
                $arr[$key] = $dat->$value;
            }
            $array[] = $arr;
        }
        //print_r($array);
        //$array = ['a' => 'b'];
        return Excel::create('ExportedAClub', function($excel) use ($array) {
            $excel->sheet('Sheet1', function($sheet) use ($array)
            {
                $sheet->fromArray($array);
            });
        })->export('xls');
    }

    public function updateMember($id) {
        $aclub_member = AclubMember::where('user_id', $id)->first();

        $ins = [ "Group" => "group"];

        return view('content/aclubmembereditform', ['route'=>'AClub', 'client'=>$aclub_member, 'ins'=>$ins]);
    }

    public function updateTrans($id) {
        $aclub_transaction = AclubTransaction::where('transaction_id', $id)->first();

        $ins = [    "Payment Date" => 'payment_date',
                    "Kode" => 'kode',
                    "Nominal" => 'nominal',
                    "Sales" => "sales_name",
                    "Start Date" => 'start_date',
                    "Expired Date" => 'expired_date',
                    "Masa Tenggang" => 'masa_tenggang',
                    "Yellow Zone" => 'yellow_zone',
                    "Red Zone"=> 'red_zone'];

        return view('content/aclubtranseditform', ['route'=>'AClub', 'client'=>$aclub_transaction, 'ins'=>$ins]);
    }

    public function addBonus(Request $request) {
      $ids = $request['data'];
      $days = $request['days'];
      if ($ids && $days) {
        foreach ($ids as $id) {
          echo("Updated " . $days . " days : " . $id . "\n");

          // $aclub = AclubTransaction::find($id);
          //
          // $aclub->masa_tenggang = $aclub->masa_tenggang + $days;
          //
          // $aclub->update();
        }
      } else {
        echo("Failed, insufficient information");
      }
    }
}
