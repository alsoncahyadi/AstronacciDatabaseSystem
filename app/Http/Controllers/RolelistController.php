<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RolelistController extends Controller
{
    public function index()
    {
    	$users = User::all();
        return view('listuser', compact('users'));
    }

	public function postAssignRoles(Request $request)
	{
		if (isset($request['assbut'])) {
			for ($idx = 0;$idx < $request['numusers'];$idx++){
				if ($request['ischanged'.$idx]){
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
		}
		else if (isset($request['delbut'])) {
			$del = User::where('username', $request['username'.$request['delbut']])->first();
			$del->delete();
		}
		return redirect()->back();
	}
}
