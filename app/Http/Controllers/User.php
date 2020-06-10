<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{
    public function error(){
    	abort(404);
    }

    public function contact(){
    	return view('contactus');
    }
}
