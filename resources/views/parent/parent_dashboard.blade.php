@extends('layouts.app')
@section('content')

<?php 
foreach ($details->toArray() as $key ) {
	$joindate= $key->created_at;
	$pix=$key->photo;
} 
	$date= date("F, Y ",strtotime($joindate));
	$ftname =strtoupper($fname);
	$ltname =strtoupper($lname);
if (isset($request)) {
	$req=$request->toArray();
}
if (isset($accepts)) {
	$acc=$accepts->toArray();
	// print_r($acc);

}
if (isset($rejects)) {
	$rej=$rejects->toArray();
	
}
if (isset($complete)) {
	$comp=$complete->toArray();
}
if (isset($fave)) {
	$fav=$fave->toArray();
	


}
if (isset($reviews)) {
	$revs=$reviews->toArray();
	// echo "<pre>";
	// print_r($revs);
	// echo "</pre>";


}
?>
		<div class="row" id="bookinghis">
			<div class="col">
				<div class="row" >
    				<div class="col-md-3 px-3 py-5" id="sidebar">
    					<div class="row">
		  					<div class="col-md-6">
		  						<?php 
								if  ((isset($pix) && $pix != '')) {
									$profile = 'storage/uploads/'.$pix;
								} else {
									$profile = 'storage/female_avatar.png';
								}
								?>
						<img src="{{asset($profile)}}"  width="150" height="150" class="rounded-circle">
		  						<form class="form-group row" action="{{route('parent.upload')}}" method="POST" enctype="multipart/form-data">
								@csrf
									<input type="file" name="picture" class="" />
									<button type="submit" class="btn btn-md beginbtn ml-5 mt-3">Upload</button>
								</form>
		  					</div>
		  					
		  				</div>
					  	<div class="row">
					  		<div class="col pt-3">
					  			<span><b>{{$ftname}} {{$ltname}}</b></span>
				  						<p><span>iCARE Parent since <b><i>{{$date}}</i></b></span></p>
						 </div>
					  	</div>
		  				<div class="row">
		  					<div class="col">
		  						<ul class="nav nav-pills flex-column" id="myTab" role="tablist">
		  						
								  <li class="nav-item">
								    <a class="nav-link active" id="bookings-tab" data-toggle="tab" href="#bookings" role="tab" aria-controls="bookings" aria-selected="true">BOOKINGS</a>
								  </li>
								  <li class="nav-item">
								    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">FAVORITE SITTERS</a>
								  </li>
								  
								  
								</ul>
					  		</div>
					  	</div>
			       			
    				</div>
    <!-- /.col-md-4 -->
        	<div class="col-md-9" id="bookingtab">
      			<div class="tab-content" id="myTabContent">
      				
					 <div class="tab-pane fade show active" id="bookings" role="tabpanel" aria-labelledby="bookings-tab">
					  	<div class="row mx-3 my-3 py-3" >
					  		<div class="col">
					  			@if(session()->has('message'))
									<div class="alert alert-danger" role="alert">
									    {{ session('message') }}
									</div>
								@endif
								@if ($errors->any())
									<div class="alert alert-danger">
		                                @foreach ($errors->all() as $error)
		                                    {{ $error }}<br>
		                                @endforeach
	                                </div>
	                            @endif	
							<div class="row">
									<div class="col-md-8">
										  			<h2>Welcome, {{$ftname}}<span></h2>
										  			<p>You can view all your past and upcoming bookings here</p>
						  			</div>
						  			<div class="col-md-4 linkdivs">
						  			<a href="{{ route('parent.avsitters') }}" class="btn beginbtn">BOOK AN AVAILABLE SITTER</a>
						  			</div>
					  		</div>
					  		<div class="row">
					  			<div class="col " id='msg'>
					  							
									@if (isset($chkrequest) && $chkrequest == 0)
									{{$chkrequest}}
									<p><b><i>No Pending Requests</i></b></p>
									<hr>
									@else
										@if(isset($req))
					  				<table class="table table-responsive-sm w-auto table-striped" width="10%">
					  					
					  					<thead>
					  						<tr>
			
					  							<th>Booking Date</th>
					  							<th>Sitting Date</th>
					  							<th>Duration</th>
					  							<th>Price</th>
					  							<th>Status</th>
					  							<th></th>
					  							
					  						</tr>
					  					</thead>
					  					<tbody>
					  						<?php foreach($req as $key): 

															 	$bookdate= date("Y-m-d",strtotime($key->booking_date));
															 	$choredate= $key->chore_date;
															 	$myhours=$key->num_hours;
															 	if ($myhours == 1) {
															 		$hr = $myhours." Hour";
															 	}
															 	else{
															 		$hr = $myhours." Hours";
															 	}
															 	$status=$key->bookingstatus;
															 	$numchild=$key->num_child;
															 	$bookid=$key->idbookings;
															 	$idparent=$key->idparent;
															 	$r1=$key->rate1;
															 	$r2=$key->rate2;
															 	$r3=$key->rate3;
	
														if (($numchild == 1) && ($r1 != '')) {
															$price = "N".$r1."/hr";
														}
														elseif(($numchild == 2) && ($r2 != '')){
															$price = "N".$r2."/hr";
														}
														elseif(($numchild == '3+') && ($r3 != '')){
															$price = "N".$r3."/hr";
														}
														else{
															$price = '';
														}?>
									  						<tr>
									  						<td>{{$bookdate}}</td>
									  						<td>{{$choredate}}</td>
									  						<td>{{$hr}}</td>
									  						<td>{{$price}}</td>
									  						<td>{{$status}}</td>
									  						<td><button type='button' class='btn beginbtn btn-sm' data-toggle='modal' data-target='#exampleModalLong' id='detailsbtn'  data-user='{{$userid}}' data-book='{{$bookid}}' data-name=''> VIEW MORE</button></td>
									  						</tr>
									  					<?php endforeach ?>
					  						
					  					</tbody>
					  				</table>
					  				
						  				<hr>
						  				@endif
						  			@endif
					  			</div>
					  		</div>

					  		<div class="row">
					  			<div class="col">
					  				@if(isset($chkaccepts) && $chkaccepts == 0)

					  				@else
					  				@if(isset($acc))
					  				<p><b> ACCEPTED REQUESTS</b></p>
					  				
					  					<table class="table table-responsive-sm w-auto table-striped" width="10%">
						  					
						  					<thead>
						  						<tr>
				
						  							<th>Sitting Date</th>
						  							<th>Duration</th>
						  							<th>Price</th>
						  							<th>Total Amount</th>
						  							<th></th>
						  							<th></th>
						  							
						  						</tr>
						  					</thead>
						  					<tbody>
						  						<?php foreach($acc as $key): 

															 	$mysitdate= $key->chore_date;
															 	$myhours=$key->num_hours;
															 	if ($myhours == 1) {
															 		$hr = $myhours." Hour";
															 	}
															 	else{
															 		$hr = $myhours." Hours";
															 	}
															 	$mystatus=$key->bookingstatus;
															 	$mynumchild=$key->num_child;
															 	$mybookid=$key->idbookings;
															 	$myidsitter=$key->idsitter;
															 	$myr1=$key->rate1;
															 	$myr2=$key->rate2;
															 	$myr3=$key->rate3;
	
														if (($mynumchild == 1) && ($myr1 != '')) {
															$myprice = "N".$myr1."/hr";
															$mytotal = $myr1*$myhours;
														}
														elseif(($mynumchild == 2) && ($myr2 != '')){
															$myprice = "N".$myr2."/hr";
															$mytotal = $myr2*$myhours;
														}
														elseif(($mynumchild == '3+') && ($myr3 != '')){
															$myprice = "N".$myr3."/hr";
															$mytotal = $myr3*$myhours;
														}
														else{
															$myprice = '';
															$mytotal=0;
														}

														$amt=$mytotal*100;
														?>

														<tr>
						  							<td>{{$mysitdate}}</td>
						  							<td>{{$hr}}</td>
						  							<td>{{$myprice}}</td>
						  							<td>N{{$mytotal}}</td>
						  							<td><button type='button' class='btn beginbtn btn-sm' data-toggle='modal' data-target='#exampleModal' id='detailsbtn'  data-user='{{$userid}}' data-book='{{$mybookid}}' > VIEW MORE</button></td>
						  							<td ><span id='review'><a href='<?php echo route('parent.payment',['bookid'=>$mybookid, 'sitterid'=>$myidsitter,'parentid'=>$userid]) ?>' title='review' class='btn beginbtn btn-sm'>PAY WITH CARD</a> </span></td>
						  							
						  						</tr>
														<?php endforeach ?>
						  						
						  					</tbody>
						  				</table>

					  					
									<hr>

									@endif
									@endif
					  			</div>
					  		</div>
					  	
					  		<div class="row">
					  			<div class="col">
					  				@if(isset($chkcomplete) && $chkcomplete == 0)

					  				@else
					  				@if(isset($comp))
					  				<p><b> COMPLETED REQUESTS</b></p>
					  				
					  					<table class="table table-responsive-sm w-auto table-striped" width="10%">
						  					
						  					<thead>
						  						<tr>
				
						  							<th>Booking ID</th>
						  							<th>Sitter</th>
						  							<th>Sitting Date</th>
						  							<th>Duration</th>
						  							<th>Price</th>
						  							<th></th>
						  							
						  							
						  						</tr>
						  					</thead>
						  					<tbody>
						  						<?php foreach($comp as $key): 

															 	$mysitdate= $key->chore_date;
															 	$myhours=$key->num_hours;
															 	$sittername=$key->user_fname." ".$key->user_lname;
															 	if ($myhours == 1) {
															 		$hr = $myhours." Hour";
															 	}
															 	else{
															 		$hr = $myhours." Hours";
															 	}
															 	$mystatus=$key->bookingstatus;
															 	$mynumchild=$key->num_child;
															 	$mybookid=$key->idbookings;
															 	$myidsitter=$key->idsitter;
															 	$myr1=$key->rate1;
															 	$myr2=$key->rate2;
															 	$myr3=$key->rate3;
	
														if (($mynumchild == 1) && ($myr1 != '')) {
															$myprice = "N".$myr1."/hr";
														}
														elseif(($mynumchild == 2) && ($myr2 != '')){
															$myprice = "N".$myr2."/hr";
														}
														elseif(($mynumchild == '3+') && ($myr3 != '')){
															$myprice = "N".$myr3."/hr";
														}
														else{
															$myprice = '';
														}?>
														<tr>
						  							<td>CARE0019{{$mybookid}}</td>
						  							<td>{{$sittername}}</td>
						  							<td>{{$mysitdate}}</td>
						  							<td>{{$hr}}</td>
						  							<td>{{$myprice}}</td>
						  							<td>
						  							@if(empty($revs))
						  							<button type='button' class='btn beginbtn btn-sm' data-toggle='modal' data-target='#reviewModal' id='detailsbtn'  data-user='{{$userid}}' data-book='{{$mybookid}}' data-sitter='{{$myidsitter}}'>REVIEW YOUR SITTER</button>
						  							@elseif(!empty($revs))
						  							<?php foreach($revs as $key):
						  								$idbk=$key->idbookings;
						  							if($idbk != $mybookid): ?>
						  								{{$mybookid}}
						  								{{$idbk}}
						  							<button type='button' class='btn beginbtn btn-sm' data-toggle='modal' data-target='#reviewModal' id='detailsbtn'  data-user='{{$userid}}' data-book='{{$mybookid}}' data-sitter='{{$myidsitter}}'>REVIEW YOUR SITTER</button>
						  							<?php endif?>
						  						<?php endforeach ?>
						  							@else

						  							@endif
						  							
						  						</td>
						  							
						  						</tr>
													<?php endforeach ?>
						  						
						  					</tbody>
						  				</table>

					  					
									<hr>
									@endif
									@endif

					  			</div>
					  		</div>
					  			<div class="row">
					  			<div class="col">
					  				@if(isset($chkrejects) && $chkrejects == 0)

					  				@else
					  				@if(isset($rej))
					  				<p><b> CANCELLED REQUESTS</b></p>
					  				
					  					<table class="table table-responsive-sm w-auto table-striped" width="10%">
						  					
						  					<thead>
						  						<tr>
				
						  							<th>Booking ID</th>
						  							<th>Sitter</th>
						  							<th>Date of Booking</th>
						  							<th>Sitting Date</th>
						  							<th>Duration</th>
						  							
						  							
						  						</tr>
						  					</thead>
						  					<tbody>
						  						<?php foreach($rej as $key): 

															 	$mysitdate= $key->chore_date;
															 	$mybkdate=$key->booking_date;
															 	$myhours=$key->num_hours;
															 	$sitname=$key->user_fname." ".$key->user_lname;
															 	if ($myhours == 1) {
															 		$hr = $myhours." Hour";
															 	}
															 	else{
															 		$hr = $myhours." Hours";
															 	}
															 	$mystatus=$key->bookingstatus;
															 	$mynumchild=$key->num_child;
															 	$mybookid=$key->idbookings;
														?>
														<tr>
						  							<td>CARE0019{{$mybookid}}</td>
						  							<td>{{$sitname}}</td>
						  							<td>{{$mybkdate}}</td>
						  							<td>{{$mysitdate}}</td>
						  							<td>{{$hr}}</td>
						  							
						  						</tr>
						  						<?php endforeach ?>
						  					</tbody>
						  				</table>
						  			@endif
					  				@endif	
					  			</div>
					  		</div>
					  		</div>
					  	</div>
					</div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<div class="row">
							<div class="col-md-1"></div>
							<div class="col-md-10 my-3">
								@if(isset($fav) && $fav != '')
								<?php
									foreach ($fav as $key):
										$sitpix=$key->photo;
										$name=strtoupper($key->user_fname." ".$key->user_lname);
										$med_status = $key->med_status;
										$ref_status =$key->ref_status;
										$sit_status=$key->appr_status;
										$r1=$key->rate1;
										$r2=$key->rate2;
										$r3=$key->rate3;
										$id=$key->iduser;
										$sitavail=$key->availability;
 
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
								?>
								<div class='row  py-3 px-3'>
									<div class='col-md-2'>
										<div class='row'>
											<div class='col'>

												<img src='{{asset($profile)}}' class='img-fluid rounded-circle' width= '100' height='100'>
											</div>
										</div>
										
									</div>
										<div class='col-md-6'>
											<div class='row'>
													<div class='col-md-10'>
														<p class='sitter-name'>{{$name}} <i class="@if(isset($idstat)) {{ $idstat ?? '' }}  @endif" style='font-size: 1rem;'></i>
										<i class="@if(isset($medstat)) {{ $medstat ?? '' }}  @endif" style='font-size: 1rem;'></i>
										<i class="@if(isset($refstat)) {{ $refstat ?? '' }}  @endif" style='font-size: 1rem;'></i>&nbsp;</p>
														
														<span><b>PRICE RATES: </b></span><br>
														<span>One Child: </span>@if(isset($r1) && $r1 != '')<span> N{{$r1}}/Hour</span>@else <span>Not Available</span>@endif<br>
													  <span>Two Children: </span>@if(isset($r2) && $r2 != '')<span> N{{$r2}}/Hour</span>@else <span>Not Available</span>@endif<br>
													  <span>Three Children & above: </span>@if(isset($r3) && $r3 != '')<span> N{{$r3}}/Hour</span>@else <span>Not Available</span>@endif<br><br><br>
													</div>
													<div class='col-md-2'>
														<p class='avail'></p>
														<p><b>@if(isset($sitavail)) @if($sitavail == 'available') AVAILABLE @else AVAILABLE LATER @endif @endif</b></p>
														<button class='btn btn-outline-danger btn-lg'><a href='<?php echo route('parent.sitsummary',['sitterid'=>$id]);?>' style='text-decoration: none;color: #131515;' title='Click to Book '>BOOK</a> </button>
													</div>
												</div>
												
											</div>
									
										</div>
										<?php endforeach ?>
									@else
									<p><i><b>You have no favourite sitter</b></i></p>
									@endif
							</div>
							<div class="col-md-1"></div>
						</div>
					</div>
					
				</div>
    		</div>
		</div>
	</div>
