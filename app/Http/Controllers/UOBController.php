<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;
use App\Uob;
use App\Http\QueryModifier;
use App\Http\QueryExceptionMapping;
use App\MasterClient;

class UOBController extends Controller
{

    private function nullify($string)
    {
        $newstring = trim($string);
        if ($newstring === ''){
           return null;
        }
        return $newstring;
    }

    private function getFilterDate($column)
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

        $fdpdate = DB::table('uobs')->select($column)->distinct()->get();
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
                    ->join('uobs', 'uobs.master_id', '=', 'master_clients.master_id');

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
        $page = $request['page']-1;
        $record_amount = 15;

        // $uobs = $this->getData();
        $record_count = Uob::count();
        $uobs = Uob::orderBy('tanggal_rdi_done','asc')->skip($record_amount*$page)->take($record_amount)->get();

        foreach ($uobs as $uob) {
            $master = $uob->master;
            $uob->master_id = $master->master_id;
            $uob->name = $master->name;
            $uob->telephone_number = $master->telephone_number;
            $uob->email = $master->email;
            $uob->birthdate = $master->birthdate;
            $uob->address = $master->address;
            $uob->city = $master->city;
            $uob->province = $master->province;
            $uob->gender = $master->gender;
            $uob->line_id = $master->line_id;
            $uob->bbm = $master->bbm;
            $uob->whatsapp = $master->whatsapp;
            $uob->facebook = $master->facebook;
        }

        $page_count = ceil($record_count/$record_amount);

        $headsMaster = [
                    "User   ID",
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
                "Kode Client" => "client_id",
                "Status" => "status",
                "Nomor RDI" => "nomor_rdi",
                "Tanggal RDI" => "tanggal_rdi_done",
                "Tanggal Top Up" => "tanggal_top_up",
                "Tanggal Trading" => "tanggal_trading",
                "Bank" => "bank_pribadi",
                "Nomor Rekening" => "nomor_rekening_pribadi",
                "RDI Bank" => "rdi_bank"
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
                "client_id",
                "status",
                "nomor_rdi",
                "tanggal_rdi_done",
                "tanggal_top_up",
                "tanggal_trading",
                "bank_pribadi",
                "nomor_rekening_pribadi",
                "rdi_bank"
                ];

        //Filter        

        $joined = DB::table('master_clients')
                    ->join('uobs', 'uobs.master_id', '=', 'master_clients.master_id');

        $filter_cities = $joined->select('city')->distinct()->get();
        $filter_gender = $joined->select('gender')->distinct()->get();
        $filter_sumber = DB::table('uobs')->select('sumber_data')->distinct()->get();
        $filter_sales = DB::table('uobs')->select('sales_name')->distinct()->get();
        $filter_status = DB::table('uobs')->select('status')->distinct()->get();
        
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

        $filter_rdidate = $this->getFilterDate('tanggal_rdi_done');
        $filter_topdate = $this->getFilterDate('tanggal_top_up');
        $filter_tradedate = $this->getFilterDate('tanggal_trading');        
        $filter_birthdates = $this->getFilterDateBirth('birthdate');

        $filterable = [
            "Kota" => $filter_cities,
            "Gender" => $filter_gender,
            "Sumber" => $filter_sumber,
            "Sales" => $filter_sales,
            "Status" => $filter_status,
            "Tanggal RDI" => $filter_rdidate,
            "Tanggal Top Up" => $filter_topdate,
            "Tanggal Trading" => $filter_tradedate
            ];

        //sort
        $sortables = [
            "Tanggal Lahir" => "birthdate",
            "Kota" => "city",
            "Gender" => "gender",
            "Sumber" => "sumber_data",
            "Sales" => "sales_name",
            "Status" => "status",
            "Tanggal RDI" => "tanggal_rdi_done",
            "Tanggal Top Up" => "tanggal_top_up",
            "Tanggal Trading" => "tanggal_trading"
            ];

        //Return view table dengan parameter
        return view('vpc/uobview',
                    [
                        'route' => 'UOB',
                        'clients' => $uobs,
                        'heads'=>$heads, 'atts'=>$atts,
                        'headsMaster' => $headsMaster,
                        'attsMaster' => $attsMaster,
                        'filter_birthdates' => $filter_birthdates,
                        'filter_cities' => $filter_cities,
                        'filter_gender' => $filter_gender,
                        'filter_sumber' => $filter_sumber,
                        'filter_sales' => $filter_sales,
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
                "client_id",
                "status",
                "nomor_rdi",
                "tanggal_rdi_done",
                "tanggal_top_up",
                "tanggal_trading",
                "bank_pribadi",
                "nomor_rekening_pribadi",
                "rdi_bank"
                ];

        $json_filter = $request['filters'];
        $json_sort = $request['sorts'];
        $page = 0;
        $page = $request['page']-1;
        $record_amount = 15;


        // add 'select' of query
        $query = QueryModifier::queryView('UOB', $json_filter, $json_sort);

        // retrieve result
        $list_old = DB::select(DB::raw($query['text']), $query['variables']);

        $record_count = count($list_old);
        $page_count = ceil($record_count/$record_amount);
        
        $list = collect(array_slice($list_old, $page*$record_amount, $record_amount));

        return view('vpc/uobtable', [
                        'route' => 'UOB',
                        'clients' => $list,
                        'atts' => $atts,
                        'attsMaster' => $attsMaster,
                        'count' => $page_count
                    ]);
        // return $list;
    }

