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
        $aclub_members = AclubMember::all();

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

            //data from aclub transaction
            if ($aclub_member->aclubTransactions()->orderBy('masa_tenggang','desc')->first() != null) {
                $last_transaction = $aclub_member->aclubTransactions()->orderBy('masa_tenggang','desc')->first();
                $aclub_member->sales_name = $last_transaction->sales_name;
                $aclub_member->payment_date = $last_transaction->payment_date->toDateString();
                $aclub_member->kode = $last_transaction->kode;
                $aclub_member->status = $last_transaction->status;
                $aclub_member->start_date = $last_transaction->start_date->toDateString();
                $aclub_member->expired_date = $last_transaction->expired_date;
                $aclub_member->yellow_zone = $last_transaction->yellow_zone->toDateString();
                $aclub_member->red_zone = $last_transaction->red_zone->toDateString();
                $aclub_member->masa_tenggang = $last_transaction->masa_tenggang;
                $aclub_member->transaction_id = $last_transaction->transaction_id;

                $aclub_member->bonus = $aclub_member->masa_tenggang->diffInDays($aclub_member->expired_date);

                $aclub_member->expired_date = $last_transaction->expired_date->toDateString();
                $aclub_member->masa_tenggang = $last_transaction->masa_tenggang->toDateString();
            } else {
                $aclub_member->sales_name = null;
                $aclub_member->payment_date = null;
                $aclub_member->kode = null;
                $aclub_member->status = null;
                $aclub_member->start_date = null;
                $aclub_member->expired_date = null;
                $aclub_member->yellow_zone = null;
                $aclub_member->red_zone = null;
                $aclub_member->masa_tenggang = null;
                $aclub_member->transaction_id = null;

                $aclub_member->bonus = null;

                $aclub_member->expired_date = null;
                $aclub_member->masa_tenggang = null;
            }

            $last_kode = substr($aclub_member->kode,-1);
            if ($last_kode == 'S') {
                $aclub_member->bulan_member = 1;
            } else if($last_kode == 'G') {
                $aclub_member->bulan_member = 6;
            } else if ($last_kode == 'P') {
                $aclub_member->bulan_member = 12;
            } else {
                $aclub_member->bulan_member = null;
            }

            if ($aclub_member->masa_tenggang < Carbon::now()) {
                $aclub_member->aktif = 'tidak aktif';
            } else {
                $aclub_member->aktif = 'aktif';
            }

            //data from aclub information
            $aclub_info = $aclub_member->aclubInformation;
            $aclub_member->sumber_data = $aclub_info->sumber_data;
        }

        return $aclub_members;
    }

    public function getTable(Request $request) {
        // $keyword = $request['q'];

        // $aclub_info = AclubInformation::where('sumber_data', 'like', "%{$keyword}%")
        //         ->orWhere('keterangan', 'like', "%{$keyword}%")
        //         ->paginate(15);
        $page = 0;
        $page = $request['page']-1;
        $record_amount = 15;

        $aclub_members = $this->getData();
        $record_count = count($aclub_members);
        $aclub_members = $aclub_members->forPage(1, $record_amount);
        // $aclub_members = collect(array_slice($aclub_members, $page*$record_amount, $record_amount));
        // $aclub_members = $aclub_members->skip($record_amount*$page)->take($record_amount);

        // dd($aclub_members);
        $page_count = ceil($record_count/$record_amount);

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

        // $this->getFilteredAndSortedTable('test');

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

        $filterable = [
            "Kota" => $filter_cities,
            "Gender" => $filter_gender,
            "Sumber" => $filter_sumber,
            "Sales" => $filter_sales,
            "Kode" => $filter_kode,
            "Status" => $filter_status,
            "Start Date" => $filter_date,
            "Payment Date" => $filter_date,
            "Masa Tenggang" => $filter_date
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
                        "master_id",
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

        $query =        "SELECT *, ";
        $query = $query."(masa_tenggang-expired_date) as bonus, ";
        $query = $query."IF(masa_tenggang > NOW(), 'Aktif', 'Tidak Aktif') as aktif ";
        $query = $query."FROM ";
        $query = $query."master_clients ";
        $query = $query."INNER JOIN aclub_informations ON master_clients.master_id = aclub_informations.master_id ";
        $query = $query."INNER JOIN aclub_members ON master_clients.master_id = aclub_members.master_id ";
        $query = $query."LEFT JOIN (SELECT  T1.user_id as user_id, transaction_id, payment_date, kode, status, ";
        $query = $query."         start_date, expired_date, T1.masa_tenggang, yellow_zone, red_zone, sales_name ";
        $query = $query."            FROM ";
        $query = $query."                ( SELECT user_id, max(masa_tenggang) as masa_tenggang ";
        $query = $query."                    FROM aclub_transactions ";
        $query = $query."                    GROUP BY user_id) as T1 ";
        $query = $query."            INNER JOIN ";
        $query = $query."                ( SELECT *";
        $query = $query."                   FROM aclub_transactions) as T2 ";
        $query = $query."                    ON T1.user_id = T2.user_id ";
        $query = $query."                    AND T1.masa_tenggang = T2.masa_tenggang) as last_transaction ";
        $query = $query."ON aclub_members.user_id = last_transaction.user_id ";

        // add subquery of filter
        $query = $this->addFilterSubquery($query, $json_filter);
        // add subquery of sort
        $query = $this->addSortSubquery($query, $json_sort);
        // add semicolon
        $query = $query.";";

        // retrieve result
        $list_old = DB::select($query);

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
 
    // RETURN : STRING QUERY FOR FILTER IN SQL 
    // NOTE : WITHOUT SEMICOLON
    public function addFilterSubquery($query, $json_filter) {
        $filter = json_decode($json_filter, true);

        if (empty($filter)) {
            return $query;
        }

        // add 'where' of query
        $query = $query.' WHERE ';        
        $is_first = true;
        foreach ($filter as $key_filter => $values_filter) {
            if (!$is_first) {
                $query = $query." and ";
            }
            $idx_filter = 0;
            $query = $query.'(';

            if (in_array($key_filter, ['birthdate','payment_date'])) {
                $idx_value = 0;
                foreach ($values_filter as $value_filter) {
                    $query = $query."MONTH(".$key_filter.")"." = '".$value_filter."'";
                    $idx_value += 1;
                    if ($idx_value != count($values_filter)) {
                        $query = $query." or ";
                    }   
                 }
            } else {
                $idx_value = 0;
                foreach ($values_filter as $value_filter) {
                    $query = $query.$key_filter." = '".$value_filter."'";
                    $idx_value += 1;
                    if ($idx_value != count($values_filter)) {
                        $query = $query." or ";
                    }
                 }
            }
            $query = $query.')';
            $is_first = false;
        }   

        // get result
        return $query;
    }

    public function addSortSubquery($query, $json_sort) {
        $sort = json_decode($json_sort, true);

        if (empty($sort)) {
            return $query;
        }
        
        $subquery = " ORDER BY ";
        $idx_sort = 0;
        foreach ($sort as $key_sort => $value_sort) {
            if ($value_sort == true) {
                $subquery = $subquery.$key_sort." ASC";            
            } else {
                $subquery = $subquery.$key_sort." DESC";                            
            }
            $idx_sort += 1;
            if ($idx_sort != count($sort)) {
                $subquery = $subquery.", ";
            }
        }
        $query = $query.$subquery;
        return $query;
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

        $page = 0;
        $page = $request['page']-1;
        $record_amount = 5;

        $query = "SELECT * FROM aclub_members ";
        $query = $query."WHERE (master_id = ".$aclub_master->master_id.") ";
        $query = $query."AND ";
        $query = $query."( ";
        $query = $query."user_id like '%".$keyword."%' ";
        $query = $query."OR ";
        $query = $query."aclub_members.group like '%".$keyword."%' ";        
        $query = $query.") ";

        $aclub_members_old = DB::select($query);

        // $aclub_members_old = $aclub_master->aclubMembers()
        //                     ->where('user_id', 'like', "%{$keyword}%")
        //                     ->orWhere('aclub_members.group', 'like', "%{$keyword}%")->get();

        // dd($aclub_members_old);
                    
        $total = count($aclub_members_old->get());
        $total = ceil($total / $record_amount);

        $aclub_members = $aclub_members_old->skip($record_amount*$page)->take($record_amount)->get();
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

        return view('profile/transtable', ['route'=>'AClub', 'client'=>$aclub_information, 
                    'clientsreg'=>$aclub_members, 'heads'=>$heads, 'ins'=>$ins, 
                    'insreg'=>$insreg, 'headsreg'=>$headsreg, 'attsreg'=>$attsreg,
                    'count'=>$total
                ]);
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
        return back();
    }

    public function clientDetailMember($id, $member, Request $request) {
        $aclub_member = AclubMember::where('user_id', $member)->first();

        $page = 0;
        $page = $request['page']-1;
        $record_amount = 5;

        $aclub_transaction_old = $aclub_member->aclubTransactions();

        $total = count($aclub_transaction_old->get());
        $total = ceil($total / $record_amount);

        $aclub_transaction = $aclub_transaction_old->skip($record_amount*$page)->take($record_amount)->get();

        // dd($aclub_transaction);
        
        foreach ($aclub_transaction as $aclub_trans) {
            $aclub_trans->payment_date_1 = $aclub_trans->payment_date->toDateString();
            $aclub_trans->start_date_1 = $aclub_trans->start_date->toDateString();
        }
        

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
                    "Red Zone" => 'red_zone_1'];

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
                'master_id' => 'required',
                'sumber_data' => '',
                'keterangan' => ''
            ]);

        $err = [];
        try {
            $aclub = AclubInformation::find($request->master_id);

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
        $datas = AclubTransaction::all();

        foreach ($datas as $data) {
            $member = $data->aclubMember->first();

            $data->master_id = $member->master_id;
            $data->group = $member->group;

            $info = $member->aclubInformation->first();

            $data->sumber_data = $info->sumber_data;
            $data->keterangan = $info->keterangan;

            $master = $member->master->first();

            $data->redclub_user_id = $master->redclub_user_id;
            $data->redclub_password = $master->redclub_password;
            $data->name = $master->name;
            $data->telephone_number = $master->telephone_number;
            $data->email = $master->email;
            $data->birthdate = $master->birthdate;
            $data->address = $master->address;
            $data->city = $master->city;
            $data->province = $master->province;
            $data->gender = $master->gender;
            $data->line_id = $master->line_id;
            $data->bbm = $master->bbm;
            $data->whatsapp = $master->whatsapp;
            $data->facebook = $master->facebook;
        }
        $array = [];
        $heads = ["Transaction ID" => "transaction_id",
                    "Master ID" => "master_id",
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
                    "Facebook" => "facebook",
                    "Sumber Data" => "sumber_data",
                    "Keterangan" => "keterangan",
                    "Group" => "group",
                    "Payment Date" => "payment_date",
                    "Kode" => "kode",
                    "Status" => "status",
                    "Nominal" => "nominal",
                    "Start Date" => "start_date",
                    "Expired Date" => "expired_date",
                    "Masa Tenggang" => "masa_tenggang",
                    "Yellow Zone" => "yellow_zone",
                    "Red Zone" => "red_zone",
                    "Sales Name" => "sales_name",
                    "Created At" => "created_at",
                    "Updated At" => "updated_at"];
        foreach ($datas as $dat) {
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
}
