<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;
use App\AshopTransaction;
use App\MasterClient;

class AshopController extends Controller
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

    public function getData()
    {
        $query = "SELECT * FROM master_clients ";
        $query = $query."INNER JOIN (SELECT T1.master_id, transaction_id, product_type, product_name,  ";
        $query = $query."            nominal, T1.created_at, updated_at, created_by, updated_by ";
        $query = $query."            FROM  ";
        $query = $query."                ( SELECT master_id, max(created_at) as created_at  ";
        $query = $query."                    FROM ashop_transactions ";
        $query = $query."                    GROUP BY master_id) as T1  ";
        $query = $query."            INNER JOIN  ";
        $query = $query."                ( SELECT * ";
        $query = $query."                   FROM ashop_transactions) as T2  ";
        $query = $query."                    ON T1.master_id = T2.master_id  ";
        $query = $query."                    AND T1.created_at = T2.created_at) as last_transaction  ";
        $query = $query."ON master_clients.master_id = last_transaction.master_id ";

        $query = $query.";";

        $masters = collect(DB::select($query));

        return $masters;
    }

    public function getTable(Request $request) {
        $page = 0;
        $page = $request['page']-1;
        $record_amount = 15;

        $masters = $this->getData();
        $record_count = count($masters);
        $masters = $masters->forPage(1, $record_amount);

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
                "Product" => "product_type",
                "Nama Product" => "product_name"
                ];
        

        //Nama attribute pada sql
        $atts = [
                "address",
                "city",
                "gender",
                "product_type",
                "product_name"
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
        $filter_product_type = DB::table('ashop_transactions')->select('product_type')->distinct()->get();
        $filter_product_name = DB::table('ashop_transactions')->select('product_name')->distinct()->get();
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
            "Product" => $filter_product_type,
            "Nama Product" => $filter_product_name
            ];

        //sort
        $sortables = [
            "Tanggal Lahir" => "birthdate",
            "Kota" => "city",
            "Gender" => "gender",
            "Product" => "product_type",
            "Nama Product" => "product_name"
            ];

        //Return view table dengan parameter
        return view('vpc/ashopview',
                    [
                        'route' => 'AShop',
                        'clients' => $masters,
                        'heads'=>$heads, 'atts'=>$atts,
                        'headsMaster' => $headsMaster,
                        'attsMaster' => $attsMaster,
                        'filter_birthdates' => $filter_birthdates,
                        'filter_cities' => $filter_cities,
                        'filter_gender' => $filter_gender,
                        'filter_date' => $filter_date,
                        'filterable' => $filterable,
                        'sortables' => $sortables,
                        'count' => $page_count
                    ]);
    }

    public function getFilteredAndSortedTable(Request $request) {
        // test
        // $example_filter = array('gender'=>['M'], 'birthdate'=>[4,5,6]);
        // $example_sort = array('email'=>false, 'name'=>true);

        // $json_filter = json_encode($example_filter);
        // $json_sort = json_encode($example_sort);
        // test
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
                "Product" => "product_type",
                "Nama Product" => "product_name"
                ];
        

        //Nama attribute pada sql
        $atts = [
                "address",
                "city",
                "gender",
                "product_type",
                "product_name"
                ];

        $json_filter = $request['filters'];
        $json_sort = $request['sorts'];
        $page = 0;
        $page = $request['page']-1;
        $record_amount = 15;

        // add 'select' of query

        $query = "SELECT * FROM master_clients ";
        $query = $query."INNER JOIN (SELECT T1.master_id, transaction_id, product_type, product_name,  ";
        $query = $query."            nominal, T1.created_at, updated_at, created_by, updated_by ";
        $query = $query."            FROM  ";
        $query = $query."                ( SELECT master_id, max(created_at) as created_at  ";
        $query = $query."                    FROM ashop_transactions ";
        $query = $query."                    GROUP BY master_id) as T1  ";
        $query = $query."            INNER JOIN  ";
        $query = $query."                ( SELECT * ";
        $query = $query."                   FROM ashop_transactions) as T2  ";
        $query = $query."                    ON T1.master_id = T2.master_id  ";
        $query = $query."                    AND T1.created_at = T2.created_at) as last_transaction  ";
        $query = $query."ON master_clients.master_id = last_transaction.master_id ";
        
        // add subquery of filter
        $query = $this->addFilterSubquery($query, $json_filter);
        // add subquery of sort
        $query = $this->addSortSubquery($query, $json_sort);
        // add semicolon
        $query = $query.";";

        // retrieve result
        $list_old = DB::select($query);
        $list = collect(array_slice($list_old, $page*$record_amount, $record_amount));

        $record_count = count($list_old);
        $page_count = ceil($record_count/$record_amount);       
        return view('vpc/ashoptable',
                    [
                        'route' => 'AShop',
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

    public function clientDetail($id) {
        $master = MasterClient::find($id);

        //judul + sql
        $ins= ["Red Club User ID" => "redclub_user_id",
          "Red Club Password" => "redclub_password",
          "Nama" => "name",
          "Telephone" => "telephone_number",
          "Email" => "email",
          "Tanggal Lahir" =>"birthdate",
          "Alamat" => "address",
          "Kota" => "city",
          "Provinsi" => "province",
          "Jenis Kelamin" => "gender",
          "Line ID" => "line_id",
          "BBM" => "bbm",
          "WhatsApp" => "whatsapp",
          "Facebook" => "facebook"
                ];

        $heads = ["Master ID" => "master_id",
          "Red Club User ID" => "redclub_user_id",
          "Red Club Password" => "redclub_password",
          "Nama" => "name",
          "Telephone" => "telephone_number",
          "Email" => "email",
          "Tanggal Lahir" =>"birthdate",
          "Alamat" => "address",
          "Kota" => "city",
          "Provinsi" => "province",
          "Jenis Kelamin" => "gender",
          "Line ID" => "line_id",
          "BBM" => "bbm",
          "WhatsApp" => "whatsapp",
          "Facebook" => "facebook"
                ];

        $clientsreg = $master->ashopTransactions()->get();

        //form transaction
        $insreg = [ "Product Type",
                    "Nama Product",
                    "Nominal"
                    ];

        //transaction
        $headsreg = [ "Product Type",
                    "Nama Product",
                    "Nominal"
                    ];

        $attsreg = ["product_type", "product_name", "nominal"];

        return view('profile/profile', ['route'=>'AShop', 'client'=>$master, 'heads'=>$heads, 'ins'=>$ins, 'insreg'=>$insreg, 'headsreg'=>$headsreg, 'clientsreg' => $clientsreg, 'attsreg' => $attsreg]);
    }

     public function editClient(Request $request) {
         $this->validate($request, [
                'master_id' => 'required|unique:master_clients',
                'redclub_user_id' => '',
                'name' => '',
                'telephone_number' => '',
                'email' => 'required|email',
                'birthdate' => 'date',
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

    public function clientDetailTrans($id, $trans) {

        $ashop = AshopTransaction::where('transaction_id', $trans)->first();

        $heads = ["Transaction ID" => "transaction_id",
                    "Master ID" => "master_id",
                    "Product" => "product_type",
                    "Nama Product" => "product_name",
                    "Nominal" => "nominal"];

        $ins = ["Product" => "product_type",
                "Nama Product" => "product_name",
                "Nominal" => "nominal"];
        //dd($aclub_transaction);

        return view('profile/ashoptransaction', ['route'=>'AShop', 'client'=>$ashop, 'ins'=>$ins, 'heads'=>$heads]);
    }

    public function editTrans(Request $request) {
        //Validasi input
        $this->validate($request, [
                'product_type' => '',
                'product_name' => '',
                'nominal' => 'integer'
            ]);
        $ashop = AshopTransaction::where('transaction_id',$request->user_id)->first();
        //Inisialisasi array error
        $err = [];

        try {
            $ashop->product_type = $request->product_type;
            $ashop->product_name = $request->product_name;
            $ashop->nominal = $request->nominal;

            $ashop->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }

        if(!empty($err)) {
            return redirect()->back()->withErrors($err);
        } else {
            return redirect()->route('AShop.detail', ['id' => $ashop->master_id]);
        }
    }

     public function deleteTrans($id) {
        //Menghapus client dengan ID tertentu
        try {
            $ashop = AshopTransaction::find($id);
            $ashop->delete();
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        return back();
    }

    public function addTrans(Request $request) {
        $this->validate($request, [
                'product_type' => '',
                'nama_product' => '',
                'nominal' => 'integer'
            ]);

        $ashop = new \App\AshopTransaction();

        $err = [];

        $ashop->master_id = $request->user_id;
        $ashop->product_type = $request->product_type;
        $ashop->product_name = $request->nama_product;
        $ashop->nominal = $request->nominal;

        $ashop->save();
        
        return redirect()->back()->withErrors($err);
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

    public function getTransactions($id) {
        $ashop_transactions = AshopTransaction::where('master_id', $id)->first();
        dd($ashop_transactions);
    }

    public function ashopDetail($id) {
        $master = MasterClient::find($id);
        $ashop = AshopTransaction::where('master_id', $id)->first();

        //judul + sql
        $ins= ["User ID" => "user_id",
                "Nomor Induk" => "nomor_induk",
                "Batch" => "batch",
                "Sales" => "sales_name",
                ];
        $heads = $ins;

        //form transaction
        $insreg = ["Transaction ID",
                    "Product Type",
                    "Product Name",
                    "Nominal"
                    ];

        //transaction
        $headsreg = [ "Transaction ID" => 'transation_id',
                        "Product Type" => "product_type",
                        "Product Name" => 'product_name',
                        "Nominal" => 'nominal'
                    ];

        return view('profile/profile', ['route'=>'AShop', 'client'=>$ashop, 'heads'=>$heads, 'ins'=>$ins, 'insreg'=>$insreg, 'headsreg'=>$headsreg]);
    }

    public function addClient(Request $request) {
        $this->validate($request, [
            'redclub_user_id' => '',
            'name' => '',
            'telephone_number' => '',
            'email' => 'required|email',
            'birthdate' => 'date',
            'address' => '',
            'city' => '',
            'province' => '',
            'gender' => '',
            'line_id' => '',
            'bbm' => '',
            'whatsapp' => '',
            'facebook' => '',
            'product_type' => '',
            'product_name' => '',
            'nominal' => 'integer'
            ]);

        $err = [];

        try {
            $master = new \App\MasterClient;

            $master->redclub_user_id = $request->user_id_redclub;
            $master->redclub_password = $request->password_redclub;
            $master->name = $request->nama;
            $master->telephone_number = $request->telepon;
            $master->email = $request->email;
            $master->birthdate = $request->tanggal_lahir;
            $master->address = $request->alamat;
            $master->city = $request->kota;
            $master->province = $request->provinsi;
            $master->gender = $request->gender;
            $master->line_id = $request->line_id;
            $master->bbm = $request->bbm;
            $master->whatsapp = $request->whatsapp;
            $master->facebook = $request->facebook;

            $master->save();
            
            $trans = new \App\AshopTransaction;

            $trans->master_id =  $master->master_id;
            $trans->product_type = $request->product_type;
            $trans->product_name = $request->product_name;
            $trans->nominal = $request->nominal;

            $trans->save();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect()->back()->withErrors($err);
    }

    public function updateTrans($id)
    {
        $ashop = AshopTransaction::where('transaction_id', $id)->first();

        $ins = ["Product Type" => "product_type",
                "Nama Product" => "product_name",
                "Nominal" => "nominal"];
        //dd($aclub_transaction);

        return view('content/ashoptranseditform', ['route'=>'AShop', 'client'=>$ashop, 'ins'=>$ins]);
    }

    public function exportExcel() {
        $data = AshopTransaction::all();

        foreach ($data as $dat) {
            $master = $dat->master->first();

            $dat->redclub_user_id = $master->redclub_user_id;
            $dat->redclub_password = $master->redclub_password;
            $dat->name = $master->name;
            $dat->telephone_number = $master->telephone_number;
            $dat->email = $master->email;
            $dat->birthdate = $master->birthdate;
            $dat->address = $master->address;
            $dat->city = $master->city;
            $dat->province = $master->province;
            $dat->gender = $master->gender;
            $dat->line_id = $master->line_id;
            $dat->bbm = $master->bbm;
            $dat->whatsapp = $master->whatsapp;
            $dat->facebook = $master->facebook;
        }

        $array = [];
        $heads = [
                "Transaction ID" => "transaction_id",
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
                "Product Type" => "product_type",
                "Product Name" => "product_name",
                "Nominal" => "nominal",
                "Created At" => "created_at",
                "Updated At" => "updated_at"
                    ];
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
        return Excel::create('ExportedAShop', function($excel) use ($array) {
            $excel->sheet('Sheet1', function($sheet) use ($array)
            {
                $sheet->fromArray($array);
            });
        })->export('xls');
    }
}