<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use App\GreenProspectClient;
use App\GreenProspectProgress;
use App\Http\QueryModifier;
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

    public function getTable(Request $request) {
        $page = 0;
        $page = $request['page']-1;
        $record_amount = 15;

        // $greens = $this->getData();
        $record_count = GreenProspectClient::count();
        $greens = GreenProspectClient::orderBy('created_at','desc')->skip($record_amount*$page)->take($record_amount)->get();

        foreach ($greens as $green) {
            $progress = $green->progresses()->orderBy('created_at','desc')->first();
            if ($green->progresses()->orderBy('created_at','desc')->first() != null) {
                $green->status = $progress->status;
                $green->sales_name = $progress->sales_name;
                $green->nama_product = $progress->nama_product;
            } else {
                $green->status = null;
                $green->sales_name = null;
                $green->nama_product = null;
            }
            
        }

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
        $query = QueryModifier::queryView('Green', $json_filter, $json_sort);
        // dd($query);
        $list_old = DB::select(DB::raw($query['text']), $query['variables']);
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
 
    public function clientDetail($id, Request $request) {
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
        
        $page = 0;
        $page = $request['page']-1;
        $record_amount = 5;

        $clientsreg_old = $green->progresses()->orderBy('created_at','desc');
        $total = count($clientsreg_old->get());
        $total = ceil($total / $record_amount);
        $clientsreg = $clientsreg_old->skip($record_amount*$page)->take($record_amount)->get();

        $page = $page + 1;

        if ($page < 1) {
            $page = 1;
        }
        // form progress
        $insreg = ["Date", "Sales", "Status", "Nama Product", "Nominal", "Keterangan"];
        
        // kolom account
        $headsreg = ["Date", "Sales", "Status", "Nama Product", "Nominal", "Keterangan"];

        //attribute sql account
        $attsreg = ["date", "sales_name", "status", "nama_product", "nominal", "keterangan"];

        return view('profile/profile', ['route'=>'Green', 'client'=>$green, 
                'heads'=>$heads, 'ins'=>$ins, 'insreg'=>$insreg, 
                'clientsreg'=>$clientsreg, 'headsreg'=>$headsreg, 
                'attsreg'=>$attsreg, 'count'=>$total, 'page'=>$page
            ]);
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
                'keterangan_perintah' => '',
                'date' => '',
                'sales_name' => '',
                'status' => '',
                'nama_product' => '',
                'nominal' => '',
                'keterangan' => ''
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

        $green_progress = new \App\GreenProspectProgress();

        $green_progress->green_id = $green->green_id;
        $green_progress->date = $request->date;
        $green_progress->sales_name = $request->sales_name;
        $green_progress->status = $request->status;
        $green_progress->nama_product = $request->nama_product;
        $green_progress->nominal = $request->nominal;
        $green_progress->keterangan = $request->keterangan;

        $green_progress->save();

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
        $data = collect([]);

        $clients = GreenProspectClient::all();

        foreach ($clients as $client) {
            $progresses = $client->progresses()->get();

            if ($progresses->first() != null) {
                foreach ($progresses as $progress) {
                    $object = $progress;

                    $object->green_id = $client->green_id;
                    $object->date = $client->date;
                    $object->name = $client->name;
                    $object->phone = $client->phone;
                    $object->email = $client->email;
                    $object->interest = $client->interest;
                    $object->pemberi = $client->pemberi;
                    $object->sumber_data = $client->sumber_data;
                    $object->keterangan_perintah = $client->keterangan_perintah;

                    $data->push($object);
                }
            } else {
                $object = new \stdClass();

                $object->date = $client->date;
                $object->name = $client->name;
                $object->phone = $client->phone;
                $object->email = $client->email;
                $object->interest = $client->interest;
                $object->pemberi = $client->pemberi;
                $object->sumber_data = $client->sumber_data;
                $object->keterangan_perintah = $client->keterangan_perintah;

                $progress = new \App\GreenProspectProgress();
                $progress_attributes = $progress->getAttributesImport();

                foreach ($progress_attributes as $progress_attribute) {
                    $object->$progress_attribute = null;
                }

                $object->progress_id = null;
                $object->green_id = $client->green_id;

                $data->push($object);
            }
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
        return Excel::create('ExportedGreen', function($excel) use ($array) {
            $excel->sheet('Sheet1', function($sheet) use ($array)
            {
                $sheet->fromArray($array);
            });
        })->export('xls');
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
                    // if (($value->master_id) === null) {
                    //     $msg = "Master ID empty on line ".$i;
                    //     $err[] = $msg;
                    // }
                    // if (($value->sumber_data) === null) {
                    //     $msg = "Sumber Data empty on line ".$i;
                    //     $err[] = $msg;
                    // }
                    // if (($value->keterangan) === null) {
                    //     $msg = "Keterangan empty on line ".$i;
                    //     $err[] = $msg;
                    // }
                } //end validasi

                //Jika tidak ada error, import dengan cara insert satu per satu
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        try {
                             // check whether master client exist or not
                            if (GreenProspectClient::find($value->green_id) == null) {
                                $client = new \App\GreenProspectClient;

                                $client_attributes = $client->getAttributesImport();

                                foreach ($client_attributes as $client_attribute => $import) {
                                    $client->$client_attribute = $value->$import;
                                }

                                $client->save();
                            }

                            $progress = new \App\GreenProspectProgress;

                            $progress_attributes = $progress->getAttributesImport();

                                foreach ($progress_attributes as $progress_attribute => $import) {
                                    $progress->$progress_attribute = $value->$import;
                                }

                            $progress->save();
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
}
