<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Excel;
use App\Cat;

class CATController extends Controller
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

            $aclub_member->bonus = $aclub_member->masa_tenggang->diffInDays($aclub_member->expired_date);

            $aclub_member->expired_date = $last_transaction->expired_date->toDateString();
            $aclub_member->masa_tenggang = $last_transaction->masa_tenggang->toDateString();

            $last_kode = substr($aclub_member->kode,-1);
            if ($last_kode == 'S') {
                $aclub_member->bulan_member = 1;
            } else if($last_kode == 'G') {
                $aclub_member->bulan_member = 6;
            } else {
                $aclub_member->bulan_member = 12;
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
        $record_amount = 3;

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
                        "master_id",
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
        $record_amount = 3;


        // add 'select' of query

        $query =        "SELECT *, ";
        $query = $query."(masa_tenggang-expired_date) as bonus, ";
        $query = $query."IF(masa_tenggang > NOW(), 'Aktif', 'Tidak Aktif') as aktif ";
        $query = $query."FROM ";
        $query = $query."master_clients ";
        $query = $query."INNER JOIN aclub_informations ON master_clients.master_id = aclub_informations.master_id ";
        $query = $query."INNER JOIN aclub_members ON master_clients.master_id = aclub_members.master_id ";
        $query = $query."INNER JOIN (SELECT  T1.user_id as user_id, transaction_id, payment_date, kode, status, ";
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
                        'attsMaster' => $attsMaster
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

    public function clientDetail($id) {
        $cat = Cat::where('user_id', $id)->first();

        //judul + sql
        $ins= ["User ID" => "user_id",
                "Nomor Induk" => "nomor_induk",
                "Batch" => "batch",
                "Sales" => "sales_name",
                ];
        $heads = $ins;

        //form transaction
        $insreg = [ "Nomer Induk" => 'nomor_induk',
                    "DP Date" => 'DP_date',
                    "DP Nominal" => 'DP_nominal',
                    "Payment Date" => 'payment_date',
                    "Payment Nominal" => 'payment_nominal',
                    "Opening Class" => "tanggal_opening_class",
                    "End Class" => 'tanggal_end_class',
                    "Ujian" => 'tanggal_ujian',
                    "Status" => 'status',
                    "Keterangan" => 'keterangan'
                    ];

        //transaction
        $headsreg = [   "Nomer Induk" => 'nomor_induk',
                        "DP Date" => 'DP_date',
                        "DP Nominal" => 'DP_nominal',
                        "Payment Date" => 'payment_date',
                        "Payment Nominal" => 'payment_nominal',
                        "Opening Class" => "tanggal_opening_class",
                        "End Class" => 'tanggal_end_class',
                        "Ujian" => 'tanggal_ujian',
                        "Status" => 'status',
                        "Keterangan" => 'keterangan'
                    ];

		return view('profile/profile', ['route'=>'CAT', 'client'=>$cat, 'heads'=>$heads, 'ins'=>$ins, 'insreg'=>$insreg, 'headsreg'=>$headsreg]);
    }

    public function addTrans(Request $request) {
        $this->validate($request, [
                'payment_date' => 'date',
                'nominal' => 'integer',
                'tanggal_end_class' => 'date',
                'tanggal_ujian' => 'date',
                'status' => '',
                'keterangan' => ''
            ]);

        $cat = Cat::where('user_id',$request->user_id)->first();

        $err =[];

        $cat->nomor_induk = $request->nomor_induk;
        $cat->DP_date = $request->DP_date;
        $cat->DP_nominal = $request->DP_nominal;
        $cat->payment_date = $request->payment_date;
        $cat->payment_nominal = $request->payment_nominal;
        $cat->tanggal_opening_class = $request->tanggal_opening_class;
        $cat->tanggal_end_class = $request->tanggal_end_class;
        $cat->tanggal_ujian = $request->tanggal_ujian;
        $cat->status = $request->status;
        $cat->keterangan = $request->keterangan;

        $cat->update();

        return redirect()->back()->withErrors($err);
    }

    public function deleteClient($id) {
        //Menghapus client dengan ID tertentu
        try {
            $cat = Cat::find($id);
            $cat->delete();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect("home");
    }

    public function editClient(Request $request) {
        //Validasi input
        $this->validate($request, [
                'user_id' => 'required|unique:cats',
                'nomor_induk' => 'required|unique:cats',
                'batch' => '',
                'sales' => ''
            ]);
        $cat = Cat::where('user_id',$request->user_id)->first();
        //Inisialisasi array error
        $err = [];

        try {
            $cat->user_id = $request->user_id;
            $cat->nomor_induk = $request->nomor_induk;
            $cat->batch = $request->batch;
            $cat->sales_name = $request->sales;

            $cat->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect()->back()->withErrors($err);
    }

  //VERSI LAMA

    public function detailTrans($id){
        echo ($id);
         $clientsreg = DB::select("select * from laporan_pembayaran_cat where angsuran_ke = (?)", [$id]);
         $clientsreg = $clientsreg[0];
        $headsreg = ["Angsuran ke", "Tanggal Pembayaran Angsuran", "Pembayaran Angsuran"];
        $attsreg = ["angsuran_ke", "tanggal_pembayaran_angsuran", "pembayaran_angsuran"];
        return view('profile/transaction', ['route'=>'CAT/trans',  'clientsreg'=>$clientsreg, 'attsreg'=>$attsreg, 'headsreg'=>$headsreg]);
    }

    public function deleteTrans($id1, $id2){
        echo ($id1);
        echo ($id2);
        $err = [];
        try{
            DB::select("call delete_laporan_pembayaran_cat(?,?)", [$id1, $id2]);
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }

        return redirect()->back()->withErrors($err);
    }

    public function importExcel() {
        $err = []; //Inisialisasi array error
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath(); //Mengecek apakah file diberikan
            $data = Excel::load($path, function($reader) { //Load excel
            })->get();
            if(!empty($data) && $data->count()){
                $i = 1;
                //Cek apakah ada error
                foreach ($data as $key => $value) {
                    $i++;
                    if (($value->user_id) === null) {
                        $msg = "User ID empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->master_id) === null) {
                        $msg = "Master ID empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->batch) === null) {
                        $msg = "Batch empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->sales) === null) {
                        $msg = "Sales empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->sumber_data) === null) {
                        $msg = "Sumber Data empty on line ".$i;
                        $err[] = $msg;
                    }
                } //end validasi

                //Jika tidak ada error, import dengan cara insert satu per satu
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        try {
                            $cat = new \App\Cat;

                            $cat->user_id = $value->user_id;
                            $cat->master_id = $value->master_id;
                            $cat->batch = $value->batch;
                            $cat->sales_name = $value->sales;
                            $cat->sumber_data = $value->sumber_data;

                            $cat->save();
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
        $data = Cat::all();
        $array = [];
        $heads = ["User ID" => "user_id", "Nomor Induk" => "nomor_induk", "Master ID" => "master_id", "Batch" => "batch", "Sales" => "sales", "Sumber Data" => "sumber_data", "DP Date" => "DP_date", "DP Nominal" => "DP_nominal", "Payment Date" => "payment_date", "Payment Nominal" => "payment_nominal", "Tanggal Opening Class" => "tanggal_opening_class", "Tanggal End Class" => "tanggal_end_class", "Tanggal Ujian" => "tanggal_ujian", "Status" => "status", "Keterangan" => "keterangan"];
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
        return Excel::create('ExportedCAT', function($excel) use ($array) {
            $excel->sheet('Sheet1', function($sheet) use ($array)
            {
                $sheet->fromArray($array);
            });
        })->export('xls');
    }
}
