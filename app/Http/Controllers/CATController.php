<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Excel;
use App\Cat;
use App\MasterClient;
use App\Http\QueryModifier;
use App\Http\QueryExceptionMapping;

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

        $fdpdate = DB::table('cats')->select($column)->distinct()->get();
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
            if ($m >= 1) {
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
            ->join('cats', 'cats.master_id', '=', 'master_clients.master_id');

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
            if ($m >= 1){        
                array_push($filter_dpdate, $filter_date[$m-1]);
            }
        }
        return $filter_dpdate;
    }

    public function getTable(Request $request) {
        // $keyword = $request['q'];

        // $aclub_info = AclubInformation::where('sumber_data', 'like', "%{$keyword}%")
        //         ->orWhere('keterangan', 'like', "%{$keyword}%")
        //         ->paginate(15);
        $page = 0;
        $page = $request['page']-1;
        $record_amount = 15;

        // $cats = $this->getData();
        $record_count = CAT::count();
        $cats = CAT::orderBy('created_at', 'desc')->skip($record_amount*$page)->take($record_amount)->get();

        foreach ($cats as $cat) {
            $master = $cat->master;
            $cat->master_id = $master->master_id;
            $cat->name = $master->name;
            $cat->telephone_number = $master->telephone_number;
            $cat->email = $master->email;
            $cat->birthdate = $master->birthdate;
            $cat->address = $master->address;
            $cat->city = $master->city;
            $cat->gender = $master->gender;
            $cat->line_id = $master->line_id;
            $cat->whatsapp = $master->whatsapp;
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
                        "user_id",
                        "name",
                        "email",
                        "telephone_number",
                        "birthdate" //date
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
                "DP Date" => "DP_date", //date
                "Payment Date" => "payment_date", //date
                "Batch" => "batch",
                "Status" => "status",
                "Opening Class" => "tanggal_opening_class", //date
                "End Class" => "tanggal_end_class", //date
                "Ujian" => "tanggal_ujian" //date
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
                "DP_date",
                "payment_date",
                "batch",
                "status",
                "tanggal_opening_class",
                "tanggal_end_class",
                "tanggal_ujian"
                ];

        // //Filter        

        $joined = DB::table('master_clients')
                    ->join('cats', 'cats.master_id', '=', 'master_clients.master_id');

        $filter_cities = $joined->select('city')->distinct()->get();
        $filter_gender = $joined->select('gender')->distinct()->get();
        $filter_sumber = DB::table('cats')->select('sumber_data')->distinct()->get();
        $filter_sales = DB::table('cats')->select('sales_name')->distinct()->get();
        $filter_batch = DB::table('cats')->select('batch')->distinct()->get();
        $filter_status = DB::table('cats')->select('status')->distinct()->get();

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
        
        $filter_dpdate = $this->getFilterDate('DP_date');
        $filter_paydate = $this->getFilterDate('payment_date');
        $filter_opendate = $this->getFilterDate('tanggal_opening_class');
        $filter_closedate = $this->getFilterDate('tanggal_end_class');
        $filter_ujidate = $this->getFilterDate('tanggal_ujian');
        $filter_birthdates = $this->getFilterDateBirth('birthdate');

        $filterable = [
            "Kota" => $filter_cities,
            "Gender" => $filter_gender,
            "Sumber" => $filter_sumber,
            "Sales" => $filter_sales,
            "Batch" => $filter_batch,
            "Status" => $filter_status,
            "Tanggal Lahir" => $filter_birthdates,
            "DP Date" => $filter_dpdate,
            "Payment Date" => $filter_paydate,
            "Opening Class" => $filter_opendate,
            "End Class" => $filter_closedate,
            "Ujian" => $filter_ujidate
            ];

        //sort
        $sortables = [
            "Kota" => "city",
            "Gender" => "gender",
            "Sumber" => "sumber_data",
            "Sales" => "sales_name",
            "Batch" => "batch",
            "Status" => "status",
            "Tanggal Lahir" => "birthdate",
            "DP Date" => "DP_date",
            "Payment Date" => "payment_date",
            "Opening Class" => "tanggal_opening_class",
            "End Class" => "tanggal_end_class",
            "Ujian" => "tanggal_ujian"
            ];

        //Return view table dengan parameter
        return view('vpc/catview',
                    [
                        'route' => 'CAT',
                        'clients' => $cats,
                        'heads'=>$heads, 'atts'=>$atts,
                        'headsMaster' => $headsMaster,
                        'attsMaster' => $attsMaster,
                        'filter_birthdates' => $filter_birthdates,
                        'filter_cities' => $filter_cities,
                        'filter_gender' => $filter_gender,
                        'filter_sumber' => $filter_sumber,
                        'filter_sales' => $filter_sales,
                        'filter_batch' => $filter_batch,
                        'filter_status' => $filter_status,
                        'filter_date' => $filter_date,
                        'filterable' => $filterable,
                        'sortables' => $sortables,
                        'count' => $page_count,                        
                        'filter_birthdates' => $filter_birthdates
                    ]);

        $filterable = [
            "Kota" => $filter_cities,
            "Gender" => $filter_gender,
            "Sumber" => $filter_sumber,
            "Sales" => $filter_sales,
            "Batch" => $filter_batch,
            "Status" => $filter_status,
            "Tanggal Lahir" => $filter_date,
            "DP Date" => $filter_date,
            "Payment Date" => $filter_date,
            "Opening Class" => $filter_date,
            "End Class" => $filter_date,
            "Ujian" => $filter_date
            ];
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
                "DP_date",
                "payment_date",
                "batch",
                "status",
                "tanggal_opening_class",
                "tanggal_end_class",
                "tanggal_ujian"
                ];

        $json_filter = $request['filters'];
        $json_sort = $request['sorts'];
        $page = 0;
        $page = $request['page']-1;
        $record_amount = 15;

        // add 'select' of query
        $query = QueryModifier::queryView('CAT', $json_filter, $json_sort);
        // dd($query);
        $list_old = DB::select(DB::raw($query['text']), $query['variables']);
        
        $record_count = count($list_old);
        $page_count = ceil($record_count/$record_amount);        

        
        $list = collect(array_slice($list_old, $page*$record_amount, $record_amount));  

        return view('vpc/cattable',
                    [
                        'route' => 'CAT',
                        'clients' => $list,
                        'atts' => $atts,
                        'attsMaster' => $attsMaster,
                        'count' => $page_count
                    ]);
        // return $list;
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
        return back();
    }

    public function editClient(Request $request) {
        //Validasi input
        $this->validate($request, [
                'sales_name' => '',
                'batch' => '',
                'sumber_data' => ''
            ]);
        $cat = Cat::where('user_id',$request->user_id)->first();
        //Inisialisasi array error
        $err = [];

        try {
            $cat->user_id = $request->user_id;
            $cat->nomor_induk = $request->nomor_induk;
            $cat->batch = $request->batch;
            $cat->sumber_data = $request->sumber_data;

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

                                $is_cat_has_attributes = False;

                                $cat = new \App\Cat;

                                $cat_attributes = $cat->getAttributesImport();

                                foreach ($cat_attributes as $cat_attribute => $import) {
                                    if ($value->$import != null) {
                                        $cat->$cat_attribute = $value->$import;
                                        $is_cat_has_attributes = True;
                                    } else {
                                        $cat->$cat_attribute = null;
                                    }
                                }

                                if ($is_cat_has_attributes) {
                                    $cat->save();
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
        $data = Cat::all();

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
                "User ID" => "user_id",
                "Nomor Induk" => "nomor_induk",
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
                "Batch" => "batch",
                "Sales" => "sales",
                "Sumber Data" => "sumber_data",
                "DP Date" => "DP_date",
                "DP Nominal" => "DP_nominal",
                "Payment Date" => "payment_date",
                "Payment Nominal" => "payment_nominal",
                "Tanggal Opening Class" => "tanggal_opening_class",
                "Tanggal End Class" => "tanggal_end_class",
                "Tanggal Ujian" => "tanggal_ujian",
                "Status" => "status",
                "Keterangan" => "keterangan"
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
        return Excel::create('ExportedCAT', function($excel) use ($array) {
            $excel->sheet('Sheet1', function($sheet) use ($array)
            {
                $sheet->fromArray($array);
            });
        })->export('xls');
    }

    public function templateExcel() {
        $array = [];
        $heads = ["User ID" => "user_id",
                "Nomor Induk" => "nomor_induk",
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
                "Batch" => "batch",
                "Sales" => "sales",
                "Sumber Data" => "sumber_data",
                "DP Date" => "DP_date",
                "DP Nominal" => "DP_nominal",
                "Payment Date" => "payment_date",
                "Payment Nominal" => "payment_nominal",
                "Tanggal Opening Class" => "tanggal_opening_class",
                "Tanggal End Class" => "tanggal_end_class",
                "Tanggal Ujian" => "tanggal_ujian",
                "Status" => "status",
                "Keterangan" => "keterangan"];

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

        return Excel::create('TemplateCAT', function($excel) use ($array) {
            $excel->sheet('Sheet1', function($sheet) use ($array)
            {
                $sheet->fromArray($array);
            });
        })->export('xls');
    }
}
