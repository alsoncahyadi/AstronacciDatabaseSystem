<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;

class AssignmentController extends Controller
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

    public function getTable() {
        $assignments = DB::select("SELECT * FROM assign_all");

        //Data untuk insert
        $ins = ["Product ID", "Jumlah", "Total Pembayaran", "Nama Pembeli", "All PC ID", "Sales", "Sale Date"];

        //Judul kolom yang ditampilkan pada tabel
        $heads = ["Type", "Assign ID",  "ID", "Sales Username", "Prospect To", "Assign Time", "Assign Edited Time", "Admin Username", "Keterangan", "Last Edited Time", "Report", "Is Success", "Report Time", "Fullname", "No HP", "Email", "Address", "Share to AClub", "Share to MRG", "Share to CAT", "Share to UOB", "All PC ID", "Green Grow Red Add Time", "Green Grow Red Edited Time"]; //kecuali is" an dan add_time

        //Nama attribute pada sql
        $atts = ["type", "assign_id",  "id", "sales_username", "prospect_to", "assign_time", "assign_edited_time", "admin_username", "keterangan", "last_edited_time", "report", "is_succes", "report_time", "fullname", "no_hp", "email", "address", "share_to_aclub", "share_to_mrg", "share_to_cat", "share_to_uob", "all_pc_id", "green_grow_red_add_time", "green_grow_red_edited_time"];

        return view('content\assignment', ['route' => 'assign', 'clients' => $assignments, 'heads'=>$heads, 'atts'=>$atts, 'ins'=>$ins]);
    }

    public function clientDetailGreen($id) {
        //Select seluruh data client $id yang ditampilkan di detail
        //echo ('masuk');
        $assign = DB::select("SELECT * FROM assign_green WHERE green_assign_id = $id");
        $assign = $assign[0];
        //dd($assign);

        //Nama atribut form yang ditampilkan dan nama pada SQL
        $ins = ["Sales" => "sales_username", "Prospect To" => "prospect_to", "Admin Username" => "admin_username", "Keterangan" => "keterangan"];
        //Untuk input pada database, ditambahkan PC ID yang tidak ada pada form
        $heads = ["Green Assign ID"  => "green_assign_id", "Green ID" => "green_id"] + $ins;

        //Return view profile dengan parameter
        return view('profile\profile', ['route'=>'assigngreen', 'client'=>$assign, 'heads'=>$heads, 'ins'=>$ins]);
    }

    public function clientDetailGrow($id) {
        //Select seluruh data client $id yang ditampilkan di detail
        //echo ('masuk');
        $assign = DB::select("SELECT * FROM assign_grow WHERE grow_assign_id = $id");
        $assign = $assign[0];
        //dd($assign);

        //Nama atribut form yang ditampilkan dan nama pada SQL
        $ins = ["Sales" => "sales_username", "Prospect To" => "prospect_to", "Admin Username" => "admin_username", "Keterangan" => "keterangan"];
        //Untuk input pada database, ditambahkan PC ID yang tidak ada pada form
        $heads = ["Grow Assign ID"  => "grow_assign_id", "Grow ID" => "grow_id"] + $ins;

        //Return view profile dengan parameter
        return view('profile\profile', ['route'=>'assigngrow', 'client'=>$assign, 'heads'=>$heads, 'ins'=>$ins]);
    }

    public function clientDetailRedClub($id) {
        //Select seluruh data client $id yang ditampilkan di detail
        //echo ('masuk');
        $assign = DB::select("SELECT * FROM assign_redclub WHERE redclub_assign_id = $id");
        $assign = $assign[0];
        //dd($assign);

        //Nama atribut form yang ditampilkan dan nama pada SQL
        $ins = ["Sales" => "sales_username", "Prospect To" => "prospect_to", "Admin Username" => "admin_username", "Keterangan" => "keterangan"];
        //Untuk input pada database, ditambahkan PC ID yang tidak ada pada form
        $heads = ["RedClub Assign ID"  => "redclub_assign_id"] + $ins;

        //Return view profile dengan parameter
        return view('profile\profile', ['route'=>'assignredclub', 'client'=>$assign, 'heads'=>$heads, 'ins'=>$ins]);
    }

    public function editClient(Request $request) {
        //Validasi input
        $this->validate($request, [
            ]);
        //Inisialisasi array error
        $err = [];
        DB::beginTransaction();
        try {
            //Untuk parameter yang tidak boleh null, digunakan nullify untuk menjadikan input empty string menjadi null
            //Edit atribut master client
            DB::select("call edit_assign_green(?,?,?,?,?,?)", [$request->all_pc_id, $request->fullname, $this->nullify($request->email), $request->no_hp, $this->nullify($request->birthdate), $this->nullify($request->line_id), $this->nullify($request->bb_pin), $this->nullify($request->twitter), $request->address, $this->nullify($request->city), $this->nullify($request->marital_status), $this->nullify($request->jenis_kelamin), $this->nullify($request->no_telp), $this->nullify($request->provinsi), $this->nullify($request->facebook)]);
            //Edit atribut MRG
            DB::select("call edit_mrg(?,?,?,?,?)", [$request->all_pc_id, $request->account, $this->nullify($request->join_date), $this->nullify($request->type), $this->nullify($request->sales_username)]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            $err[] = $ex->getMessage();
        }
        DB::commit();
        return redirect()->back()->withErrors($err);
    }
}