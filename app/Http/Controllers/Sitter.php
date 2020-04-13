<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Sitter extends Controller
{
    protected function sitterprofile(){
    	 return view('sitter.sitterprofileedit');
    	
    }
    protected function sitterdash(){

    	return view('sitter.sitter_dashboard');
     
    }
    
}