</div>

		
		<div class='modal fade' id='exampleModalLong' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>
  <div class='modal-dialog modal-dialogue-centered modal-lg' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLongTitle'>YOUR BOOKING DETAILS</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body' id="bookdetails">
        
      </div>
      
    </div>
  </div>
</div>


<!-- Modal 2-->
<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>
  <div class='modal-dialog modal-dialogue-centered modal-md' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalTitle'>YOUR BOOKING DETAILS</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body' id="acceptdetails">
      	
        </div>
      
      <!-- <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
        <button type='button' class='btn btn-primary'>Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<!-- Modal 3-->
<div class='modal fade' id='reviewModal' tabindex='-1' role='dialog' aria-labelledby='reviewModalLongTitle' aria-hidden='true'>
  <div class='modal-dialog modal-dialogue-centered modal-md' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='reviewModalTitle'>Rate Your Sitter</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body' id="reviewdetails">
      			<div class='card'>
                    <div class='card-header'>
                        <p>Kindly Rate Your Sitter</p>
                    </div>
                    <div class='card-body'>
                        <form method='post'  action='/reviews'>
                            @csrf
                                <div class='form-group'>
                                <p><b>RATING</b></p>
                                <input type='radio' name='rating' value='1' id='1'>
                                <label for='1'><i class='fas fa-star' style='color:#FF9F1C'></i></label>
                                <input type='radio' name='rating' value='2' id='2'>
                                <label for='2'><i class='fas fa-star' style='color:#FF9F1C'></i><i class='fas fa-star' style='color:#FF9F1C'></i></label>
                                <input type='radio' name='rating' value='3' id='3'>
                                <label for='3'><i class='fas fa-star' style='color:#FF9F1C'></i><i class='fas fa-star' style='color:#FF9F1C'></i><i class='fas fa-star' style='color:#FF9F1C'></i></label>
                                <input type='radio' name='rating' value='4' id='4'>
                                <label for='4'><i class='fas fa-star' style='color:#FF9F1C'></i><i class='fas fa-star' style='color:#FF9F1C'></i><i class='fas fa-star' style='color:#FF9F1C'></i><i class='fas fa-star' style='color:#FF9F1C'></i></label>
                                <input type='radio' name='rating' value='5' id='5'>
                                <label for='5'><i class='fas fa-star' style='color:#FF9F1C'></i><i class='fas fa-star' style='color:#FF9F1C'></i><i class='fas fa-star' style='color:#FF9F1C'></i><i class='fas fa-star' style='color:#FF9F1C'></i><i class='fas fa-star' style='color:#FF9F1C'></i></label>
                            </div>
                            <div class='form-group'>
                                <label>Title</label>
                                <input type='text' name='reviewtitle' class='form-control' required='required' id='revt'>
                                <label>Review</label>
                                <textarea name='reviewtext' class='form-control' required='required' id='rev'></textarea>
                                <input  name='idpar' class='form-control' required='required' value='' id='idpar'>
                                <input  name='idsit' class='form-control' required='required' value='' id='idsit'>
                                <input  name='idbooking' class='form-control' required='required' value='' id='idbook'>
                            </div>
                            <div class='form-group'>
                                <button class='btn beginbtn' type='submit' name='sub'>Submit Review</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
      
      <!-- <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
        <button type='button' class='btn btn-primary'>Save changes</button>
      </div> -->
    </div>
  </div>
