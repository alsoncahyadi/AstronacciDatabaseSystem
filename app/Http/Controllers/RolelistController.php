<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RolelistController extends Controller
{
    public function index()
    {
    	$users = User::all();
        return view('content/list', compact('users'));
    }

	public function postAssignRoles(Request $request)
	{		
		for ($idx = 0;$idx < $request['numusers'];$idx++){
			if ($request['isdel'.$idx]){
				$del = User::where('username', $request['username'.$idx])->first();
				$del->delete();
			}
			else if ($request['ischanged'.$idx]){
				$user = User::where('username', $request['username'.$idx])->first();
				if ($request['ashop'.$idx]) {
					$user->a_shop_auth = '1';
				}
				else {
					$user->a_shop_auth = '0';
				}
				$user->role = $request['roles'.$idx];
				$user->save();
			}
		}
		return redirect()->back();
	}
}
