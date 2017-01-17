<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;


class SalesController extends Controller
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
		$username = \Auth::user()->username;
						
		$assigns = DB::select("call select_assign(?)",[$username]);
		
        //Judul kolom yang ditampilkan pada tabel
        $heads = ["Type", "Assign ID",  "ID", "Sales Username", "Prospect To", "Assign Time", "Assign Edited Time", "Admin Username", "Keterangan", "Last Edited Time", "Report", "Is Success", "Report Time", "Fullname", "No HP", "Email", "Address", "Share to AClub", "Share to MRG", "Share to CAT", "Share to UOB", "All PC ID", "Green Grow Red Add Time", "Green Grow Red Edited Time"]; //kecuali is" an dan add_time

        //Nama attribute pada sql
        $atts = ["type", "assign_id",  "id", "sales_username", "prospect_to", "assign_time", "assign_edited_time", "admin_username", "keterangan", "last_edited_time", "report", "is_succes", "report_time", "fullname", "no_hp", "email", "address", "share_to_aclub", "share_to_mrg", "share_to_cat", "share_to_uob", "all_pc_id", "green_grow_red_add_time", "green_grow_red_edited_time"];
        
		return view('content\sales', ['route' => 'sales', 'user'=>$username , 'clients' => $assigns, 'heads'=>$heads, 'atts'=>$atts]);
    }

	public function reportDetail($type, $id) {		
		return view('content\report', ['type'=>$type, 'id'=>$id]);
	}
	
	public function addGreenReport(Request $request) {
		
		$username = DB::select("SELECT sales_username FROM assign_green WHERE green_assign_id = " . $request['id']);
		
		$err = [];
		
		if(($username[0]->sales_username) == (\Auth::user()->username)){
			$success = ($request['issuccess']=='on' ? 1 : 0);
			try {
				DB::select("call add_report_green(?,?,?)", [$request['id'], $request['report'], $success]);
			} catch(\Illuminate\Database\QueryException $ex){
				echo ($ex->getMessage());
				$err[] = $ex->getMessage();
			}
			DB::commit();
		}
		return redirect()->back()->withErrors([$err]);	
	}
	
	public function addGrowReport(Request $request) {
		
		$username = DB::select("SELECT sales_username FROM assign_grow WHERE grow_assign_id = " . $request['id']);
		
		$err = [];
		
		if(($username[0]->sales_username) == (\Auth::user()->username)){				
			$success = ($request['issuccess']=='on' ? 1 : 0);
			try {
				DB::select("call add_report_grow(?,?,?)", [$request['id'], $request['report'], $success]);
			} catch(\Illuminate\Database\QueryException $ex){
				echo ($ex->getMessage());
				$err[] = $ex->getMessage();
			}
			DB::commit();									
		}
		return redirect()->back()->withErrors([$err]);
	}
	
	public function addRedclubReport(Request $request) {		
	
		$username = DB::select("SELECT sales_username FROM assign_redclub WHERE redclub_assign_id = " . $request['id']);
		
		$err = [];
		
		if(($username[0]->sales_username) == (\Auth::user()->username)){
		$success = ($request['issuccess']=='on' ? 1 : 0);
			try {
				DB::select("call add_report_redclub(?,?,?)", [$request['id'], $request['report'], $success]);
			} catch(\Illuminate\Database\QueryException $ex){
				echo ($ex->getMessage());
				$err[] = $ex->getMessage();
			}
			DB::commit();
		}
		return redirect()->back()->withErrors([$err]);	
	}
}