    public function clientDetail($id) {
        $uob = Uob::where('client_id', $id)->first();

        //judul + sql
        $ins= [
                "Kode Client" => "client_id",
                "Master ID" => "master_id",
                "Sales" => "sales_name",
                "Sumber Data" => "sumber_data",
                "Tanggal Join" => "join_date",
                "Nomor KTP" => "nomor_ktp",
                "Expired KTP" => "tanggal_expired_ktp",
                "Nomor NPWP" => "nomor_npwp",
                "Alamat Surat Menyurat" => "alamat_surat",
                "Saudara Tidak Serumah" => "saudara_tidak_serumah",
                "Nama Ibu Kandung" => "nama_ibu_kandung",
            ];

        $heads = $ins;

        //form transaction
        $insreg = ["Bank Pribadi" => ["bank_pribadi", 0],
                        "Nomor Rekening Pribadi" => ["nomor_rekening_pribadi", 0],
                        "Tanggal RDI Done" => ["tanggal_rdi_done", 0],
                        "RDI Bank" => ["rdi_bank", 0],
                        "Nomor RDI" => ["nomor_rdi", 0],
                        "Tanggal Top Up" => ["tanggal_top_up", 0],
                        "Nominal Top Up" => ["nominal_top_up", 0],
                        "Tanggal Trading" => ["tanggal_trading", 0],
                        "Status" => ["status", 0],
                        "Trading Via" => ["trading_via", 0],
                        "Keterangan" => ["keterangan", 0]];

        //judul + sql transaction
        $headsreg = [  "Bank Pribadi" => "bank_pribadi",
                        "Nomor Rekening Pribadi" => "nomor_rekening_pribadi",
                        "Tanggal RDI Done" => 'tanggal_rdi_done',
                        "RDI Bank" => "rdi_bank",
                        "Nomor RDI" => 'nomor_rdi',
                        "Tanggal Top Up" => 'tanggal_top_up',
                        "Nominal Top Up" => 'nominal_top_up',
                        "Tanggal Trading" => 'tanggal_trading',
                        "Status" => 'status',
                        "Trading Via" => 'trading_via',
                        "Keterangan" => 'keterangan',
                    ];

        return view('profile/profile', ['route'=>'UOB', 'client'=>$uob, 'heads' => $heads, 'ins'=>$ins, 'insreg'=>$insreg, 'headsreg'=>$headsreg]);
    }

    public function addTrans(Request $request) {
        $this->validate($request, [
                'bank_pribadi' => '',
                'nomor_rekening_pribadi' => 'string:50',
                'tanggal_rdi_done' => 'date',
                'rdi_bank' => 'string:20',
                'nomor_rdi' => '',
                'tanggal_top_up' => 'date',
                'nominal_top_up' => 'integer',
                'tanggal_trading' => 'date',
                'status' => '',
                'trading_via' => '',
                'keterangan' => ''
            ]);

        $uob = Uob::where('client_id',$request->user_id)->first();

        $err =[];

        $uob->bank_pribadi = $request->bank_pribadi;
        $uob->nomor_rekening_pribadi = $request->nomor_rekening_pribadi;
        $uob->tanggal_rdi_done = $request->tanggal_rdi_done;
        $uob->rdi_bank = $request->rdi_bank;
        $uob->nomor_rdi = $request->nomor_rdi;
        $uob->tanggal_top_up = $request->tanggal_top_up;
        $uob->nominal_top_up = $request->nominal_top_up;
        $uob->tanggal_trading = $request->tanggal_trading;
        $uob->status = $request->status;
        $uob->trading_via = $request->trading_via;
        $uob->keterangan = $request->keterangan;

        $uob->update();

        return redirect()->back()->withErrors($err);
    }

