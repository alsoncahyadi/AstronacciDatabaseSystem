<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use App\GreenProspectClient;
use App\GreenProspectProgress;
use DB;

class GreenController extends Controller
{
    
    private function nullify($string)
    {
        $newstring = trim($string);
        if ($newstring === ''){
           return null;
        }
        return $newstring;
    }

    // public function getTable() {
    //     $clients = GreenProspectClient::paginate(15);

    //     $heads = ["Green ID",
    //                 "Name",
    //                 "Date",
    //                 "Phone",
    //                 "Email",
    //                 "Interest",
    //                 "Pemberi",
    //                 "Sumber Data",
    //                 "Keterangan Perintah"];

    //     $ins = ["Name",
    //                 "Date",
    //                 "Phone",
    //                 "Email",
    //                 "Interest",
    //                 "Pemberi",
    //                 "Sumber Data",
    //                 "Keterangan Perintah"];

    //     $atts = ["green_id",
    //                 "name",
    //                 "date",
    //                 "phone",
    //                 "email",
    //                 "interest",
    //                 "pemberi",
    //                 "sumber_data",
    //                 "keterangan_perintah"];

    //     return view('content/table', ['route' => 'green', 'clients' => $clients, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins]);
    // }

    public function getData()
    {
        $greens = GreenProspectClient::all();

        foreach ($greens as $green) {
            $progress = $green->progresses()->orderBy('created_at','desc')->first();
            $green->status = $progress->status;
            $green->sales_name = $progress->sales_name;
            $green->nama_product = $progress->nama_product;
        }

        return $greens;
    }

    public function getTable(Request $request) {
        $page = 0;
        $page = $request['page']-1;
        $record_amount = 15;

        $greens = $this->getData();
        $record_count = count($greens);
        $greens = $greens->forPage(1, $record_amount);

        $page_count = ceil($record_count/$record_amount);

        $headsMaster = [
                    "User ID",
                    "Nama",
                    "Email",
                    "Telepon",
                    "Interest"
                ];

        $attsMaster = [
                        "green_id",
                        "name",
                        "email",
                        "phone",
                        "interest"
                    ];

        //Judul kolom yang ditampilkan pada tabel
        $heads = [
                "Pemberi" => "pemberi",
                "Perintah" => "keterangan_perintah",
                "Status" => "status",
                "Sales" => "sales_name",
                "Nama Product" => "nama_product"
                ];
        

        //Nama attribute pada sql
        $atts = [
                "pemberi",
                "keterangan_perintah",
                "status",
                "sales_name",
                "nama_product",
                ];

        //Filter
        $filter_sales = DB::table('green_prospect_progresses')->select('sales_name')->distinct()->get();
        $filter_product = DB::table('green_prospect_progresses')->select('nama_product')->distinct()->get();
        $filter_status = DB::table('green_prospect_progresses')->select('status')->distinct()->get();
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
            "Status" => $filter_status,
            "Sales" => $filter_sales,
            "Nama Product" => $filter_product
            ];

        //sort
        $sortables = [
            "Status" => "status",
            "Sales" => "sales_name",
            "Nama Product" => "nama_product",
            ];

