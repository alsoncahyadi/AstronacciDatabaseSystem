<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use App\Http\QueryModifier;
use App\Mrg;
use App\MrgAccount;
use App\MasterClient;
use DB;

class MRGController extends Controller
{

    private function nullify($string)
    {
        $newstring = trim($string);
        if ($newstring === ''){
           return null;
        }
        return $newstring;
    }    

    public function getTable(Request $request) {
        // $keyword = $request['q'];

        // $aclub_info = AclubInformation::where('sumber_data', 'like', "%{$keyword}%")
        //         ->orWhere('keterangan', 'like', "%{$keyword}%")
        //         ->paginate(15);
        $page = 0;
        $page = $request['page']-1;
        $record_amount = 15;

        // $mrgs = $this->getData();
        $record_count = MRG::count();
        $mrgs = MRG::orderBy('created_at','desc')->skip($record_amount*$page)->take($record_amount)->get();

        foreach ($mrgs as $mrg) {
            $master = $mrg->master;
            $mrg->master_id = $master->master_id;
            $mrg->name = $master->name;
            $mrg->telephone_number = $master->telephone_number;
            $mrg->email = $master->email;
            $mrg->birthdate = $master->birthdate;
            $mrg->address = $master->address;
            $mrg->city = $master->city;
            $mrg->province = $master->province;
            $mrg->gender = $master->gender;
            $mrg->line_id = $master->line_id;
            $mrg->whatsapp = $master->whatsapp;
            $mrg->facebook = $master->facebook;

            //data from mrg transaction
            if ($mrg->accounts()->orderBy('created_at','desc')->first() != null) {
                $last_transaction = $mrg->accounts()->orderBy('created_at','desc')->first();
                $mrg->sales_name = $last_transaction->sales_name;
                $mrg->accounts_number = $last_transaction->accounts_number;
                $mrg->account_type = $last_transaction->account_type;
            } else {
                $mrg->sales_name = null;
                $mrg->accounts_number = null;
                $mrg->account_type = null;
            }
        }

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
                "Tanggal Join" => "join_date",
                "Account" => "accounts_number",
                "Type" => "account_type",
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
                "join_date",
                "accounts_number",
                "account_type"
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
                    ->join('mrgs', 'mrgs.master_id', '=', 'master_clients.master_id');

        $filter_cities = $joined->select('city')->distinct()->get();
        $filter_gender = $joined->select('gender')->distinct()->get();
        $filter_sumber = DB::table('mrgs')->select('sumber_data')->distinct()->get();
        $filter_sales = DB::table('mrg_accounts')->select('sales_name')->distinct()->get();
        // $filter_accounts = DB::table('mrg_accounts')->select('accounts_number')->distinct()->get();
        $filter_type = DB::table('mrg_accounts')->select('account_type')->distinct()->get();
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
            "Tanggal Join" => $filter_date,
            "Type" => $filter_type
            ];

        //sort
        $sortables = [
            "Kota" => "city",
            "Gender" => "gender",
            "Sumber" => "sumber_data",
            "Sales" => "sales_name",
            "Tanggal Join" => "join_date",
            "Account" => "accounts_number",
            "Type" => "account_type"];

        //Return view table dengan parameter
        return view('vpc/mrgview',
                    [
                        'route' => 'MRG',
                        'clients' => $mrgs,
                        'heads'=>$heads, 'atts'=>$atts,
                        'headsMaster' => $headsMaster,
                        'attsMaster' => $attsMaster,
                        'filter_birthdates' => $filter_birthdates,
                        'filter_cities' => $filter_cities,
                        'filter_gender' => $filter_gender,
                        'filter_sumber' => $filter_sumber,
                        'filter_sales' => $filter_sales,
                        'filter_type' => $filter_type,
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
                "join_date",
                "accounts_number",
                "account_type"
                ];

        $json_filter = $request['filters'];
        $json_sort = $request['sorts'];
        $page = 0;
        $page = $request['page']-1;
        $record_amount = 15;


        // add 'select' of query
        $query = QueryModifier::queryView('MRG', $json_filter, $json_sort);

        // retrieve result
        $list_old = DB::select(DB::raw($query['text']), $query['variables']);

        $record_count = count($list_old);
        $page_count = ceil($record_count/$record_amount);
        
        $list = collect(array_slice($list_old, $page*$record_amount, $record_amount));

        return view('vpc/mrgtable',
                    [
                        'route' => 'MRG',
                        'clients' => $list,
                        'atts' => $atts,
                        'attsMaster' => $attsMaster,
                        'count' => $page_count
                    ]);
        // return $list;
    }

    public function clientDetail($id, Request $request) {
        $mrg = MRG::where('master_id', $id)->first();

        $ins= ["Sumber Data (MRG)" => "sumber_data",
                "Join Date (MRG)" => "join_date",
                "Sales" => "sales_name"];

        $heads = $ins;

        // form transaction
        $insreg = ["Account Number", "Account Type", "Sales Name"];

        $keyword = $request['q'];

        $page = 0;
        $page = $request['page']-1;
        $record_amount = 5;

        $query = QueryModifier::queryMRGClientDetailSearch($mrg->master_id, $keyword);

        // dd($query);

        $clientsregold = DB::select($query);

        $total = count($clientsregold);
        $total = ceil($total / $record_amount);

        $clientsreg = collect(array_slice($clientsregold, $page*$record_amount, $record_amount));

        // $clientsregold = $mrg->accounts()
        //             ->where('accounts_number', 'like', "%{$keyword}%");
                    // ->orWhere('account_type', 'like', "%{$keyword}%")
                    // ->orWhere('sales_name', 'like', "%{$keyword}%")
        // $total = count($clientsregold->get());
        // $total = ceil($total / $record_amount);        

        // $clientsreg = $clientsregold->skip($record_amount*$page)->take($record_amount)->get();
        // dd($clientsreg);
        // $clientsreg = $mrg->accounts()->get();        

        //kolom account
        $headsreg = ["Account Number", "Account Type", "Sales Name"];

        //attribute sql account
        $attsreg = ["accounts_number", "account_type", "sales_name"];

        return view('profile/transtable', [
                'route'=>'MRG', 
                'client'=>$mrg, 
                'heads'=>$heads, 
                'ins'=>$ins, 
                'insreg'=>$insreg, 
                'clientsreg'=>$clientsreg, 
                'headsreg'=>$headsreg, 
                'attsreg'=>$attsreg,
                'count'=>$total
            ]);
    }

