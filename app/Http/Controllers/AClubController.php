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
use App\Http\QueryModifier;
use App\Http\QueryExceptionMapping;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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

    private function getFilterDate($table, $column)
    {
        $filter_date = ['0'=>['0'=>'January'], 
                '1'=>['0'=>'February'], 
                '2'=>['0'=>'March'], 
                '3'=>['0'=>'April'], 
                '4'=>['0'=>'May'], 
                '5'=>['0'=>'June'], 
                '6'=>['0'=>'July'],
                '7'=>['0'=>'August'],
                '8'=>['0'=>'September'],
                '9'=>['0'=>'October'],
                '10'=>['0'=>'November'],
                '11'=>['0'=>'December']];   

        $fdpdate = DB::table($table)->select($column)->distinct()->get();
        $filter_dpdate = [];
        $month = [];
        foreach ($fdpdate as $dpdate) {
            $dpdate = substr($dpdate->$column, 5, 2);
            if (!in_array($dpdate, $month)){
                // array_push($filter_dpdate, $filter_date[$dpdate-1]);
                array_push($month, $dpdate);
            }
        }
        sort($month);
        foreach ($month as $m) {    
            if ($m > 0) {        
                array_push($filter_dpdate, $filter_date[$m-1]);
            }
        }
        return $filter_dpdate;
    }

    private function getFilterDateBirth($column)
    {
        $filter_date = ['0'=>['0'=>'January'], 
                '1'=>['0'=>'February'], 
                '2'=>['0'=>'March'], 
                '3'=>['0'=>'April'], 
                '4'=>['0'=>'May'], 
                '5'=>['0'=>'June'], 
                '6'=>['0'=>'July'],
                '7'=>['0'=>'August'],
                '8'=>['0'=>'September'],
                '9'=>['0'=>'October'],
                '10'=>['0'=>'November'],
                '11'=>['0'=>'December']];   

        $joined = DB::table('master_clients')
                    ->join('aclub_members', 'aclub_members.master_id', '=', 'master_clients.master_id');

        $fdpdate = $joined->select($column)->distinct()->get();
        $filter_dpdate = [];
        $month = [];
        foreach ($fdpdate as $dpdate) {
            $dpdate = substr($dpdate->$column, 5, 2);
            if (!in_array($dpdate, $month)){
                // array_push($filter_dpdate, $filter_date[$dpdate-1]);
                array_push($month, $dpdate);
            }
        }
        sort($month);
        foreach ($month as $m) {    
            if ($m > 0) {        
                array_push($filter_dpdate, $filter_date[$m-1]);
            }
        }
        return $filter_dpdate;
    }

    public function getTable(Request $request) {
        $page = 0;
        $record_amount = 15;

        // add 'select' of query
        $query = QueryModifier::queryView('AClub', null, null);

        // retrieve result
        $list_old = DB::select(DB::raw($query['text']), $query['variables']);
        $record_count = count($list_old);
        $page_count = ceil($record_count/$record_amount);     

        $list = collect(array_slice($list_old, $page*$record_amount, $record_amount));

        foreach ($list as $aclub_member) {

            $last_kode = substr($aclub_member->kode,-1);
            if ($last_kode == 'S') {
                $aclub_member->bulan_member = 1;
            } else if($last_kode == 'G') {
                $aclub_member->bulan_member = 6;
            } else {
                $aclub_member->bulan_member = 12;
            }
        }

        $aclub_members = $list;
        $headsMaster = [
                    "User ID",
                    "Nama",
                    "Email",
                    "Telepon",
                    "Tanggal Lahir"
                ];

        $attsMaster = [
                        "user_id",
                        "name",
                        "email",
                        "telephone_number",
                        "birthdate"
                    ];

        //Judul kolom yang ditampilkan pada tabel
        $heads = [
                "Alamat" => "address",
                "Kota" => "city",
                "Gender" => "gender",
                "Line ID" => "line_id",
                "WhatsApp" => "whatsapp",
                "Sumber" => "sumber_data",
                "Sales" => "sales_name",
                "Payment Date" => "payment_date",
                "Kode" => "kode",
                "Status" => "status",
                "Aktif" => "aktif",
                "Bulan Member" => "bulan_member",
                "Bonus Member" => "bonus",
                "Start Date" => "start_date",
                "Expire Date" => "expired_date",
                "Masa Tenggang" => "masa_tenggang",
                "Yellow Zone" => "yellow_zone",
                "Red Zone" => "red_zone"
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
                "aktif",
                "bulan_member",
                "bonus",
                "start_date",
                "expired_date",
                "masa_tenggang",
                "yellow_zone",
                "red_zone"
                ];

        //Filter        

        $joined = DB::table('master_clients')
                    ->join('aclub_members', 'aclub_members.master_id', '=', 'master_clients.master_id');

        $filter_cities = $joined->select('city')->distinct()->get();
        $filter_gender = $joined->select('gender')->distinct()->get();
        $filter_sumber = DB::table('aclub_informations')->select('sumber_data')->distinct()->get();
        $filter_sales = DB::table('aclub_transactions')->select('sales_name')->distinct()->get();
        $filter_kode = DB::table('aclub_transactions')->select('kode')->distinct()->get();
        $filter_status = DB::table('aclub_transactions')->select('status')->distinct()->get();

        $filter_date = ['0'=>['0'=>'January'], 
        '1'=>['0'=>'February'], 
        '2'=>['0'=>'March'], 
        '3'=>['0'=>'April'], 
        '4'=>['0'=>'May'], 
        '5'=>['0'=>'June'], 
        '6'=>['0'=>'July'],
        '7'=>['0'=>'August'],
        '8'=>['0'=>'September'],
        '9'=>['0'=>'October'],
        '10'=>['0'=>'November'],
        '11'=>['0'=>'December']];

        $filter_paydate = $this->getFilterDate('aclub_transactions', 'payment_date');
        $filter_startdate = $this->getFilterDate('aclub_transactions', 'start_date');
        $filter_masadate = $this->getFilterDate('aclub_transactions', 'masa_tenggang');
        // tambahin yang lain ya nik hehe
        $filter_birthdates = $this->getFilterDateBirth('birthdate');

        $filterable = [
            "Kota" => $filter_cities,
            "Gender" => $filter_gender,
            "Sumber" => $filter_sumber,
            "Sales" => $filter_sales,
            "Kode" => $filter_kode,
            "Status" => $filter_status,
            "Start Date" => $filter_startdate,
            "Payment Date" => $filter_paydate,
            "Masa Tenggang" => $filter_masadate
            ];

        //sort
        $sortables = [
            "Tanggal Lahir" => "birthdate",
            "Kota" => "city",
            "Gender" => "gender",
            "Sumber" => "sumber_data",
            "Sales" => "sales_name",
            "Payment Date" => "payment_date",
            "Kode" => "kode",
            "Status" => "status",
            "Start Date" => "start_date",
            "Masa Tenggang" => "masa_tenggang"];

        //Return view table dengan parameter
        return view('vpc/aclubview',
                    [
                        'route' => 'AClub',
                        'clients' => $aclub_members,
                        'heads'=>$heads, 'atts'=>$atts,
                        'headsMaster' => $headsMaster,
                        'attsMaster' => $attsMaster,
                        'filter_birthdates' => $filter_birthdates,
                        'filter_cities' => $filter_cities,
                        'filter_gender' => $filter_gender,
                        'filter_sumber' => $filter_sumber,
                        'filter_sales' => $filter_sales,
                        'filter_kode' => $filter_kode,
                        'filter_status' => $filter_status,
                        'filter_date' => $filter_date,
                        'filterable' => $filterable,
                        'sortables' => $sortables,
                        'count' => $page_count
                    ]);
    }

    // DEPRECATED! DONT USE THIS! -Ramos-
    public function getFilteredTable($data, $json_filter) {
        $filter = json_decode($json_filter);
        $filtered_data = [];

        foreach ($data as $datum) {
            $valid = true;
            foreach ($filter as $key_filter => $values_filter) {
                if ($key_filter == 'birthdate') {
                    // made later
                } else {
                    if (!in_array($datum[$key_filter], $values_filter)) {
                        $valid = false;
                        break;
                    }
                }
            }
            if ($valid) {
                array_push($filtered_data, $datum);
            }
        }
        $filtered_data = collect($filtered_data);
        return $filtered_data;
    }

    // RETURN : LIST (COLLECTION) OF FILTERED AND SORTED TABLE LIST

    public function getFilteredAndSortedTable(Request $request) {
        // test
        // $example_filter = array('gender'=>['M'], 'birthdate'=>[4,5,6]);
        // $example_sort = array('email'=>false, 'name'=>true);
        // $json_filter = json_encode($example_filter);
        // $json_sort = json_encode($example_sort);
        // test

         $attsMaster = [
                        "user_id",
                        "name",
                        "email",
                        "telephone_number",
                        "birthdate"
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
                "aktif",
                "bulan_member",
                "bonus",
                "start_date",
                "expired_date",
                "masa_tenggang",
                "yellow_zone",
                "red_zone"
                ];

        $json_filter = $request['filters'];
        $json_sort = $request['sorts'];
        $page = 0;
        $page = $request['page']-1;
        $record_amount = 15;

        // add 'select' of query
        $query = QueryModifier::queryView('AClub', $json_filter, $json_sort);

        // retrieve result
        $list_old = DB::select(DB::raw($query['text']), $query['variables']);

        $record_count = count($list_old);
        $page_count = ceil($record_count/$record_amount); 
        // dd($list_old[0]);       

        $list = collect(array_slice($list_old, $page*$record_amount, $record_amount));
        foreach ($list as $aclub_member) {

            $last_kode = substr($aclub_member->kode,-1);
            if ($last_kode == 'S') {
                $aclub_member->bulan_member = 1;
            } else if($last_kode == 'G') {
                $aclub_member->bulan_member = 6;
            } else {
                $aclub_member->bulan_member = 12;
            }
        }
        return view('vpc/aclubtable',
                    [
                        'route' => 'AClub',
                        'clients' => $list,
                        'atts' => $atts,
                        'attsMaster' => $attsMaster,
                        'count' => $page_count
                    ]);
        // return $list;
    }
 

    public function clientDetail($id, Request $request) {
        // detail master dengan master_id = $id
        // dd(1);

        $aclub_information = AclubInformation::find($id);

        $query_member = QueryModifier::queryGetAclubMember($id);
        $aclub_members = collect(DB::select($query_member))->first();

        // aclub_master adalah aclub_master nya
        $aclub_master = $aclub_information->master;

        $ins = ["Master_id" => "master_id",
                "Sumber Data" => "sumber_data",
                "Keterangan" => "keterangan"];

        $heads = $ins;

        $keyword = $request['q'];

        $page = 0;
        $page = $request['page']-1;
        $record_amount = 5;

        $query = QueryModifier::queryGetTransactions($aclub_members->user_id);

        $aclub_transactions = DB::select($query);

        $total = count($aclub_transactions);
        $total = ceil($total / $record_amount);

        $aclub_transactions = collect(array_slice($aclub_transactions, $page*$record_amount, $record_amount));
        // $headsreg = ["User ID"];
        // $attsreg = ["user_id"];
        $headsreg = [ "Payment Date",
                       "Kode",
                       "Status",
                       "Nominal",
                       "Start Date",
                       "Expired Date",
                       "Masa Tenggang", 
                       "Sales"];
        $attsreg = ["payment_date", 
                    "kode", 
                    "status", 
                    "nominal", 
                    "start_date", 
                    "expired_date", 
                    "masa_tenggang",
                    "sales_name"];



        $insreg = ["User ID" => 1,
                    "Group" => 0,
                    "Sales Name" => 0,
                    "Payment Date" => 0,
                    "Kode" => 0,
                    "Status" => 0,
                    "Nominal" => 0,
                    "Start Date" => 0,
                    "Expired Date" => 0,
                    "Masa Tenggang" => 0,
                    "Red Zone" => 0,
                    "Yellow Zone" => 0];


        // yang ditampilin di page member cuman aclub_information dan aclub_members aja

        return view('profile/transtable', ['route'=>'AClub', 'client'=>$aclub_members, 
                    'clientsreg'=>$aclub_transactions, 'heads'=>$heads, 'ins'=>$ins, 
                    'insreg'=>$insreg, 'headsreg'=>$headsreg, 'attsreg'=>$attsreg,
                    'count'=>$total
                ]);
    }

    public function addMember(Request $request) {
        $this->validate($request, [
                'user_id' => 'required|unique:aclub_members',
                'master_id' => 'required',
            ]);

        $aclub_member = new \App\AclubMember();

        $err = [];

        $aclub_member->user_id = $request->user_id;
        $aclub_member->master_id = $request->master_id;

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
        return back();
    }

    public function clientDetailMember($id, $member, Request $request) {
        $aclub_member = AclubMember::where('user_id', $member)->first();

        $page = 0;
        $page = $request['page']-1;
        $record_amount = 5;

        $aclub_transaction_old = $aclub_member->aclubTransactions()->orderBy('created_at','desc');

        $total = $aclub_transaction_old->count();
        $total = ceil($total / $record_amount);

        $aclub_transaction = $aclub_transaction_old->skip($record_amount*$page)->take($record_amount)->get();

        // dd($aclub_transaction);
        
        foreach ($aclub_transaction as $aclub_trans) {
            $aclub_trans->payment_date_1 = $aclub_trans->payment_date->toDateString();
            $aclub_trans->start_date_1 = $aclub_trans->start_date->toDateString();
        }
        

        $heads = [  "User ID" => "user_id",
                    "Master ID" => "master_id"];

        $ins =  [   "Sales Name" => "sales_name"];

        $headsreg = [ "Payment Date",
                    "Kode",
                    "Status",
                    "Nominal",
                    "Sales Name",
                    "Start Date"
                    ];

        $insreg = [ "Payment Date" => 0,
                    "Kode" => 0,
                    "Status" => 0,
                    "Nominal" => 0,
                    "Sales Name" => 0,
                    "Start Date" => 0,
                    "Expired Date" => 0,
                    "Masa Tenggang" => 0,
                    "Yellow Zone" => 0,
                    "Red Zone" => 0];

        $attsreg = ["payment_date_1",
                    "kode",
                    "status",
                    "nominal",
                    "sales_name",
                    "start_date_1",
                    ];

        $page = $page + 1;
        if ($page < 1) {
            $page = 1;
        }

        return view('profile/aclubmember', ['route'=>'AClub', 'client'=>$aclub_member, 
                'clientsreg'=>$aclub_transaction, 'attsreg'=>$attsreg, 
                'insreg'=>$insreg, 'ins'=>$ins, 'headsreg'=>$headsreg, 
                'heads'=>$heads, 'page'=>$page, 'count'=>$total
            ]);
    }

    public function editMember(Request $request) {
        $this->validate($request, [
            ]);

        $err = [];
        try {
            $aclub_member = AclubMember::find($request->user_id);

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
        $aclub_transaction->payment_date_1 = $aclub_transaction->payment_date->toDateString();
        $aclub_transaction->start_date_1 = $aclub_transaction->start_date->toDateString();
        $aclub_transaction->expired_date_1 = $aclub_transaction->expired_date->toDateString();
        $aclub_transaction->masa_tenggang_1 = $aclub_transaction->masa_tenggang->toDateString();
        $aclub_transaction->yellow_zone_1 = $aclub_transaction->yellow_zone->toDateString();
        $aclub_transaction->red_zone_1 = $aclub_transaction->red_zone->toDateString();

        $heads = [  "Transaction ID" => 'transaction_id',
                    "User ID" => 'user_id',
                    "Payment Date" => 'payment_date_1',
                    "Kode" => 'kode',
                    "Status" => 'status',
                    "Nominal" => 'nominal',
                    "Start Date" => 'start_date_1',
                    "Expired Date" => 'expired_date_1',
                    "Masa Tenggang" => 'masa_tenggang_1',
                    "Yellow Zone" => 'yellow_zone_1',
                    "Red Zone" => 'red_zone_1',
                    "Sales Name" => 'sales_name'];

        $ins = [      "Payment Date" => "payment_date",
                        "Kode" => "kode",
                        "Status" => "status",
                        "Nominal" => "nominal",
                        "Sales Name" => "sales_name",
                        "Start Date" => "start_date",
                        "Expired Date" => "expired_date",
                        "Masa Tenggang" => "masa_tenggang",
                        "Yellow Zone" => "yellow_zone",
                        "Red Zone" => "red_zone",
                        "Sales Name" => "sales_name"];

        $insreg = [     "Payment Date" => 0,
                        "Kode" => 0,
                        "Status" => 0,
                        "Nominal" => 0,
                        "Sales Name" => 0,
                        "Start Date" => 0,
                        "Expired Date" => 0,
                        "Masa Tenggang" => 0,
                        "Yellow Zone" => 0,
                        "Red Zone" => 0,
                        "Sales Name" => 0];

        $attsreg = ["payment_date",
                    "kode",
                    "status",
                    "nominal",
                    "sales_name",
                    "start_date",
                    "expired_date",
                    "masa_tenggang",
                    "yellow_zone",
                    "red_zone",
                    "sales_name"];
//dd($aclub_transaction);
        return view('profile/aclubpackage', ['route'=>'AClub', 'client'=>$aclub_transaction, 'trans'=>$aclub_transaction, 'clientsreg'=>$aclub_transaction, 'attsreg'=>$attsreg, 'insreg'=>$insreg, 'ins'=>$ins, 'headsreg'=>$insreg, 'heads'=>$heads]);
    }

    public function editClient(Request $request) {
        //Validasi input
        $this->validate($request, [
                'sumber_data' => '',
                'keterangan' => ''
            ]);

        $err = [];
        try {
            $aclub = AclubInformation::find($request->master_id);

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
                'user_id' => 'required',
                'payment_date' => 'date',
                'kode' => '',
                'status_aclub' => '',
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
        $aclub_trans->status = $request->status_aclub;
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
                'sales_aclub' => '',
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
            $aclub_trans->status = $request->status_aclub;
            $aclub_trans->nominal = $request->nominal;
            $aclub_trans->sales_name = $request->sales_aclub;
            $aclub_trans->start_date = $request->start_date;
            $aclub_trans->expired_date = $request->expired_date;
            $aclub_trans->masa_tenggang = $request->masa_tenggang;
            $aclub_trans->yellow_zone = $request->yellow_zone;
            $aclub_trans->red_zone = $request->red_zone;
            
            $aclub_member = $aclub_trans->aclubMember;

            $aclub_trans->update();
            $aclub_member->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        if(!empty($err)) {
            return redirect()->back()->withErrors($err);
        } else {
            return redirect()->route('detail', ['id' => $aclub_trans->aclubmember->first()->master_id]);
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
                //Jika tidak ada error, import dengan cara insert satu per satu
                if (empty($err)) {
                    $line = 1;
                    foreach ($data as $key => $value) {
                        $line += 1;
                        try {
                             // check whether master client exist or not
                            $is_master_have_attributes = False;
                            $master_id = null;
                            $master = MasterClient::where('email', $value->email)->first();
                            if ($master == null) {
                                $master = new \App\MasterClient;

                                $master_attributes = $master->getAttributesImport();

                                foreach ($master_attributes as $master_attribute => $import) {
                                    if ($value->$import != null) {
                                        $master->$master_attribute = $value->$import;
                                        $is_master_have_attributes = True;
                                    } else {
                                        $master->$master_attribute = null;
                                    }
                                }

                                if ($is_master_have_attributes) {
                                    $master->save();
                                    $master_id = $master->master_id;
                                }
                            } else {
                                $master_id = $master->master_id;
                            }
                            $value->master_id = $master_id;

                            // check whether aclub information exist or not
                            $is_info_have_attributes = False;
                            if (AclubInformation::find($master_id) == null) {
                                $aclub_info = new \App\AclubInformation;

                                $aclub_info_attributes = $aclub_info->getAttributesImport();

                                foreach ($aclub_info_attributes as $aclub_info_attribute => $import) {
                                    if ($value->$import != null) {
                                        $aclub_info->$aclub_info_attribute = $value->$import;
                                        $is_info_have_attributes = True;
                                    } else {
                                        $aclub_info->$aclub_info_attribute = null;
                                    }
                                }

                                if ($is_info_have_attributes) {
                                    $aclub_info->save();
                                }
                            } else {
                                $aclub_info = AclubInformation::find($master_id);

                                $aclub_info_attributes = $aclub_info->getAttributesImport();
                                foreach ($aclub_info_attributes as $aclub_info_attribute => $import) {
                                    if ($value->$import != null) {
                                        $aclub_info->$aclub_info_attribute = $value->$import;
                                        $is_info_have_attributes = True;
                                    } else {
                                        $aclub_info->$aclub_info_attribute = null;
                                    }
                                }
                                $aclub_info->master_id = $master_id;
                                if ($is_info_have_attributes) {
                                    $aclub_info->update();
                                }
                            }

                            // check whether aclub member exist or not
                            $is_member_have_attributes = False;
                            if (AclubMember::find($value->user_id) == null) {
                                $aclub_member = new \App\AclubMember;

                                $aclub_member_attributes = $aclub_member->getAttributesImport();

                                foreach ($aclub_member_attributes as $aclub_member_attribute => $import) {
                                    if ($value->$import != null) {
                                        $aclub_member->$aclub_member_attribute = $value->$import;
                                        $is_member_have_attributes = True;
                                    } else {
                                        $aclub_member->$aclub_member_attribute = null;
                                    }
                                }

                                if ($is_member_have_attributes) {
                                    $aclub_member->save();
                                }
                            }

                            $is_trans_have_attributes = False;
                            $aclub_trans = new \App\AclubTransaction;

                            $aclub_trans_attributes = $aclub_trans->getAttributesImport();

                            foreach ($aclub_trans_attributes as $aclub_trans_attribute => $import) {
                                if ($import != 'user_id') {
                                    if ($value->$import != null) {
                                        $aclub_trans->$aclub_trans_attribute = $value->$import;
                                        $is_trans_have_attributes = True;
                                    } else {
                                        $aclub_trans->$aclub_trans_attribute = null;
                                    }
                                } else {
                                    if ($value->$import != null) {
                                        $aclub_trans->$aclub_trans_attribute = $value->$import;
                                    } else {
                                        $aclub_trans->$aclub_trans_attribute = null;
                                    }
                                }
                                
                            }

                            if ($is_trans_have_attributes) {  
                                $aclub_trans->save();
                            }

                        } catch(\Illuminate\Database\QueryException $ex) {
                          # echo ($ex->getMessage());
                          $raw_msg = $ex->getMessage(); # SQL STATE MENTAH
                          $err[] = QueryExceptionMapping::mapQueryException($raw_msg, $line);
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
        $data = collect([]);

        $members = AclubMember::all();

        foreach ($members as $member) {
            $transactions = $member->aclubTransactions()->get();

            if ($transactions->first() != null) {
                foreach ($transactions as $transaction) {
                    $object = $transaction;

                    $object->user_id = $member->user_id;

                    $info = $member->aclubInformation;

                    $object->sumber_data = $info->sumber_data;
                    $object->keterangan = $info->keterangan;

                    $master = $member->master;

                    $object->redclub_user_id = $master->redclub_user_id;
                    $object->redclub_password = $master->redclub_password;
                    $object->name = $master->name;
                    $object->telephone_number = $master->telephone_number;
                    $object->email = $master->email;
                    $object->birthdate = $master->birthdate;
                    $object->address = $master->address;
                    $object->city = $master->city;
                    $object->province = $master->province;
                    $object->gender = $master->gender;
                    $object->line_id = $master->line_id;
                    $object->bbm = $master->bbm;
                    $object->whatsapp = $master->whatsapp;
                    $object->facebook = $master->facebook;

                    $data->push($object);
                }
            } else {
                $object = new \stdClass();

                $info = $member->aclubInformation;

                $object->sumber_data = $info->sumber_data;
                $object->keterangan = $info->keterangan;

                $master = $member->master;

                $object->redclub_user_id = $master->redclub_user_id;
                $object->redclub_password = $master->redclub_password;
                $object->name = $master->name;
                $object->telephone_number = $master->telephone_number;
                $object->email = $master->email;
                $object->birthdate = $master->birthdate;
                $object->address = $master->address;
                $object->city = $master->city;
                $object->province = $master->province;
                $object->gender = $master->gender;
                $object->line_id = $master->line_id;
                $object->bbm = $master->bbm;
                $object->whatsapp = $master->whatsapp;
                $object->facebook = $master->facebook;

                $trans = new \App\AclubTransaction();
                $trans_attributes = $trans->getAttributesImport();

                foreach ($trans_attributes as $trans_attribute) {
                    $object->$trans_attribute = null;
                }

                $object->user_id = $member->user_id;

                $data->push($object);
            }
        }

        $array = [];
        $heads = ["User ID Redclub" => "redclub_user_id",
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
                    "Facebook" => "facebook",
                    "Sumber Data" => "sumber_data",
                    "Keterangan" => "keterangan",
                    "User ID" => "user_id",
                    "Payment Date" => "payment_date",
                    "Kode" => "kode",
                    "Status" => "status",
                    "Nominal" => "nominal",
                    "Start Date" => "start_date",
                    "Expired Date" => "expired_date",
                    "Masa Tenggang" => "masa_tenggang",
                    "Yellow Zone" => "yellow_zone",
                    "Red Zone" => "red_zone",
                    "Sales Name" => "sales_name"];
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

        $ins = [];

        return view('content/aclubmembereditform', ['route'=>'AClub', 'client'=>$aclub_member, 'ins'=>$ins]);
    }

    public function updateTrans($id) {
        $aclub_transaction = AclubTransaction::where('transaction_id', $id)->first();

        $ins = [    "Payment Date" => 'payment_date',
                    "Kode" => 'kode',
                    "Status" => 'status',
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
        $updated_values = [];
        foreach ($ids as $id) {
          $aclub = AclubTransaction::where('transaction_id', $id)->first();

          $aclub->masa_tenggang = $aclub->masa_tenggang->addDays($days);

          $aclub->update();
          $aclub = AclubTransaction::where('transaction_id', $id)->first();
          $updated_values[$id] = $aclub->masa_tenggang->toDateTimeString();
        }
        return response()->json($updated_values);
      } else {
        echo("Failed, insufficient information");
      }
    }

    public function templateExcel() {
        $array = [];
        $heads = ["User ID Redclub" => "redclub_user_id",
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
                    "Facebook" => "facebook",
                    "Sumber Data" => "sumber_data",
                    "Keterangan" => "keterangan",
                    "User ID" => "user_id",
                    "Payment Date" => "payment_date",
                    "Kode" => "kode",
                    "Status" => "status",
                    "Nominal" => "nominal",
                    "Start Date" => "start_date",
                    "Expired Date" => "expired_date",
                    "Masa Tenggang" => "masa_tenggang",
                    "Yellow Zone" => "yellow_zone",
                    "Red Zone" => "red_zone",
                    "Sales Name" => "sales_name"];

        $arr = [];
        foreach ($heads as $head => $value) {
            if ($head == "Master ID") {
                 $count_master_id = MasterClient::orderBy('master_id', 'desc')->first();
                if ($count_master_id == null) {
                    $arr[$head] = '1';
                } else {
                    $arr[$head] = $count_master_id->master_id;
                }
            } else {
                $arr[$head] = null;
            }
        }
        $array[] = $arr;

        return Excel::create('TemplateAClub', function($excel) use ($array) {
            $excel->sheet('Sheet1', function($sheet) use ($array)
            {
                $sheet->fromArray($array);
            });
        })->export('xls');
    }
}