    public function editClient(Request $request) {
        //Validasi input
        $this->validate($request, [
                'client_id' => 'required',
                'sales_uob' => '',
                'sumber_data_uob' => '',
                'tanggal_join_uob' => 'date',
                'nomer_ktp' => 'string:20',
                'expired_ktp' => 'date',
                'nomer_npwp' => 'string:40',
                'alamat_surat' => '',
                'saudara_tidak_serumah' => '',
                'ibu_kandung' => '',
            ]);

        //Inisialisasi array error
        $err = [];
        try {
            $uob = UOB::where('client_id',$request->client_id)->first();

            $err =[];

            $uob->client_id = $request->client_id;
            $uob->sales_name = $request->sales_name;
            $uob->sumber_data = $request->sumber_data;
            $uob->join_date = $request->join_date;
            $uob->nomor_ktp = $request->nomor_ktp;
            $uob->tanggal_expired_ktp = $request->tanggal_expired_ktp;
            $uob->nomor_npwp = $request->nomor_npwp;
            $uob->alamat_surat = $request->alamat_surat;
            $uob->saudara_tidak_serumah = $request->saudara_tidak_serumah;
            $uob->nama_ibu_kandung = $request->nama_ibu_kandung;

            $uob->update();
        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        return redirect()->back()->withErrors($err);
    }

    public function deleteClient($id) {
        //Menghapus client dengan ID tertentu
        try {
            $cat = Uob::find($id);
            $cat->delete();
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
                } //end validasi
                // dd($err);

                //Jika tidak ada error, import dengan cara insert satu per satu
                $line = 1;
                if (empty($err)) {
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
                                    $master_id = $master->master_id;
                                }
                            } else {
                                $master_id = $master->master_id;
                            }

                            $value->master_id = $master_id;

                            if (($value->master_id) != null) {

                                $is_uob_has_attributes = False;

                                $uob = new \App\Uob;

                                $uob_attributes = $uob->getAttributesImport();

                                foreach ($uob_attributes as $uob_attribute => $import) {
                                    if ($value->$import != null) {
                                        $uob->$uob_attribute = $value->$import;                                        
                                        $is_uob_has_attributes = True;
                                    } else {
                                        $uob->$uob_attribute = null;
                                    }
                                }

                                if ($is_uob_has_attributes) {
                                    $uob->save();
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
        $data = UOB::all();

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
          "Kode Client" => "client_id",
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
          "Sales" => "sales_name",
          "Sumber Data" => "sumber_data",
          "Tanggal Join" => "join_date",
          "Nomor KTP" => "nomor_ktp",
          "Expired KTP" => "tanggal_expired_ktp",
          "Nomor NPWP" => "nomor_npwp",
          "Alamat Surat Menyurat" => "alamat_surat",
          "Saudara Tidak Serumah" => "saudara_tidak_serumah",
          "Nama Ibu Kandung" => "nama_ibu_kandung",
          "Bank Pribadi" => "bank_pribadi",
          "Nomor Rekening Pribadi" => "nomor_rekening_pribadi",
          "Tanggal RDI Done" => 'tanggal_rdi_done',
          "RDI Bank" => "rdi_bank",
          "Nomor RDI" => 'nomor_rdi',
          "Tanggal Top Up" => 'tanggal_top_up',
          "Nominal Top Up" => 'nominal_top_up',
          "Tanggal Trading" => 'tanggal_trading',
          "Status" => 'status',
          "Trading Via" => 'trading_via',
          "Keterangan" => 'keterangan'
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
        return Excel::create('ExportedUOB', function($excel) use ($array) {
            $excel->sheet('Sheet1', function($sheet) use ($array)
            {
                $sheet->fromArray($array);
            });
        })->export('xls');
    }

    public function templateExcel() {
        $array = [];
        $heads = [
        "Kode Client" => "client_id",
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
          "Sales" => "sales_name",
          "Sumber Data" => "sumber_data",
          "Tanggal Join" => "join_date",
          "Nomor KTP" => "nomor_ktp",
          "Expired KTP" => "tanggal_expired_ktp",
          "Nomor NPWP" => "nomor_npwp",
          "Alamat Surat Menyurat" => "alamat_surat",
          "Saudara Tidak Serumah" => "saudara_tidak_serumah",
          "Nama Ibu Kandung" => "nama_ibu_kandung",
          "Bank Pribadi" => "bank_pribadi",
          "Nomor Rekening Pribadi" => "nomor_rekening_pribadi",
          "Tanggal RDI Done" => 'tanggal_rdi_done',
          "RDI Bank" => "rdi_bank",
          "Nomor RDI" => 'nomor_rdi',
          "Tanggal Top Up" => 'tanggal_top_up',
          "Nominal Top Up" => 'nominal_top_up',
          "Tanggal Trading" => 'tanggal_trading',
          "Status" => 'status',
          "Trading Via" => 'trading_via',
          "Keterangan" => 'keterangan'];

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

        return Excel::create('TemplateUOB', function($excel) use ($array) {
            $excel->sheet('Sheet1', function($sheet) use ($array)
            {
                $sheet->fromArray($array);
            });
        })->export('xls');
    }
}
