<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PassController extends Controller
{
    public function getForm() {
		return view('content/change');
	}
	
	public function updatePass(Request $request) {				
				
		$this->validate($request, [
			'password' => 'required|confirmed|min:6',
		]);
		
		$current_password = \Auth::user()->password;
		
		if(Hash::check($request['oldpassword'], $current_password)) {			
			$credentials = $request->only(
				'password', 'password_confirmation'
            );
			$user = \Auth::user();
            $user->password = bcrypt($credentials['password']);
            $user->save();
			return redirect()->back();
		}
		else {
			return redirect()->back()->withErrors(['oldpassword'=>'Password is incorrect']);
		}		
	}
}
