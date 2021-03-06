<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;
use App\AshopTransaction;
use App\MasterClient;
use App\Http\QueryModifier;
use App\Http\QueryExceptionMapping;

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
                    ->join('ashop_transactions', 'ashop_transactions.master_id', '=', 'master_clients.master_id');

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

    public function getData()
    {
        // add 'select' of query
        $query = QueryModifier::queryView('AShop', null, null);
        // dd($query);
        $masters = collect(DB::select(DB::raw($query['text']), $query['variables']));

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

        $joined = DB::table('master_clients')
                    ->join('ashop_transactions', 'ashop_transactions.master_id', '=', 'master_clients.master_id');

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

        $filter_birthdates = $this->getFilterDateBirth('birthdate');

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
        $query = QueryModifier::queryView('AShop', $json_filter, $json_sort);
        // dd($query);
        $list_old = DB::select(DB::raw($query['text']), $query['variables']);

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

    public function clientDetail($id, Request $request) {
        $master = MasterClient::find($id);

        //judul + sql
        $ins= ["Red Club User ID" => ["redclub_user_id",0],
          "Red Club Password" => ["redclub_password",0],
          "Nama" => ["name",1],
          "Telephone" => ["telephone_number",1],
          "Email" => ["email",1],
          "Tanggal Lahir" =>["birthdate",0],
          "Alamat" => ["address",1],
          "Provinsi" => ["province",0],
          "Kota" => ["city",0],
          "Jenis Kelamin" => ["gender",0],
          "Line ID" => ["line_id",0],
          "BBM" => ["bbm",0],
          "WhatsApp" => ["whatsapp",0],
          "Facebook" => ["facebook",0]];

        $heads = ["Master ID" => "master_id",
          "Red Club User ID" => "redclub_user_id",
          "Red Club Password" => "redclub_password",
          "Nama" => "name",
          "Telephone" => "telephone_number",
          "Email" => "email",
          "Tanggal Lahir" =>"birthdate",
          "Alamat" => "address",
          "Provinsi" => "province",
          "Kota" => "city",
          "Jenis Kelamin" => "gender",
          "Line ID" => "line_id",
          "BBM" => "bbm",
          "WhatsApp" => "whatsapp",
          "Facebook" => "facebook"
                ];

        $page = 0;
        $page = $request['page']-1;
        $record_amount = 5;

        $clientsreg_old = $master->ashopTransactions()->orderBy('created_at','desc');
        $total = count($clientsreg_old->get());
        $total = ceil($total / $record_amount);
        $clientsreg = $clientsreg_old->skip($record_amount*$page)->take($record_amount)->get();

        $page = $page + 1;

        if ($page < 1) {
            $page = 1;
        }
        //form transaction
        $insreg = [ "Product Type" => 0,
                    "Nama Product" => 0,
                    "Nominal" => 0
                    ];

        //transaction
        $headsreg = [ "Product Type",
                    "Nama Product",
                    "Nominal"
                    ];

        $attsreg = ["product_type", "product_name", "nominal"];

        // Pilihan Kota
        $city = [];
        $row = 1;
        if (($handle = fopen("kota.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                if (array_key_exists($data[0], $city)) {
                    array_push($city[$data[0]], $data[1]);
                } else {
                    $city[$data[0]] = array($data[1]);
                }
            }
            fclose($handle);
        }

        return view('profile/profile', ['route'=>'AShop', 'client'=>$master, 
            'heads'=>$heads, 'ins'=>$ins, 'insreg'=>$insreg, 
            'headsreg'=>$headsreg, 'clientsreg' => $clientsreg, 
            'attsreg' => $attsreg, 'count' => $total, 'page' => $page, 'city' => $city
        ]);
    }

     public function editClient(Request $request) {

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
        $insreg = ["Transaction ID" => 0,
                    "Product Type" => 0,
                    "Product Name" => 0,
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

    public function importExcel() {
        $err = []; //Inisialisasi array error
        if(Input::hasFile('import_file')){ //Mengecek apakah file diberikan
            $path = Input::file('import_file')->getRealPath(); //Mendapatkan path
            $data = Excel::load($path, function($reader) { //Load excel
            })->get();
            if(!empty($data) && $data->count()){
                $i = 1;

                //Jika tidak ada error, import dengan cara insert satu per satu
                if (empty($err)) {
                    $line = 1;
                    foreach ($data as $key => $value) {
                        $line += 1;
                        try {
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
                                    $master_id = $master->$master_id;
                                }
                            } else {
                                $master_id = $master->master_id;
                            }

                            $value->master_id = $master_id;

                            if (($value->master_id) != null) {
                                $is_ashop_has_attributes = False;
                                $ashop = new \App\AshopTransaction;

                                $ashop_attributes = $ashop->getAttributesImport();

                                foreach ($ashop_attributes as $ashop_attribute => $import) {
                                    if ($value->$import != null) {
                                        $ashop->$ashop_attribute = $value->$import;
                                        $is_ashop_has_attributes = True;
                                    } else {
                                        $ashop->$ashop_attribute = null;
                                    }
                                }

                                if ($is_ashop_has_attributes) {
                                    $ashop->save();
                                }
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
        $data = AshopTransaction::all();

        foreach ($data as $dat) {
            $master = $dat->master;

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
                "Nominal" => "nominal"
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

    public function templateExcel() {
        $array = [];
        $heads = [
                "Transaction ID" => "transaction_id",
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
                "Nominal" => "nominal"
                    ];

        $arr = [];
        foreach ($heads as $head => $value) {
            if ($head == "Master ID") {
                $count_master_id = MasterClient::orderBy('master_id', 'desc')->first();
                if ($count_master_id == null) {
                    $arr[$head] = '1';
                } else {
                    $arr[$head] = $count_master_id->master_id;
                }
            } else if ($head == "Transaction ID") {
                $count_trans_id = AshopTransaction::orderBy('transaction_id', 'desc')->first();
                if ($count_trans_id == null) {
                    $arr[$head] = '1';
                } else {
                    $arr[$head] = $count_trans_id->transaction_id;
                }
            } else {
                $arr[$head] = null;
            }
        }
        $array[] = $arr;

        return Excel::create('TemplateAshop', function($excel) use ($array) {
            $excel->sheet('Sheet1', function($sheet) use ($array)
            {
                $sheet->fromArray($array);
            });
        })->export('xls');
    }
}