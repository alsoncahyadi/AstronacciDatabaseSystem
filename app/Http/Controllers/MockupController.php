<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;
class MockupController extends Controller
{
    public function index()
    {
        $clients = DB::select("select * from master_clients");
        //Data untuk insert
        $ins = ["User ID", "Tanggal Lahir", "Jenis Kelamin", "No HP", "No Telepon", "Alamat", "Kota", "Provinsi", "Email", "Line ID", "Pin BB", "Facebook", "Twitter"];
        //ACLUB exclusive form
        $aclubforms = ["Aclub Personalized Form1", "Aclub Personalized Form2", "Aclub Personalized Form3"];
        //UOB exclusive form
        $uobforms = ["UOB Personalized Form 1", "UOB Personalized Form 2"];
        //MRG exclusive form
        $mrgforms = ["MRG Personalized Form 1", "MRG Personalized Form 2", "MRG Personalized Form 3"];
        //CAT exclusive form
        $catforms = ["User ID", "Nomor Induk", "Batch", "Sales", "Sumber Data", "Tanggal DP", "Nominal DP", "Tanggal Payment", "Nominal Payment", "Tanggal Opening Class", "Tanggal End Class", "Tanggal Ujian", "Status", "Keterangan"];
        //Judul kolom yang ditampilkan pada tabel
       $heads = ["PC ID", "User ID", "Nama", "Email", "No HP", "Tanggal Lahir", "Line ID", "BB Pin", "Twitter", "Alamat", "Kota", "Status", "Gender", "Telepon", "Provinsi", "Facebook", "Interest", "Trading_Experience_Year", "Stock_&_Broker", "Annual Income", "Security Question", "Security Answer", "Status", "Keterangan", "Website", "State", "Occupation", "Tanggal Ditambahkan"];//kecuali is"an dan add_time
        //Nama attribute pada sql
        $atts = ["all_pc_id", "user_id", "fullname", "email", "no_hp", "birthdate", "line_id", "bb_pin", "twitter", "address", "city", "marital_status", "jenis_kelamin", "no_telp", "provinsi", "facebook", "interest_and_hobby", "trading_experience_year", "your_stock_future_broker", "annual_income", "security_question", "security_answer", "status", "keterangan", "website","state", "occupation", "add_time"];
        //Return view table dengan parameter
        return view('content/addclient', 
            ['clients' => $clients, 'heads'=>$heads, 'atts'=>$atts, 
                'ins'=>$ins, 'aclub' => $aclubforms, 'uob' => $uobforms, 
                'mrg' => $mrgforms, 'cat' => $catforms]
            );
    }

     public function addClient(Request $request) {
        //Validasi input
        $this->validate($request, [
            ]);

        if ($request->master == 1){
            if ($request->flag == 'cat') {
                $this->addCAT($request);
            } 
        }
    }

    public function addCAT(Request $request) {
        $cat = new \App\Cat;
        $cat->master_id = $request->master_id;
        $cat->user_id = $request->user_id;
        $cat->nomor_induk = $request->nomor_induk;
        $cat->batch = $request->sales;
        $cat->sumber_data = $request->sumber_data;
        $cat->DP_date = $request->tanggal_dp;
        $cat->DP_nominal = $request->nominal_dp;
        $cat->payment_date = $request->tanggal_payment;
        $cat->payment_nominal = $request->nominal_payment;
        $cat->tanggal_opening_class = $request->tanggal_opening_class;
        $cat->tanggal_end_class = $request->tanggal_end_class;
        $cat->tanggal_ujian = $request->tanggal_ujian;
        $cat->status = $request->status;
        $cat->keterangan = $request->keterangan;

        $cat->save();
    }
}