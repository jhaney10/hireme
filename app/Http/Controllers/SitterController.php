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
use Illuminate\Http\Validator;



class SitterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
         $userid = Auth::user()->id;
         $userfname = Auth::user()->user_fname;
         $userlname = Auth::user()->user_lname;
         $city = DB::table('city')->get();
 
         $caregiver =DB::table('users')
                            ->join('sitters', 'users.id', '=', 'sitters.iduser')
                            ->select('users.*', 'sitters.*')
                            ->where('users.id',$userid)
                            ->exists();

            if ($caregiver == true) {
                $iddetails =DB::table('iddetails')
                    ->where(['owner'=>'sitter','user_id'=>$userid])
                    ->get();
                $refid =DB::table('iddetails')
                    ->where(['owner'=>'referee','user_id'=>$userid])
                    ->get();
                $sitdays=DB::table('sittingdays')
                    ->where(['user_id'=>$userid])
                    ->get();
                $childgp=DB::table('sitterchildgrps')
                    ->where(['user_id'=>$userid])
                    ->get();
                $c =DB::table('users')
                            ->join('sitters', 'users.id', '=', 'sitters.iduser')
                            ->select('users.*', 'sitters.*')
                            ->where('users.id',$userid)
                            ->get();
                return view('sitter.sitterprofileedit', ['userid'=>$userid, 'fname'=> $userfname, 'lname'=> $userlname, 'city'=> $city, 'cgiver' => $c, 'sitid'=>$iddetails, 'refid'=>$refid, 'sitday'=>$sitdays, 'cgrp'=>$childgp]);
            }
            else{
                $iddetails =DB::table('iddetails')
                    ->where(['owner'=>'sitter','user_id'=>$userid])
                    ->get();
                $refid =DB::table('iddetails')
                    ->where(['owner'=>'referee','user_id'=>$userid])
                    ->get();
                $sitdays=DB::table('sittingdays')
                    ->where(['user_id'=>$userid])
                    ->get();
                $childgp=DB::table('sitterchildgrps')
                    ->where(['user_id'=>$userid])
                    ->get();
                $c =DB::table('users')
                            ->join('sitters', 'users.id', '=', 'sitters.iduser')
                            ->select('users.*', 'sitters.*')
                            ->where('users.id',$userid)
                            ->get();
                // return view('sitter.sitterprofileedit', ['userid'=>$userid, 'fname'=> $userfname, 'lname'=> $userlname, 'city'=> $city]);
                return view('sitter.sitterprofileedit', ['userid'=>$userid, 'fname'=> $userfname, 'lname'=> $userlname, 'city'=> $city, 'cgiver' => $c, 'sitid'=>$iddetails, 'refid'=>$refid, 'sitday'=>$sitdays, 'cgrp'=>$childgp]);
            }
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->input('userid');
        $gend= $request->input('gender');
        $mydob=$request->input('dob');
        $mari=$request->input('marstatus');
        $edu=$request->input("edu");
        $experience=$request->input("experience");
        $idmeans= $request->input('identify');
        $idnum=$request->input('idnumber');
        $idexpire=$request->input('expdate');
        $myr1=$request->input('rate1');
        $myr3=$request->input('rate3+');
        $myr2=$request->input('rate2');
        $about=$request->input('aboutme');
        $med=$request->input('medic');
        $avail= $request->input('avail');
        $sitdays=$request->input('days');
        $days=isset($sitdays)?$sitdays:'';
        $chigrp=$request->input('childgrp');
        $childgrp=isset($chigrp)?$chigrp:'';
        $reffname=$request->input('reffname');
        $reflname=$request->input('reflname');
        $refphone=$request->input('refphone');
        $refaddy=$request->input('refaddy');
        $refcity=$request->input('idcity');
        $refstate=$request->input('state');
        $refmeans=$request->input('refmeans');
        $refidnum=$request->input('refidnum');
        $refexpire=$request->input('refidexp');
        $profilepic=$request->file('picture');

        if (($myr1 > 500)||($myr2 > 700)||($myr3 > 900)){
            session()->flash('message','Maximum Price Rates Should Not be Exceeded');
            return redirect(url('/sitter/create'));

        }
        elseif ((empty($sitdays)) && (empty($chigrp))) {
                    session()->flash('message','Please select your Sitting Days');
                    return redirect(url('/sitter/create'));
        }
        // elseif (empty($chigrp)) {
        //     session()->flash('message','Please select your childgroup');
        //     return redirect(url('/sitter/create'));
        // }
        elseif (empty($sitdays)) {
                    session()->flash('message','Please select your Sitting Days');
                    return redirect(url('/sitter/create'));
                }
        else{

            $check =DB::table('sitters')->where('iduser', $id)->exists();
            if ($check == true) {

                    if($request->hasFile('profilepic')) {
                        $validation = $request->validate([
                        'profilepic' => 'file|image|mimes:jpeg,png,gif,webp|max:2048'
                        ]);
                        if ($validation) {
                            if ($chigrp != "") {
                                $delete2= DB::table('sitterchildgrps')->where('user_id',$id)->delete();
                                foreach ($childgrp as $cgrp) {
                                    $query3 = Sitterchildgrp::create([
                                        'childgroup'=>$cgrp,
                                        'user_id'=>$id,
                                   ]);
                                }
                            }
                            $this->update($request->all(), $id, $profilepic);

                            $sitter = DB::table('users')
                                    ->join('sitters', 'users.id', '=', 'sitters.iduser')
                                    ->select('users.*', 'sitters.*')
                                    ->where('users.id',$id)
                                    ->get();
                            return redirect()->route('sitter.create',['sitter'=>$sitter]);
                        }
                        else{
                            session()->flash('message','Profile Update Unsuccessful');
                        }
                        
                    }
                    else{
                    if ($chigrp != "") {
                                $delete2= DB::table('sitterchildgrps')->where('user_id',$id)->delete();
                                foreach ($childgrp as $cgrp) {
                                    $query3 = Sitterchildgrp::create([
                                        'childgroup'=>$cgrp,
                                        'user_id'=>$id,
                                   ]);
                                }
                            }
                    $this->update($request->all(), $id, $profilepic);

                    return redirect()->route('sitter.create');
                    }
            }
            else{
               
               $query1= Sitter::create([
                    'iduser'=>$id,
                    'aboutme'=>$about,
                    'gender'=>$gend,
                    'sit_exper'=>$experience,
                    'dob'=>$mydob,
                    'marital_stat'=>$mari,
                    'availability'=>$avail,
                    'rate1'=>$myr1,
                    'rate2'=>$myr2,
                    'rate3'=>$myr3,
                    'highedu'=>$edu,
                    'med_avail'=>$med,
                    'ref_fname'=>$reffname,
                    'ref_lname'=>$reflname,
                    'ref_phone'=>$refphone,
                    'ref_address'=>$refaddy,
                    'ref_city'=>$refcity,
                    'ref_state'=>$refstate,


                ]);
               if ($query1) {
                    foreach ($days as $day ) {
                        $query2 = Sittingday::create([
                            'days'=>$day,
                            'user_id'=>$id,
                       ]);
                    }
                    if ($chigrp != "") {
                       foreach ($childgrp as $cgrp) {
                        $query3 = Sitterchildgrp::create([
                            'childgroup'=>$cgrp,
                            'user_id'=>$id,
                       ]);
                        }
                    }
                    
                    $query4 =Iddetail::create([
                        'owner'=> 'sitter',
                        'means'=> $idmeans,
                        'idnum'=>$idnum,
                        'idexpire'=>$idexpire,
                        'user_id'=>$id,
                    ]);
                    $query4 =Iddetail::create([
                        'owner'=> 'referee',
                        'means'=> $refmeans,
                        'idnum'=>$refidnum,
                        'idexpire'=>$refexpire,
                        'user_id'=>$id,
                    ]);
                    if ($request->hasFile('profilepic')) {
                        $validation = $request->validate([
                        'profilepic' => 'file|image|mimes:jpeg,png,gif,webp|max:2048'
                        ]);
                        if ($validation) {
                             $path=Storage::putFile('',$profilepic);
                                    $update= DB::table('sitters')
                                            ->where('iduser', $userid)
                                            ->update(['photo'=>$path]);
                        }
                        
                    }
                   
               }
                 session()->flash('message','Profile Created Successfully');
                 return redirect(url('/sitter/create'));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sitter  $sitter
     * @return \Illuminate\Http\Response
     */
    public function show(Sitter $sitter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sitter  $sitter
     * @return \Illuminate\Http\Response
     */
    public function edit(Sitter $sitter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sitter  $sitter
     * @return \Illuminate\Http\Response
     */
    public function update(array $data, $userid, $profilepic)
    {   

        
        $id = $data['userid'];
        $gend= $data['gender'];
        $mydob=$data['dob'];
        $mari=$data['marstatus'];
        $edu=$data["edu"];
        $experience=$data["experience"];
        $idmeans= $data['identify'];
        $idnum=$data['idnumber'];
        $idexpire=$data['expdate'];
        $myr1=$data['rate1'];
        $myr3=$data['rate3+'];
        $myr2=$data['rate2'];
        $about=$data['aboutme'];
        $medical=$data['medic'];
        $med=$data['medic'];
        $avail= $data['avail'];
        $sitdays=$data['days'];
        $days=isset($sitdays)?$sitdays:'';
        // $chigrp=$data['childgrp'];
        // $childgrp=isset($chigrp)?$chigrp:'';
        $reffname=$data['reffname'];
        $reflname=$data['reflname'];
        $refphone=$data['refphone'];
        $refaddy=$data['refaddy'];
        $refcity=$data['idcity'];
        $refstate=$data['state'];
        $refmeans=$data['refmeans'];
        $refidnum=$data['refidnum'];
        $refexpire=$data['refidexp'];


        
        if (!empty($profilepic)) {

                        $path=Storage::putFile('',$profilepic);
                        $update= DB::table('sitters')
                ->where('iduser', $userid)
                ->update(['photo'=>$path]);

                // $contents = Storage::disk('public')->get('uploads/'.$profilepic); 
                    }
        $update= DB::table('sitters')
                ->where('iduser', $userid)
                ->update([
                   
                    'aboutme'=>$about,
                    'gender'=>$gend,
                    'sit_exper'=>$experience,
                    'dob'=>$mydob,
                    'marital_stat'=>$mari,
                    'availability'=>$avail,
                    'rate1'=>$myr1,
                    'rate2'=>$myr2,
                    'rate3'=>$myr3,
                    'highedu'=>$edu,
                    'med_avail'=>$med,
                    'ref_fname'=>$reffname,
                    'ref_lname'=>$reflname,
                    'ref_phone'=>$refphone,
                    'ref_address'=>$refaddy,
                    'ref_city'=>$refcity,
                    'ref_state'=>$refstate,


                ]);

            $checkdays =DB::table('sittingdays')->where('user_id', $userid)->exists();
            if ($checkdays == true) {
                $delete1= DB::table('sittingdays')->where('user_id',$userid)->delete();
                if ($delete1) {
                    foreach ($days as $day ) {
                            $query2 = Sittingday::create([
                                'days'=>$day,
                                'user_id'=>$id,
                           ]);
                        }
                }
            }
            else{
                foreach ($days as $day ) {
                        $query2 = Sittingday::create([
                            'days'=>$day,
                            'user_id'=>$id,
                       ]);
                    }
            }
            $checkid1 =DB::table('iddetails')->where(['user_id'=>$userid,'owner'=>'sitter'])->exists();
            if ($checkid1 == true) {
                 Iddetail::where('user_id',$userid)
                    ->where('owner','sitter')
                    ->update(['means'=> $idmeans,
                        'idnum'=>$idnum,
                        'idexpire'=>$idexpire]);
            }
            else{
                Iddetail::create([
                        'owner'=> 'sitter',
                        'means'=> $idmeans,
                        'idnum'=>$idnum,
                        'idexpire'=>$idexpire,
                        'user_id'=>$id,
                    ]);
            }
            $checkid2=DB::table('iddetails')->where(['user_id'=>$userid,'owner'=>'referee'])->exists();
           if ($checkid2 == true) {
               Iddetail::where('user_id',$userid)
                    ->where('owner','referee')
                    ->update(['means'=> $refmeans,
                        'idnum'=>$refidnum,
                        'idexpire'=>$refexpire]);
           }
           else{
                Iddetail::create([
                        'owner'=> 'referee',
                        'means'=> $refmeans,
                        'idnum'=>$refidnum,
                        'idexpire'=>$refexpire,
                        'user_id'=>$id,
                    ]);
           }
            session()->flash('message','Profile Update Successful');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sitter  $sitter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sitter $sitter)
    {
        //
    }
    protected function sitterdash(){

        $userid = Auth::user()->id;
        $userfname = Auth::user()->user_fname;
        $userlname = Auth::user()->user_lname;

        $age = DB::table('sitters')
                ->selectRaw("TIMESTAMPDIFF(YEAR, DATE(dob), current_date) AS age")
                ->where('iduser',$userid)
                ->get();
       
        $c =DB::table('users')
                            ->join('sitters', 'users.id', '=', 'sitters.iduser')
                            ->select('users.*', 'sitters.*')
                            ->where('users.id',$userid)
                            ->get();
        $sitdays=DB::table('sittingdays')
                    ->where(['user_id'=>$userid])
                    ->get();
        $childgp=DB::table('sitterchildgrps')
                    ->where(['user_id'=>$userid])
                    ->get();
        $bookings=DB::table('bookings')
                    ->where(['idsitter'=>$userid])
                    ->get();
        $requests=DB::table('requests')
                    ->where(['idsitter'=>$userid])
                    ->exists();
        $requests1=DB::table('requests')
                    ->where(['idsitter'=>$userid])
                    ->get();
        $chkaccepts=DB::table('acceptedjobs')
                    ->where(['idsitter'=>$userid])
                    ->exists();
        $accepts=DB::table('acceptedjobs')
                    ->join('bookings','acceptedjobs.idbookings','=','bookings.id')
                    ->select('acceptedjobs.*','bookings.*')
                    ->where(['acceptedjobs.idsitter'=>$userid])
                    ->get();
        $chkcompleted=DB::table('acceptedjobs')
                    ->where(['idsitter'=>$userid,'status'=>'Completed'])
                    ->exists();
        $completed=DB::table('acceptedjobs')
                    ->join('bookings','acceptedjobs.idbookings','=','bookings.id')
                    ->join('users','bookings.idparent','=','users.id')
                    ->select('acceptedjobs.*','bookings.*','users.*')
                    ->where(['acceptedjobs.idsitter'=>$userid,'acceptedjobs.status'=>'Completed'])
                    ->get();
        $chkrejects=DB::table('rejectedjobs')
                    ->where(['idsitter'=>$userid])
                    ->exists();
        $rejects=DB::table('rejectedjobs')
                    ->join('bookings','rejectedjobs.idbookings','=','bookings.id')
                    ->select('rejectedjobs.*','bookings.*')
                    ->where(['rejectedjobs.idsitter'=>$userid])
                    ->get();
        $chkrevs=DB::table('reviews')
                    ->where(['idsitter'=>$userid])
                    ->count();
        $revs=DB::table('reviews')
                    ->join('users','reviews.idparent','=','users.id')
                    ->select('reviews.*','users.*')
                    ->where(['reviews.idsitter'=>$userid])
                    ->get();
        $rate = DB::table('reviews')
                ->where(['idsitter'=>$userid])
                ->avg('ratings');        
        
        return view('sitter.sitter_dashboard',['userid'=>$userid,'cgiver' => $c,'sitdays'=>$sitdays,'cgrp'=>$childgp,'fname'=>$userfname,'lname'=>$userlname,'age'=>$age,'bookings'=>$bookings,'requests'=>$requests,'getreq'=>$requests1,'chkaccepts'=>$chkaccepts,'accepts'=>$accepts,'chkrejects'=>$chkrejects,'rejects'=>$rejects,'chkcompleted'=>$chkcompleted,'completed'=>$completed,'chkrevs'=>$chkrevs,'revs'=>$revs,'rate'=>$rate]);
     
    }
    
    public function displaydetails1(Request $request){
        $bookid= $request->bookid;
        $id =$request->id;
        $booking=DB::table('bookings')
                    ->where(['idsitter'=>$id,'id'=>$bookid])
                    ->get();
        foreach ($booking->toArray() as $mybook) {
            $chore = $mybook->chore_address;
            $careid= $mybook->id;
            $date= date("Y-m-d",strtotime($mybook->booking_date));
            $lmark=$mybook->landmark;
            $choredate=$mybook->chore_date;
            $phone=$mybook->phone;
            $time=$mybook->timestart;
            $hours=$mybook->num_hours;
            $child=$mybook->num_child;
            $instruct=$mybook->instructions;
            $idcity=$mybook->idcity;
        }
        $checkchores=DB::table('chores')
                    ->where(['id'=>$bookid])
                    ->exists();
        if ($checkchores == true) {
            $mychores=DB::table('chores')
                    ->where(['idbookings'=>$bookid])
                    ->get();
            $mychore='';
            foreach ($mychores as $key) {
               $mychore=$mychore.$key->chore."<br>";
            }
        }
        else{
            $mychore="";
        }
         $age=DB::table('bkchildgroups')
                    ->where(['idbookings'=>$bookid])
                    ->get();
        
        $a='';
        foreach ($age as $key) {
            $a=$a.$key->childgroup."<br>";
        }
        $out='';
        $out = $out.'<div class="table-responsive">
                        <table class="table table-bordered">';
        $out= $out.'
                                <tr>
                                    <th><label>Booking ID</label></th>
                                    <td>CARE0019'.$careid.'</td>
                                </tr>
                                <tr>
                                    <th><label>Booking Date</label></th>
                                    <td>'.$date.'</td>
                                </tr>
                                <tr>
                                    <th><label>Sitting Date</label></th>
                                    <td>'.$choredate.'</td>
                                </tr>
                                <tr>
                                    <th><label>Start Time</label></th>
                                    <td>'.$time.'</td>
                                </tr>
                                <tr>
                                    <th><label>Duration</label></th>
                                    <td>'.$hours.' Hours</td>
                                </tr>
                                <tr>
                                    <th><label>No of Children</label></th>
                                    <td>'.$child.'</td>
                                </tr>
                                <tr>
                                    <th><label>Age Group of Children</label></th>
                                    <td>'.$a.'</td>
                                </tr>
                                <tr>
                                    <th><label>Extra Chores</label></th>
                                    <td>'.$mychore.'</td>
                                </tr>
                                <tr>
                                    <th><label>Special Instructions</label></th>
                                    <td>'.$instruct.'</td>
                                </tr>
                                </table></div';
        echo $out;
       // return json_encode($booking);
    }
    public function acceptRequest(Request $request){
        $bookid=$request->bookid;
        $sitterid=$request->sitterid;
        $parentid=$request->parentid;

        $update1=DB::table('bookings')
                ->where('id',$bookid)
                ->update(['bookingstatus'=>'Booked']);
        if ($update1) {
            DB::table('bookedsitters')
                ->where('idbookings',$bookid)
                ->update(['sitter_response'=>'Accepted']);
            DB::table('acceptedjobs')
                ->insert(['idbookings'=>$bookid,'idsitter'=>$sitterid,'idparent'=>$parentid,'status'=>'Ongoing']);
           DB::table('requests')->where('idbookings', $bookid)->delete();
           return back();

        }
        else{
            die('Connection error');
        }

        // echo $bookid.$sitterid.$parentid;
    }
    public function rejectRequest(Request $request){
        $bookid=$request->bookid;
        $sitterid=$request->sitterid;
        $parentid=$request->parentid;

        $update1=DB::table('bookings')
                ->where('id',$bookid)
                ->update(['bookingstatus'=>'Cancelled']);
        if ($update1) {
            DB::table('bookedsitters')
                ->where('id',$bookid)
                ->update(['sitter_response'=>'Rejected']);
            DB::table('rejectedjobs')
                ->insert(['idbookings'=>$bookid,'idsitter'=>$sitterid,'idparent'=>$parentid]);
           DB::table('requests')->where('idbookings', $bookid)->delete();
           return back();

        }
        else{
            die('Connection error');
        }

        // echo $bookid.$sitterid.$parentid;
    }
    public function displaycompletedetails(Request $request){
        $bookid= $request->bookid;
        $id =$request->id;
        $booking=DB::table('bookings')
                    ->join('users','bookings.idparent','=','users.id')
                    ->where(['bookings.idsitter'=>$id,'bookings.id'=>$bookid])
                    ->get();
        foreach ($booking->toArray() as $mybook) {
            $chore = $mybook->chore_address;
            $careid= $mybook->id;
            $date= date("Y-m-d",strtotime($mybook->booking_date));
            $lmark=$mybook->landmark;
            $choredate=$mybook->chore_date;
            $phone=$mybook->phone;
            $parent=$mybook->user_fname." ".$mybook->user_lname;
            $time=$mybook->timestart;
            $hours=$mybook->num_hours;
            $child=$mybook->num_child;
            $instruct=$mybook->instructions;
            $idcity=$mybook->idcity;
            $state=$mybook->state;
        }
        $checkchores=DB::table('chores')
                    ->where(['id'=>$bookid])
                    ->exists();
        if ($checkchores == true) {
            $mychores=DB::table('chores')
                    ->where(['idbookings'=>$bookid])
                    ->get();
            $mychore='';
            foreach ($mychores as $key) {
               $mychore=$mychore.$key->chore."<br>";
            }
        }
        else{
            $mychore="";
        }
         $age=DB::table('bkchildgroups')
                    ->where(['idbookings'=>$bookid])
                    ->get();
        
        $a='';
        foreach ($age as $key) {
            $a=$a.$key->childgroup."<br>";
        }
        $out='';
        $out = $out.'<div class="table-responsive">
                        <table class="table table-bordered">';
        $out= $out.'
                                <tr>
                                    <th><label>Booking ID</label></th>
                                    <td>CARE0019'.$careid.'</td>
                                </tr>
                                <tr>
                                    <th><label>Booking Date</label></th>
                                    <td>'.$date.'</td>
                                </tr>
                                <tr>
                                    <th><label>Parent Name</label></th>
                                    <td>'.$parent.'</td>
                                </tr>
                                <tr>
                                    <th><label>Parent Phone Number</label></th>
                                    <td>'.$phone.'</td>
                                </tr>
                                <tr>
                                    <th><label>Address</label></th>
                                    <td>'.$chore.', '.$idcity.', '.$state.'</td>
                                </tr>
                                <tr>
                                    <th><label>Landmark</label></th>
                                    <td>'.$lmark.'</td>
                                </tr>
                                <tr>
                                    <th><label>Sitting Date</label></th>
                                    <td>'.$choredate.'</td>
                                </tr>
                                <tr>
                                    <th><label>Start Time</label></th>
                                    <td>'.$time.'</td>
                                </tr>
                                <tr>
                                    <th><label>Duration</label></th>
                                    <td>'.$hours.' Hours</td>
                                </tr>
                                <tr>
                                    <th><label>No of Children</label></th>
                                    <td>'.$child.'</td>
                                </tr>
                                <tr>
                                    <th><label>Age Group of Children</label></th>
                                    <td>'.$a.'</td>
                                </tr>
                                <tr>
                                    <th><label>Extra Chores</label></th>
                                    <td>'.$mychore.'</td>
                                </tr>
                                <tr>
                                    <th><label>Special Instructions</label></th>
                                    <td>'.$instruct.'</td>
                                </tr>
                                </table></div';
        echo $out;
    }
}
