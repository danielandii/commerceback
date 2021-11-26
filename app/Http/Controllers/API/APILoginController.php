<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APILoginController extends Controller
{
    public function __construct()
    {
    	//
    }

    public function index()
    {
    	return view("login");
    }

    public function login(Request $request){
	    $this->validate($request, [
	        'username' => 'required',
	        'password' => 'required',
	        ]);
	    if (\Auth::attempt([
	        'username' => $request->username,
	        'password' => $request->password])
	    ){
	    	return redirect('/toko');
	        
	    }
	    return redirect('/login')->with('error', 'Invalid Email address or Password');
	}
	/* GET
	*/
	public function logout(Request $request)
	{
	    if(\Auth::check())
	    {
	        \Auth::logout();
	        $request->session()->invalidate();
	    }
	    return  redirect('/login');
	}

    public function toko()
    {
        return view("index");
    }
}