        //Return view table dengan parameter
        return view('vpc/greenview',
                    [
                        'route' => 'Green',
                        'clients' => $greens,
                        'heads'=>$heads, 'atts'=>$atts,
                        'headsMaster' => $headsMaster,
                        'attsMaster' => $attsMaster,
                        'filter_sales' => $filter_sales,
                        'filter_status' => $filter_status,
                        'filter_product' => $filter_product,
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

        $headsMaster = [
                    "User ID",
                    "Nama",
                    "Email",
                    "Telepon",
                    "Interest"
                ];

        $attsMaster = [
                        "green_id",
                        "name",
                        "email",
                        "phone",
                        "interest"
                    ];
        $heads = [
                "Pemberi" => "pemberi",
                "Perintah" => "keterangan_perintah",
                "Status" => "status",
                "Sales" => "sales_name",
                "Nama Product" => "nama_product"
                ];
        

        //Nama attribute pada sql
        $atts = [
                "pemberi",
                "keterangan_perintah",
                "status",
                "sales_name",
                "nama_product",
                ];


        $json_filter = $request['filters'];
        $json_sort = $request['sorts'];
        $page = 0;
        $page = $request['page']-1;
        $record_amount = 15;


        // add 'select' of query
        $query = "";
        $query = $query."SELECT * ";
        $query = $query."FROM green_prospect_clients ";
        $query = $query."INNER JOIN (SELECT  ";
        $query = $query."            progress_id, T1.green_id as green_id, date, sales_name,  ";
        $query = $query."            status, nama_product, nominal, keterangan, created_at, updated_at ";
        $query = $query."            FROM  ";
        $query = $query."                ( SELECT green_id, max(created_by) as created_by  ";
        $query = $query."                    FROM green_prospect_progresses  ";
        $query = $query."                    GROUP BY green_id) as T1  ";
        $query = $query."            INNER JOIN  ";
        $query = $query."                ( SELECT * ";
        $query = $query."                   FROM green_prospect_progresses) as T2  ";
        $query = $query."                    ON T1.green_id = T2.green_id  ";
        $query = $query."                    AND T1.created_by = T2.created_by) as last_transaction  ";
        $query = $query."ON green_prospect_clients.green_id = last_transaction.green_id";

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

        return view('vpc/greentable',
                    [
                        'route' => 'Green',
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
        //Select seluruh data client $id yang ditampilkan di detail
        $green = GreenProspectClient::where('green_id', $id)->first();

        $ins= ["Green ID"               => "green_id",
                "Date"                  => "date",
                "Name"                  => "name",
                "Phone"                 => "phone",
                "Email"                 => "email",
                "Interest"              => "interest",
                "Pemberi"               => "pemberi",
                "Sumber Data"           => "sumber_data",
                "Keterangan Perintah"   => "keterangan_perintah"];

        $heads = $ins;

        $clientsreg = $green->progresses()->get();

        // form progress
        $insreg = ["Date", "Sales", "Status", "Nama Product", "Nominal", "Keterangan"];
        
        // kolom account
        $headsreg = ["Date", "Sales", "Status", "Nama Product", "Nominal", "Keterangan"];

        //attribute sql account
        $attsreg = ["date", "sales_name", "status", "nama_product", "nominal", "keterangan"];

        return view('profile/profile', ['route'=>'Green', 'client'=>$green, 'heads'=>$heads, 'ins'=>$ins, 'insreg'=>$insreg, 'clientsreg'=>$clientsreg, 'headsreg'=>$headsreg, 'attsreg'=>$attsreg]);
    }

     public function clientTrans($id,$trans) {
        //Select seluruh data client $id yang ditampilkan di detail
        $progress = GreenProspectProgress::where('progress_id', $trans)->first();

        $ins= [     "Progress ID" => "progress_id",
                    "Green ID" => "green_id",
                    "Date" => "date",
                    "Sales Name" => "sales_name",
                    "Status" => "status",
                    "Nama Product" => "nama_product",
                    "Nominal" => "nominal",
                    "Keterangan" => "keterangan",];

        $heads = $ins;

        return view('profile/greentransaction', ['route'=>'Green', 'client'=>$progress, 'heads'=>$heads, 'ins'=>$ins]);
    }

    public function editClient(Request $request) {
        //Validasi input

        $this->validate($request, [
                'green_id' => 'required',
                'date' => 'date'
            ]);
        //Inisialisasi array error

        $err = [];
        try {
            $green = GreenProspectClient::where('green_id',$request->green_id)->first();

            $err =[];
            // dd($request);
            $green->date = $request->date;
            $green->name = $request->name;
            $green->phone = $request->phone;
            $green->email = $request->email;
            $green->interest = $request->interest;
            $green->pemberi = $request->pemberi;
            $green->sumber_data = $request->sumber_data;
            $green->keterangan_perintah = $request->keterangan_perintah;
            // dd($green);
            $green->update();


        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        
        return redirect()->back()->withErrors($err);
    }

    public function addClient(Request $request) {
        //Validasi input
        $this->validate($request, [
                'date' => 'date',
                'name' => '',
                'phone' => '',
                'email' => 'required|email',
                'interest' => '',
                'pemberi' => '',
                'sumber_data' => '',
                'keterangan_perintah' => ''
            ]);
        //Inisialisasi array error
        $err = [];

        $err = [];
        $green = new \App\GreenProspectClient();

        $green->date = $request->date;
        $green->name = $request->name;
        $green->phone = $request->phone;
        $green->email = $request->email;
        $green->interest = $request->interest;
        $green->pemberi = $request->pemberi;
        $green->sumber_data = $request->sumber_data;
        $green->keterangan_perintah = $request->keterangan_perintah;

        $green->save();
        return redirect()->back()->withErrors($err);
    }

    public function editTrans(Request $request) {
        //Validasi input

        $this->validate($request, [
            "date" => 'date', 
            "sales_name" => '', 
            "status" => '', 
            "nama_product" => '', 
            "nominal" => 'integer', 
            "keterangan" => '', 
            ]);
        //Inisialisasi array error

        $progress = GreenProspectProgress::where('progress_id',$request->user_id)->first();
        $err = [];
        try {
            // dd($request);
            $progress->date = $request->date;
            $progress->sales_name = $request->sales_name;
            $progress->status = $request->status;
            $progress->nama_product = $request->nama_product;
            $progress->nominal = $request->nominal;
            $progress->keterangan = $request->keterangan;
            // dd($green);
            $progress->update();


        } catch(\Illuminate\Database\QueryException $ex){
            $err[] = $ex->getMessage();
        }
        
        if(!empty($err)) {
            return redirect()->back()->withErrors($err);
        } else {
            return redirect()->route('Green.detail', ['id' => $progress->green_id]);
        }
    }

    public function deleteClient($id) {
        //Menghapus client dengan ID tertentu
        try {
            $green = GreenProspectClient::where('green_id',$id)->first();
            $green->delete();
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        return redirect("Green");
    }
    
    public function deleteTrans($id) {
        //Menghapus client dengan ID tertentu
        try {
            $green = GreenProspectProgress::where('progress_id',$id)->first();
            $green->delete();
        } catch(\Illuminate\Database\QueryException $ex){ 
            $err[] = $ex->getMessage();
        }
        return back();
    }

    public function addTrans(Request $request) {
        $this->validate($request, [
                "user_id" => 'required',
                "date" => 'date', 
                "sales_name" => '', 
                "status" => '', 
                "nama_product" => '', 
                "nominal" => 'integer', 
                "keterangan" => ''
            ]);

        $err = [];
        $progress = new \App\GreenProspectProgress();
        $progress->green_id = $request->user_id;
        $progress->date = $request->date;
        $progress->sales_name = $request->sales;
        $progress->status = $request->status;
        $progress->nama_product = $request->nama_product;
        $progress->nominal = $request->nominal;
        $progress->keterangan = $request->keterangan;
        $progress->save();
        
        return redirect()->back()->withErrors($err);
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
                    if (($value->nama) === null) {
                        $msg = "Nama empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->no_hp) === null) {
                        $msg = "No HP empty on line ".$i;
                        $err[] = $msg;
                    }
                } //end validasi

                //Jika tidak ada error, import dengan cara insert satu per satu
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        //Mengubah yes atau no menjadi boolean
                        $aclub = strtolower($value->share_to_aclub) == "yes" ? 1 : 0;
                        $mrg = strtolower($value->share_to_mrg) == "yes" ? 1 : 0;
                        $cat = strtolower($value->share_to_cat) == "yes" ? 1 : 0;
                        $uob = strtolower($value->share_to_uob) == "yes" ? 1 : 0;
                        try { 
                            DB::select("call input_green(?,?,?,?,?,?,?,?,?,?)", [$value->nama, $value->no_hp, $value->keterangan_perintah, $value->sumber, $value->progress, $value->sales, $aclub, $mrg, $cat, $uob]);
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
	
	public function assignClient (Request $request) {
		if (isset($request['assbut'])){
			$err = [];
			for ($idx = 0;$idx < $request['numusers'];$idx++){
				if ($request['assigned'.$idx]){
					try {
						DB::select("call input_assign_green(?,?,?,?,?)", [$request['id'.$idx], $request['assign'], $request['prospect'], $request['username'], 'to be added']);
					} catch(\Illuminate\Database\QueryException $ex){
						echo ($ex->getMessage()); 
						$err[] = $ex->getMessage();
					}
					DB::commit();
				}
			}
			return redirect()->back()->withErrors([$err]);
		}
	}

    public function updateTrans($id)
    {
        $progress = GreenProspectProgress::where('progress_id', $id)->first();

        $ins= [     "Date" => "date",
                    "Sales Name" => "sales_name",
                    "Status" => "status",
                    "Nama Product" => "nama_product",
                    "Nominal" => "nominal",
                    "Keterangan" => "keterangan",];

        return view('content/greentranseditform', ['route'=>'Green', 'client'=>$progress, 'ins'=>$ins]);
    }

    public function exportExcel() {
        $data = GreenProspectProgress::all();

        foreach ($data as $dat) {
            $client = $dat->client->first();

            $dat->green_id = $client->green_id;
            $dat->date = $client->date;
            $dat->name = $client->name;
            $dat->phone = $client->phone;
            $dat->email = $client->email;
            $dat->interest = $client->interest;
            $dat->pemberi = $client->pemberi;
            $dat->sumber_data = $client->sumber_data;
            $dat->keterangan_perintah = $client->keterangan_perintah;
        }

        $array = [];
        $heads = [
                "Progress ID" => "progress_id",
                "Green ID" => "green_id",
                "Date" => "date",
                "Name" => "name",
                "Phone" => "phone",
                "Email" => "email",
                "Interest" => "interest",
                "Pemberi" => "pemberi",
                "Sumber Data" => "sumber_data",
                "Keterangan Perintah" => "keterangan_perintah",
                "Sales Name" => "sales_name",
                "Status" => "status",
                "Nama Product" => "nama_product",
                "Nominal" => "nominal",
                "Keterangan" => "keterangan",
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
        return Excel::create('ExportedGreen', function($excel) use ($array) {
            $excel->sheet('Sheet1', function($sheet) use ($array)
            {
                $sheet->fromArray($array);
            });
        })->export('xls');
    }
}
