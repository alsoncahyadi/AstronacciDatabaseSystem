<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

	/**
	 * Override template register function
	 */
	public function register(Request $request)
	{
		// validate the form 
		$this->validator($request->all())->validate();

		// add the user
		$this->create($request->all());

		// redirect user
		return redirect()->back();
	}
	
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
			'role' => 'required',
			'fullname' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
			'a_shop_auth' => ($data['ashop']=='on' ? 1 : 0),
			'role' => $data['role'],
			'fullname' => $data['fullname'],
			'no_handphone' => $data['phonenum'],
        ]);
    }
}
