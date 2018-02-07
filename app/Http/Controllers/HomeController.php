<?php

namespace App\Http\Controllers;

use App\MasterClient;
use App\AshopTransaction;
use App\GreenProspectClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $clients = MasterClient::select('name','email','master_id')->get();
        return view('dashboard/dashboard', ['clients' => $clients] );
    }

    public function indexAShop() //JOVIAN
    {
        $clients = AshopTransaction::orderBy('master_id','asc')->groupBy('master_id')->get();

        $heads= [
                "User ID Redclub",
                "Password Redclub",
                "Nama",
                "Telepon",
                "Email",
                "Tanggal Lahir",
                "Alamat",
                "Kota",
                "Provinsi",
                "Gender",
                "Line ID",
                "BBM",
                "WhatsApp",
                "Facebook",
                "Transaction ID",
                "Product Type",
                "Product Name",
                "Nominal"];

        $atts = [
                "redclub_user_id",
                "redclub_password",
                "name",
                "telephone_number",
                "email",
                "birthdate",
                "address",
                "city",
                "province",
                "gender",
                "line_id",
                "bbm",
                "whatsapp",
                "facebook",
                "trasaction_id",
                "product_type",
                "product_name",
                "nominal"];

        return view('dashboard/dashboardashop', ['clients' => $clients, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$heads] );
    }

    public function indexGreen() //JOVIAN
    {
        $clients = GreenProspectClient::select('name', 'email', 'green_id')->get();

        $heads = ["Green ID",
                    "Name",
                    "Date",
                    "Phone",
                    "Email",
                    "Interest",
                    "Pemberi",
                    "Sumber Data",
                    "Keterangan Perintah"];

        $ins = ["Name",
                    "Date",
                    "Phone",
                    "Email",
                    "Interest",
                    "Pemberi",
                    "Sumber Data",
                    "Keterangan Perintah",
                    "Date",
                    "Sales Name",
                    "Status",
                    "Nama Product",
                    "Nominal",
                    "Keterangan"];

        $atts = ["green_id",
                    "name",
                    "date",
                    "phone",
                    "email",
                    "interest",
                    "pemberi",
                    "sumber_data",
                    "keterangan_perintah",
                    "date",
                    "sales_name",
                    "status",
                    "nama_product",
                    "nominal",
                    "keterangan"];

        return view('dashboard/dashboardgreen', ['clients' => $clients, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins] );
    }

    public function home()
    {
        $clients = MasterClient::select('name','email','master_id')->get();
        return view('content/home', ['clients' => $clients] );
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
                    if (($value->user_id_redclub) === null) {
                        $msg = "User ID Redclub empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->password_redclub) === null) {
                        $msg = "Password Redclub empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->nama) === null) {
                        $msg = "Nama empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->telepon) === null) {
                        $msg = "Telepon empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->email) === null) {
                        $msg = "Email empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->tanggal_lahir) === null) {
                        $msg = "Tanggal Lahir empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->alamat) === null) {
                        $msg = "Alamat empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->kota) === null) {
                        $msg = "Kota empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->provinsi) === null) {
                        $msg = "Provinsi empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->gender) === null) {
                        $msg = "Gender empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->line_id) === null) {
                        $msg = "Line ID empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->bbm) === null) {
                        $msg = "BBM empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->whatsapp) === null) {
                        $msg = "Whatsapp empty on line ".$i;
                        $err[] = $msg;
                    }
                    if (($value->facebook) === null) {
                        $msg = "Facebook empty on line ".$i;
                        $err[] = $msg;
                    }
                } //end validasi

                //Jika tidak ada error, import dengan cara insert satu per satu
                if (empty($err)) {
                    foreach ($data as $key => $value) {
                        try {
                            $master = new \App\MasterClient;

                            $master->redclub_user_id = $value->user_id_redclub;
                            $master->redclub_password = $value->password_redclub;
                            $master->name = $value->nama;
                            $master->telephone_number = $value->telepon;
                            $master->email = $value->email;
                            $master->birthdate = $value->tanggal_lahir;
                            $master->address = $value->alamat;
                            $master->city = $value->kota;
                            $master->province = $value->provinsi;
                            $master->gender = $value->gender;
                            $master->line_id = $value->line_id;
                            $master->bbm = $value->bbm;
                            $master->whatsapp = $value->whatsapp;
                            $master->facebook = $value->facebook;

                            $master->save();
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
        $data = MasterClient::all();
        $array = [];
        $heads = [
          "Master ID" => "master_id",
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
        return Excel::create('ExportedMaster', function($excel) use ($array) {
            $excel->sheet('Sheet1', function($sheet) use ($array)
            {
                $sheet->fromArray($array);
            });
        })->export('xls');
    }

    public function masterTable(Request $request){

        $page = 0;
        $page = $request['page']-1;
        $record_amount = 15;

        $record_count = MasterClient::count();
        $record_count = ceil($record_count / $record_amount);

        $clients = MasterClient::select('name','email','master_id')->skip($record_amount*$page)->take($record_amount)->get();
        
        
        foreach ($clients as $client) {
            //CAT
            if ($client->cat()->first()) {
                $client->cat = TRUE;
            } else {
                $client->cat = FALSE;
            }

            //UOB
            if ($client->uob()->first()) {
                $client->uob = TRUE;
            } else {
                $client->uob = FALSE;
            }

            //MRG
            if ($client->mrg()->first()) {
                $client->mrg = TRUE;
            } else {
                $client->mrg = FALSE;
            }

            //ACLUB
            $aclub_info = $client->aclubInformation()->first();
            $client->stock = FALSE;
            $client->future = FALSE;
            if ($client->aclubInformation()->first()) {
                $members = $aclub_info->aclubMembers()->get();
                foreach ($members as $member) {
                    if ((!$client->stock) && ($member->group == "Stock")) {
                        $client->stock = TRUE;
                    } else if ((!$client->future) && ($member->group == "Future")) {
                        $client->future = TRUE;
                    }
                }
            }
        }

        // $example_filter = array('cat' => True);
        $json_filter = $request['filters'];

        if (isset($request['ajax'])) {
            if ($request['ajax']) {
                $clients = $this->filterClients($clients, $json_filter);
                $clients = array_slice($clients, $page*$record_amount, $record_amount);

                $arr_pair = ['clients' => $clients,
                    'count' => $record_count];
                    
                return view('vpc/mastertable', $arr_pair );
            } else {
                $arr_pair = ['clients' => $clients,
                    'count' => $record_count];

                return view('vpc/masterview', $arr_pair );
            }
        } else {
            $arr_pair = ['clients' => $clients,
                    'count' => $record_count];

            return view('vpc/masterview', $arr_pair );
        }
    }

    public function filterClients($clients, $json_filter) {
        $filters = json_decode($json_filter, true);
        $filtered_clients = [];

        foreach ($clients as $client) {
            $passed_filter = True;
            foreach ($filters as $filter => $value) {
                if ($client[$filter] != $value) {
                    $passed_filter = False;
                    $break;
                }
            }
            if ($passed_filter) {
                array_push($filtered_clients, $client);
            }
        }

        return $filtered_clients;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

}