     public function addTrans(Request $request) {
        $this->validate($request, [
                "user_id" => 'required',
                "accounts_number" => 'required|unique:mrg_accounts|string:20', 
                "account_type" => 'string:20', 
                "sales_name" => ''
            ]);

        $mrg_account = new \App\MrgAccount();

        $err = [];
        $mrg_account->master_id = $request->user_id;
        $mrg_account->accounts_number = $request->accounts_number;
        $mrg_account->account_type = $request->account_type;
        $mrg_account->sales_name = $request->sales_name;

        $mrg_account->save();

        return redirect()->back()->withErrors($err);
    }

    public function deleteClient($id) {
        //Menghapus client dengan ID tertentu
        try {
            $mrg = Mrg::find($id);
            $mrg->delete();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return back();
    }

    public function editClient(Request $request) {
        //Validasi input
        $this->validate($request, [
                'master_id' => 'required',
                'sumber_data' => '',
                'join_date_mrg' => 'date'
            ]);
        //Inisialisasi array error
        $err = [];
        try {
            $mrg = Mrg::where('master_id',$request->master_id)->first();

            $err =[];

            $mrg->sumber_data = $request->sumber_data;
            $mrg->join_date = $request->join_date_mrg;

            $mrg->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect()->back()->withErrors($err);
    }

    public function clientDetailAccount($id, $account) {

        $mrg_account = MrgAccount::where('accounts_number', $account)->first();

        $heads = ["Master ID" => "master_id",
                    "Nomor Account" => "accounts_number",
                    "Type Account" => "account_type",
                    "Sales" => "sales_name"];

        $ins = ["Type Account" => "account_type",
                "Sales" => "sales_name"];

        return view('profile/mrgaccount', ['route'=>'MRG', 'client'=>$mrg_account, 'ins'=>$ins, 'heads'=>$heads]);
    }

     public function editTrans(Request $request) {
        //Validasi input
        $this->validate($request, [
                "accounts_number" => 'required', 
                "account_type" => 'string:20', 
                "sales_name" => ''
            ]);
        $mrg_account = MrgAccount::where('accounts_number',$request->accounts_number)->first();
        //Inisialisasi array error
        $err = [];

        try {
            $mrg_account->account_type = $request->account_type;
            $mrg_account->sales_name = $request->sales_name;

            $mrg_account->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }

        if(!empty($err)) {
            return redirect()->back()->withErrors($err);
        } else {
            return redirect()->route('detail', ['id' => $mrg_account->master_id]);
        }
        
    }

    public function deleteTrans($id) {
        try {
            $mrg_account = MrgAccount::find($id);
            $mrg_account->delete();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return back();
    }

    public function importExcel() {
        $err = []; //Inisialisasi array error
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
                    if (($value->join_date) === null) {
                        $msg = "Tanggal Join empty on line ".$i;
                        $err[] = $msg;
                    }
                } //end validasi

                //Jika tidak ada error, import dengan cara insert satu per satu
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        try {
                             if (MasterClient::find($value->master_id) == null) {
                                $master = new \App\MasterClient;

                                $master_attributes = $master->getAttributesImport();

                                foreach ($master_attributes as $master_attribute => $import) {
                                    $master->$master_attribute = $value->$import;
                                }

                                $master->save();
                            }

                            // check whether aclub information exist or not
                            if (MRG::find($value->master_id) == null) {
                                $mrg = new \App\MRG;

                                $mrg_attributes = $mrg->getAttributesImport();

                                foreach ($mrg_attributes as $mrg_attribute => $import) {
                                    $mrg->$mrg_attribute = $value->$import;
                                }

                                $mrg->save();
                            }

                            $mrg_account = new \App\MrgAccount;

                            $mrg_account_attributes = $mrg_account->getAttributesImport();

                            foreach ($mrg_account_attributes as $mrg_account_attribute => $import) {
                                $mrg_account->$mrg_account_attribute = $value->$import;
                            }

                            $mrg_account->save();
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
        $data = MrgAccount::all();

        foreach ($data as $dat) {
            $mrg = $dat->mrg;

            $dat->sumber_data = $mrg->sumber_data;
            $dat->join_date = $mrg->join_date;

            $master = $mrg->master;

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
                    "Account Number" => "accounts_number",
                    "Account Type" => "account_type",
                    "Sales Name" => "sales_name",
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
                    "Join Date" => "join_date"
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
        return Excel::create('ExportedMRG', function($excel) use ($array) {
            $excel->sheet('Sheet1', function($sheet) use ($array)
            {
                $sheet->fromArray($array);
            });
        })->export('xls');
    }

    public function updateTrans($account) {
        $mrg_account = MrgAccount::where('accounts_number', $account)->first();

        $ins = ["Type Account" => "account_type",
                "Sales" => "sales_name"];

        return view('content/mrgeditform', ['route'=>'MRG', 'client'=>$mrg_account, 'ins'=>$ins]);
    }
}
