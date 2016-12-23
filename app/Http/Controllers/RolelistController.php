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
}
