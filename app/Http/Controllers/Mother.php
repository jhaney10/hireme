<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
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

class Mother extends Controller
{

    
    public function availablesitters(){
      $avail= DB::table('sitters')
                            ->join('users', 'sitters.iduser', '=', 'users.id')
                            ->join('city', 'users.idcity','=','city.id' )
                            ->select('sitters.*', 'users.*','city.*')
                            ->get();
       $numavail= DB::table('users')
                            ->join('sitters', 'users.id', '=', 'sitters.iduser')
                            ->select('users.*', 'sitters.*')
                            ->count();
        $city = DB::table('city')->get();
       return view('parent.available_sitters',['avail'=>$avail,'numav'=>$numavail,'city'=>$city]);

    }
    public function sittersummary($sitterid){
    	$sitter= DB::table('sitters')
                            ->join('users', 'sitters.iduser', '=', 'users.id')
                            ->join('city', 'users.idcity','=','city.id' )
                            ->select('sitters.*', 'users.*','city.*')
                            ->where('iduser',$sitterid)
                            ->get();
        $age = DB::table('sitters')
                ->selectRaw("TIMESTAMPDIFF(YEAR, DATE(dob), current_date) AS age")
                ->where('iduser',$sitterid)
                ->get();
        $sitdays=DB::table('sittingdays')
                    ->where(['user_id'=>$sitterid])
                    ->get();
        $childgp=DB::table('sitterchildgrps')
                    ->where(['user_id'=>$sitterid])
                    ->get();
        $chkrevs=DB::table('reviews')
                    ->where(['idsitter'=>$sitterid])
                    ->count();
        $revs=DB::table('reviews')
                    ->join('users','reviews.idparent','=','users.id')
                    ->select('reviews.*','users.*')
                    ->where(['reviews.idsitter'=>$sitterid])
                    ->get();
        $rate = DB::table('reviews')
                ->where(['idsitter'=>$sitterid])
                ->avg('ratings');
    	return view('parent.profile_sum',['id'=>$sitterid,'sitter'=>$sitter,'age'=>$age,'sitdays'=>$sitdays,'cgrp'=>$childgp,'chkrevs'=>$chkrevs,'revs'=>$revs,'rate'=>$rate]);
    }
    public function booksitter($sitterid)
    {
    	$city = DB::table('city')->get();
    	return view('parent.bookingform',['id'=>$sitterid,'city'=>$city]);
    }
    public function uploadpic(Request $request){
        $userid= Auth::user()->id;
                    if ($request->hasFile('picture')) {
                        $validation = $request->validate([
                        'picture' => 'file|image|mimes:jpeg,png,gif,webp|max:2048'
                        ]);
                        if ($validation) {
                            $filename =
                            $profilepic=$request->file('picture');
                            // $filename = time().$profilepic->getClientOriginalName();
                            // $path = $request->file('picture')->store('uploads');
                                    $path=Storage::putFile('',$profilepic);
                                        $update= DB::table('users')
                                        ->where('id', $userid)
                                        ->update(['photo'=>$path]);
                                
                                return back(); 
                        }
                        else{
                             return back();
                        }
                        
                    }
                    else{
                             return back();
                        }
    }
    public function displaydetails(Request $request){
        $bookid= $request->bookid;
        $id= $request->id;

        $booking=DB::table('bookings')
                    ->join('bookedsitters', 'bookings.id', '=', 'bookedsitters.idbookings')
                    ->join('users','bookedsitters.idsitter','=','users.id')
                    ->select('bookings.*', 'bookedsitters.*','users.*')
                    ->where(['bookings.idparent'=>$id,'bookings.id'=>$bookid])
                    ->get();
        foreach ($booking->toArray() as $mybook) {
            $chore = $mybook->chore_address;
            $careid= $mybook->id;
            $date= $mybook->booking_date;
            $lmark=$mybook->landmark;
            $choredate=$mybook->chore_date;
            $phone=$mybook->phone;
            $time=$mybook->timestart;
            $hours=$mybook->num_hours;
            $child=$mybook->num_child;
            $instruct=$mybook->instructions;
            $idcity=$mybook->idcity;
            $sfname=$mybook->user_fname;
            $slname=$mybook->user_lname;
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
                                <tr>
                                    <th><label>Sitter Name</label></th>
                                    <td>'.$sfname." ".$slname.'</td>
                                </tr>
                                </table></div>';
        echo $out;
    }
    public function displaycompletedetail(Request $request){
        $bookid= $request->bookid;
        $id= $request->id;

        $booking=DB::table('bookings')
                    ->join('bookedsitters', 'bookings.id', '=', 'bookedsitters.idbookings')
                    ->join('users','bookedsitters.idsitter','=','users.id')
                    ->select('bookings.*', 'bookedsitters.*','users.*')
                    ->where(['bookings.idparent'=>$id,'bookings.id'=>$bookid])
                    ->get();
        foreach ($booking->toArray() as $mybook) {
            $chore = $mybook->chore_address;
            $careid= $mybook->id;
            $date= $mybook->booking_date;
            $lmark=$mybook->landmark;
            $choredate=$mybook->chore_date;
            $phone=$mybook->phone;
            $time=$mybook->timestart;
            $hours=$mybook->num_hours;
            $child=$mybook->num_child;
            $instruct=$mybook->instructions;
            $idcity=$mybook->idcity;
            $sfname=$mybook->user_fname;
            $slname=$mybook->user_lname;
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
                                <tr>
                                    <th><label>Sitter Name</label></th>
                                    <td>'.$sfname." ".$slname.'</td>
                                </tr>
                                <tr>
                                    <th><label>Sitter Contact Details</label></th>
                                    <td>'.$phone.'</td>
                                </tr>
                                </table></div>';
        echo $out;}

        public function reviewsitter(Request $request){
        $bookid=$request->bookid;
        $sitterid=$request->sitterid;
        $parentid=$request->parentid;

        $accepts=DB::table('acceptedjobs')
                    ->join('bookings','acceptedjobs.idbookings','=','bookings.id')
                    ->join('sitters', 'bookings.idsitter', '=', 'sitters.iduser')
                    ->select('acceptedjobs.*','bookings.*','sitters.*')
                    ->where(['acceptedjobs.idbookings'=>$bookid,'acceptedjobs.status'=>'Ongoing'])
                    ->get();
        $useremail=DB::table('users')
                ->select('email')
                ->where(['id'=>$parentid])
                ->get();
        $userfname=DB::table('users')
                ->select('user_fname')
                ->where(['id'=>$parentid])
                ->get();
        $userlname=DB::table('users')
                ->select('user_lname')
                ->where(['id'=>$parentid])
                ->get();
        $phone=DB::table('users')
                ->select('phone')
                ->where(['id'=>$parentid])
                ->get();
        
        return view('parent.review',['bookid'=>$bookid,'sitterid'=>$sitterid,'parentid'=>$parentid,'accept'=>$accepts,'useremail'=>$useremail,'userfname'=>$userfname,'userlname'=>$userlname,'phone'=>$phone]);
    }
    public function submitreview(Request $request){
        if ($request->isMethod('post')) {
            
            $validation=$request->validate([
                'rating'=>'required',
                'reviewtitle'=>'required|string|max:255',
                'reviewtext'=>'required|string|max:255',
            ]);
            if ($validation) {
                $idbook= $request->input('idbooking');
                $idparent=$request->input('idpar');
                $idsitter=$request->input('idsit');
                $rating=$request->input('rating');
                $revtitle=$request->input('reviewtitle');
                $revtext=$request->input('reviewtext');

              DB::table('reviews')->insert(
                    ['idbookings' => $idbook, 'idparent' => $idparent,'idsitter'=>$idsitter,'ratings'=>$rating,'review_title'=>$revtitle,'review'=>$revtext]
                );
              $jobcomplete = DB::table('acceptedjobs')
              ->where('idbookings',$idbook)
              ->update(['status' => 'Completed']);
              return redirect()->action('MotherController@index');
            }
            
        }
        else{
            return back();
        }
    }
    public function searchsitters(Request $request){
        $state=$request->state;
        $location= $request->location;
        $childgrp=$request->childgrp;
    
            $rslt= DB::table('sitterchildgrps')
            ->join ('sitters','sitterchildgrps.user_id','=','sitters.iduser')
            ->join ('users','sitters.iduser','=','users.id')
            ->join('city', 'users.idcity','=','city.id' )
            ->select('sitters.*','users.*','city.*')
            ->when($childgrp, function($query,$childgrp){
                return $query->whereIn('sitterchildgrps.childgroup', array($childgrp));
            })
            ->when($location, function($query,$location){
                return $query->orWhere(['users.idcity'=>$location]);
            })
            ->distinct()
            ->get();
            foreach ($rslt->toArray() as $key) {
                $myname=$key->user_fname." ".$key->user_lname;
                $med_status = $key->med_status;
                                    $ref_status =$key->ref_status;
                                    $sit_status=$key->appr_status;
                                    $sitavail=$key->availability;
                                    $sitpix= $key->photo;
                                    $state=$key->state;
                                    $abt=$key->aboutme;
                                    $abtme=substr($abt,0, 150);
                                    $city=$key->city;
                                   
                                    $id=$key->iduser;

                                    $style="style='text-decoration:none; color: #131515;'";

                                    if  ((isset($sitpix) && $sitpix != '')) {
                                    $profile = 'storage/uploads/'.$sitpix;
                                } else {
                                    $profile = 'storage/female_avatar.png';
                                }

                                    if (($sit_status == 'approved') && ($med_status == 'approved') && ($ref_status == 'approved')){
                                        $status= "Verification Complete";
                                        $color="green";
                                        $icon="fa fa-check";
                                        
                                    }
                                    elseif ($med_status == 'approved') {
                                        $status= "Medically Verified";
                                        $color="green";
                                        $icon="fa fa-check";
                                        
                                    }
                                    elseif (($sit_status == 'approved') &&($ref_status == 'approved')) {
                                        $status= "Identity Verified";
                                        $color="green";
                                        $icon="fa fa-check";
                                        
                                    }
                                    else{
                                        $status= "Awaiting Verification";
                                        $color="red";
                                        $icon=" ";

                                    }

                                    if (($sit_status == 'not approved')||($sit_status == '')) {
                                    $idstat='';
                                    }
                                    else{
                                        $idstat="fas fa-user-check";
                                    }
                                    if (($med_status == 'not approved')||($med_status == '')) {
                                        $medstat='';
                                    }
                                    else{
                                        $medstat="fas fa-user-nurse";
                                    }
                                    if (($ref_status == 'not approved')||($ref_status == '')) {
                                        $refstat='';
                                    }
                                    else{
                                        $refstat="fas fa-id-card-alt";
                                    }

                                    if ($sitavail == 'available') {
                                        $avail ='Available';
                                    }
                                    else{
                                        $avail='Not Available';
                                    }

                $out="<a href='/sitter/profile/$id' title='Click to View More Details' style='text-decoration: none;color: #131515;'>
                        <div class='row sitters-list py-3 px-3'>
                            
                        <div class='col-md-2'>
                                <div class='row'>
                                    <div class='col'>
                                    
                        <img src='$profile' class='img-fluid rounded-circle' width= '100' height='150'>
                                </div>
                                </div>
                                <div class='row mt-3'>
                                    <div class='col'>
                                        <i class='$idstat' style='font-size: 1rem;'></i>&nbsp;
                                        <i class='$medstat' style='font-size: 1rem;'></i>&nbsp;
                                        <i class='$refstat' style='font-size: 1rem;'></i>&nbsp;
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-10'>
                                <div class='row'>
                                    <div class='col-md-10'>
                                        <span class='sitter-name'>$myname</span><p><span style= 'color:$color'>$status</span><i class='$icon'></i></p>
                                        <span>$city, </span><span>$state</span>
                                        <p></p>
                                    </div>
                                    <div class='col-md-2'>
                                        <p class='avail'>$avail</p>
                                    </div>
                                </div>
                                <div class='row mt-2' >
                                    <div class='col'>
                                        <p>$abtme<i><b>...Click to View More</b></i></p>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                        </a><hr>";
                echo $out;
            }
        
    }
    public function verify(Request $request){
       $ref=$request->response;
       // echo $ref;
       $result = array();
        //The parameter after verify/ is the transaction reference to be verified
        $url = "https://api.paystack.co/transaction/verify/".$ref;
        $ch = curl_init();
        // curl_setopt_array($ch, array(
        //       CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$ref,
        //       CURLOPT_RETURNTRANSFER => true,
        //       CURLOPT_HTTPHEADER => [
        //         "accept: application/json",
        //         "authorization: Bearer sk_test_12b7643f7a842cde47b91995e338fa7154b9c4a8",
        //         "cache-control: no-cache"
        //       ],
        //     ));

        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
          $ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer sk_test_12b7643f7a842cde47b91995e338fa7154b9c4a8']
        );
        $request = curl_exec($ch);
        $err = curl_error($ch);
        // curl_close($ch);

        if($err){
            // there was an error contacting the Paystack API
             echo $url;
          die('Curl returned error: ' . $err);
        }

        if ($request) {
            $result = json_decode($request, true);
            // print_r($result);
            if($result){
              if($result['data']){
                //something came in
                if($result['data']['status'] == 'success'){
                  // the transaction was successful, you can deliver value
                  /* 
                  @ also remember that if this was a card transaction, you can store the 
                  @ card authorization to enable you charge the customer subsequently. 
                  @ The card authorization is in: 
                  @ $result['data']['authorization']['authorization_code'];
                  @ PS: Store the authorization with this email address used for this transaction. 
                  @ The authorization will only work with this particular email.
                  @ If the user changes his email on your system, it will be unusable
                  */
                  echo "Transaction was successful";
                }else{
                  // the transaction was not successful, do not deliver value'
                  // print_r($result);  //uncomment this line to inspect the result, to check why it failed.
                  echo "Transaction was not successful: Last gateway response was: ".$result['data']['gateway_response'];
                }
              }else{
                echo $result['message'];
              }

            }else{
              //print_r($result);
              die("Something went wrong while trying to convert the request variable to json. Uncomment the print_r command to see what is in the result variable.");
            }
          }else{
            // var_dump($request);
            echo $ref;
            echo $url;
            die("Something went wrong while executing curl. Uncomment the var_dump line above this line to see what the issue is. Please check your CURL command to make sure everything is ok");
          }
    }
    public function jobcomplete($id){
       
            // $bookid= $request->id;
            $jobcomplete = DB::table('acceptedjobs')
              ->where('idbookings',$id)
              ->update(['status' => 'Completed','payment_type'=>'Online Transfer']);
              session()->flash('message','Payment Received. Kindly Review Your Sitter');
              return redirect()->action('MotherController@index');
        
       

    }
    
}
