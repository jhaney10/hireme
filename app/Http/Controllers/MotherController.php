<?php

namespace App\Http\Controllers;

use DB;
use App\Sitter;
use App\User;
use App\Sittingday;
use App\Iddetail;
use App\Sitterchildgrp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Validator;

class MotherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
        $userid = Auth::user()->id;
        $userfname = Auth::user()->user_fname;
        $userlname = Auth::user()->user_lname;
        $useremail=Auth::user()->email;
        $requests=DB::table('requests')
                    ->where(['idparent'=>$userid])
                    ->exists(); 
        $requests1=DB::table('requests')
                    ->join('sitters', 'requests.idsitter', '=', 'sitters.iduser')
                    ->select('requests.*', 'sitters.*')
                    ->where(['idparent'=>$userid])
                    ->get();
         $details =DB::table('users')
                            ->where('id',$userid)
                            ->get();
        $chkaccepts= DB::table('acceptedjobs')
                    ->where(['idparent'=>$userid,'status'=>'Ongoing'])
                    ->count();
        $accepts=DB::table('acceptedjobs')
                    ->join('bookings','acceptedjobs.idbookings','=','bookings.id')
                    ->join('sitters', 'bookings.idsitter', '=', 'sitters.iduser')
                    ->select('acceptedjobs.*','bookings.*','sitters.*')
                    ->where(['acceptedjobs.idparent'=>$userid,'acceptedjobs.status'=>'Ongoing'])
                    ->get();
        $chkcomplete= DB::table('acceptedjobs')
                    ->where(['idparent'=>$userid,'status'=>'Completed'])
                    ->exists();
        $complete=DB::table('acceptedjobs')
                    ->join('bookings','acceptedjobs.idbookings','=','bookings.id')
                    ->join('sitters', 'bookings.idsitter', '=', 'sitters.iduser')
                    ->join('users','sitters.iduser','=','users.id')
                    ->select('acceptedjobs.*','bookings.*','sitters.*','users.*')
                    ->where(['acceptedjobs.idparent'=>$userid,'acceptedjobs.status'=>'Completed'])
                    ->get();
        $chkrejects= DB::table('rejectedjobs')
                    ->where(['idparent'=>$userid])
                    ->exists();
        $rejects=DB::table('rejectedjobs')
                    ->join('bookings','rejectedjobs.idbookings','=','bookings.id')
                    ->join('sitters', 'bookings.idsitter', '=', 'sitters.iduser')
                    ->join('users','sitters.iduser','=','users.id')
                    ->select('rejectedjobs.*','bookings.*','sitters.*','users.*')
                    ->where(['rejectedjobs.idparent'=>$userid])
                    ->get();
        $favsitters=DB::table('reviews')
                    ->join('sitters','reviews.idsitter','=','sitters.iduser')
                    ->join('users','sitters.iduser','=','users.id')
                    ->whereNotIn('ratings',[1,2,3])
                    ->where(['reviews.idparent'=>$userid])
                    ->get();
        $reviews=DB::table('reviews')
                    ->join('sitters','reviews.idsitter','=','sitters.iduser')
                    ->join('users','sitters.iduser','=','users.id')
                    ->where(['reviews.idparent'=>$userid])
                    ->get();

         return view('parent.parent_dashboard',['details'=>$details,'chkrequest'=>$requests,'request'=>$requests1,'fname'=>$userfname,'lname'=>$userlname,'userid'=>$userid,'chkaccepts'=>$chkaccepts,'accepts'=>$accepts,'chkcomplete'=>$chkcomplete,'complete'=>$complete,'chkrejects'=>$chkrejects,'rejects'=>$rejects,'fave'=>$favsitters,'useremail'=>$useremail,'reviews'=>$reviews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $state = $request->input('state');
        $city= $request->input('city');
        $address=$request->input('address');
        $landmark=$request->input('landmark');
        $phone=$request->input("phone");
        $sittingtype=$request->input("sittingtype");
        $startdate= $request->input('startdate');
        $starttime=$request->input('starttime');
        $hours=$request->input('hours');
        $numchildren=$request->input('numchildren');
        $childgp=$request->input('childgrp');
        $childgrp=isset($childgp)?$childgp:' ';
        $duties=$request->input('adduties');
        // $adduties=isset($duties)?$duties:' ';
        $otherinstruct=$request->input('otherinstruct');
        $idsitter=$request->input('sitterid');
        $idparent=Auth::user()->id;

        $message=[
            'phone.digits' => 'Please enter a valid phone number of 11-digits',
            'phone.required' => 'Please enter a valid phone number of 11-digits',
             'address.required'  => 'Please enter your address',
             'childgrp.required'  => 'Please select the age group of your child/children',
             'startdate.required'=> 'Please enter the sitting date',
             'starttime.required'=> 'Please enter the sitting time',
              
        ];
        $validation = $request->validate([
                        'address' => 'required|string|max:255',
                        'phone'=>'required|digits:11',
                        'starttime'=>'required',
                        'startdate'=>'required',
                        'childgrp'=>'required',
                        ],$message);

        $check =DB::table('mothers')->where('iduser', $idparent)->exists();
        if ($check == true) {
            DB::table('mothers')->update(
                ['iduser' => $idparent, 'num_child' => $numchildren, 'address'=>$address,'idcity'=>$city, 'landmark'=>$landmark]
            );
        }
        else{
             DB::table('mothers')->insert(
                ['iduser' => $idparent, 'num_child' => $numchildren, 'address'=>$address,'idcity'=>$city, 'landmark'=>$landmark]
            );
        }

        $idbooking = DB::table('bookings')->insertGetId(
                ['booking_date' => date("Y-m-d H:i"),'idsitter' => $idsitter,'idparent' => $idparent, 'chore_address'=>$address, 'idcity'=>$city,'state'=>$state, 'phone'=>$phone,'landmark'=>$landmark,'urgency'=>$sittingtype,'chore_date'=>$startdate,'timestart'=>$starttime,'num_hours'=>$hours,'num_child'=>$numchildren,'instructions'=>$otherinstruct,'bookingstatus'=>'Awaiting Sitter Response']
            );
        if ($idbooking) {
             DB::table('requests')->insert(
                ['booking_date' => date("Y-m-d H:i"),'idsitter' => $idsitter,'idparent' => $idparent, 'chore_address'=>$address, 'idcity'=>$city,'state'=>$state, 'phone'=>$phone,'landmark'=>$landmark,'urgency'=>$sittingtype,'chore_date'=>$startdate,'timestart'=>$starttime,'num_hours'=>$hours,'num_child'=>$numchildren,'instructions'=>$otherinstruct,'bookingstatus'=>'Awaiting Sitter Response','idbookings'=>$idbooking]
            );
             if ($duties != "") {
                    foreach ($duties as $key ) {
                    DB::table('chores')->insert(
                    ['idbookings'=>$idbooking,'chore'=>$key
                ]);
                 }
             }
             
             foreach ($childgrp as $key ) {
                DB::table('bkchildgroups')->insert(
                ['idbookings'=>$idbooking,'childgroup'=>$key
            ]);
             }
             DB::table('bookedsitters')->insert(
                ['idbookings'=>$idbooking,'idsitter'=>$idsitter
            ]);

             session()->flash('message','Booking Successfull');
             return redirect()->action('MotherController@index'); 
            
        }
        else{
            session()->flash('message','Booking Not Successfull');
             return back(); 
        }

             
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