</div>
@endsection
<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
	<script type="text/javascript">
		
		$(document).ready(function(){
			$('#exampleModalLong').on('show.bs.modal', function(e) {

		    //get data-id attribute of the clicked element
		    var userid = $(e.relatedTarget).data('user');
		    var bookid =$(e.relatedTarget).data('book');
		    
		    

		    //make an ajax call to receive an array based on userid
				$.ajax({
					url: '/pardetail',
					type: 'GET',
					data: "id="+userid+ "&bookid="+bookid,
					success:function(data){
						// $('#bookdetails').html(data);
						 $(e.currentTarget).find('.modal-body').html(data);
		    	// 		 $(e.currentTarget).find('.modal-title').html("BOOKING DETAILS");
		    		// console.log(data);
						
					},
					error: function(err){
						console.log(err);
					}
				})
		   
		});

			$('#exampleModal').on('show.bs.modal', function(e) {

		    //get data-id attribute of the clicked element
		    var userid = $(e.relatedTarget).data('user');
		    var mybookid =$(e.relatedTarget).data('book');

		    //make an ajax call to receive an array based on userid
				$.ajax({
					url: '/parcompletedetail',
					type: 'GET',
					data: "id="+userid+ "&bookid="+mybookid,
					success:function(data){
						 $(e.currentTarget).find('.modal-body').html(data);
						
					},
					error: function(err){
						console.log(err);
					}
				})

		   
		});

				//triggered when modal is about to be shown
		$('#reviewModal').on('show.bs.modal', function(e) {

		    //get data-id attribute of the clicked element
		     var userid = $(e.relatedTarget).data('user');
		    var mybookid =$(e.relatedTarget).data('book');
		    var sitter=$(e.relatedTarget).data('sitter');

		    //populate the textbox
		    $(e.currentTarget).find('input[name="idpar"]').val(userid);
		    $(e.currentTarget).find('input[name="idsit"]').val(sitter);
		    $(e.currentTarget).find('input[name="idbooking"]').val(mybookid);
		});
			

			
		})
	</script>
	<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>