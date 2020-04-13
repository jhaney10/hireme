<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        
            
       session()->flush();
       $chkrevs=DB::table('reviews')
                    ->count();
       $revs=DB::table('reviews')
                    ->join('users','reviews.idparent','=','users.id')
                    ->select('reviews.*','users.*')
                    ->inRandomOrder()
                    ->limit(3)
                    ->get();
       $avail= DB::table('city')
                            ->join('users', 'city.id', '=', 'users.idcity')
                            ->join('sitters','users.id','=','sitters.iduser')
                            ->join('reviews','sitters.iduser','=','reviews.idsitter')
                            ->select('city.*','users.*','sitters.*', 'reviews.*')
                            ->whereIn('reviews.ratings',[4,5])
                            ->inRandomOrder()
                            ->limit(3)
                            ->get();
       $numavail= DB::table('city')
                            ->join('users', 'city.id', '=', 'users.idcity')
                            ->join('sitters','users.id','=','sitters.iduser')
                            ->join('reviews','sitters.iduser','=','reviews.idsitter')
                            ->select('city.*','users.*','sitters.*', 'reviews.*')
                            ->whereIn('reviews.ratings',[4,5])
                            ->inRandomOrder()
                            ->limit(3)
                            ->count();
        return view('index',['reviews'=>$revs,'cntrev'=>$chkrevs,'avail'=>$avail,'numav'=>$numavail]);
    }
}
