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
		$user = User::where('username', $request['username'])->first();
		if ($request['ashop']) {
			$user->a_shop_auth = '1';
		}
		else {
			$user->a_shop_auth = '0';
		}
		$user->role = $request['roles'];
		$user->save();
		return redirect()->back();
	}
}
