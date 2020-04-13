@extends('layouts.app')
@section('content')

<?php 
if (isset($cgiver)) {
	foreach ($cgiver->toArray() as $service) {
	$avail =$service->availability;
	$gend =$service->gender;
	$mar =$service->marital_stat;
	$edu =$service->highedu;
	$exp =$service->sit_exper;
	$availa =$service->med_avail;
	$refstate =$service->ref_state;
	$city1=$service->idcity;
	$dob=$service->dob;
	$r1=$service->rate1;
	$r2=$service->rate2;
	$r3=$service->rate3;
	$abt=$service->aboutme;
	$reffname=$service->ref_fname;
	$reflname=$service->ref_lname;
	$refphone=$service->ref_phone;
	$refad=$service->ref_address;
	$pix=$service->photo;
	$dob=$service->dob;
	$sitstat=$service->appr_status;

}
}


if (isset($sitdays)) {
	 $sit= $sitdays->toArray();
}
if (isset($cgrp)) {
	 $childgrp= $cgrp->toArray();

}
if (isset($bookings)) {
	 $book= $bookings->toArray();

}
if (isset($getreq)) {
	 $req= $getreq->toArray();
}
if (isset($dob)) {
	$myage=$age->toArray();
	foreach ($myage as $key) {
		$sitage= $key->age;
	}
}
if (isset($accepts)) {
	$acc=$accepts->toArray();
}
if (isset($rejects)) {
	$rej=$rejects->toArray();
}
if (isset($completed)) {
	$comp=$completed->toArray();
}
if (isset($revs)) {
	$rev=$revs->toArray();
}
?>
<div class="row" id="bookinghis">
	<div class="col">
		<div class="row" >
    		<div class="col-md-3 px-3 py-5" id="sidebar">
    			<div class="row">
		  			<div class="col-md-7">
		  						<?php 
								if  ((isset($pix) && $pix != '')) {
									$profile = 'storage/uploads/'.$pix;
								} else {
									$profile = 'storage/female_avatar.png';
								}
								?>
		  				<img src="{{asset($profile)}}" alt="" class="img img-fluid rounded-circle" width='200' height='200'>
		  			</div>
		  			<div class="col-md-5">
		  				@if($sitstat == 'approved')
		  				<p style='color: green'><b>Verified<i class='fa fa-check'></i></b></p>
		  				@elseif($sitstat == 'not approved')
		  				<p style='color: red'><b>Not Verified</b></p>
		  				@else
		  				<p style='color: red'><b>Awaiting Verification</b></p><br>
		  				@endif
		  				@if(isset($chkrevs) && $chkrevs == 0)
		  					<p><i>No reviews</i></p>
		  					@else
		  						@if($rate >= 4.5)
		  						<i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i>
		  						@elseif($rate>=3.5)
		  						<i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' ></i>
		  						@elseif($rate>=2.5)
		  						<i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star'></i><i class='fa fa-star' ></i>
		  						@elseif($rate>=1.5)
		  						<i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' ></i><i class='fa fa-star'></i><i class='fa fa-star' ></i>
		  						@elseif($rate<1.5)
		  						<i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' ></i><i class='fa fa-star' ></i><i class='fa fa-star'></i><i class='fa fa-star' ></i>
		  						@else
		  						<p></p>
		  						@endif

		  				@endif
		  				@if($chkrevs == 1)

		  				<p><i>Based on {{$chkrevs}} Review</i></p>

		  				@endif
		  				@if($chkrevs > 1)

		  				<p><i>Based on {{$chkrevs}} Reviews</i></p>
		  				
		  				@endif

					</div>
		  		</div>
		  		<div class="row">
					<div class="col pt-3">
						<span><b>{{$fname." ".$lname}}</b></span><br>
						<span> <b>
						<?php if (isset($dob)) {
		  					echo $sitage." yrs old";
		  				} ?> </b></span>
		  				<p><?php if (isset($exp)) {
		  					echo $exp." yrs Experience in Childcare";
		  				} ?></p>
					</div>
				</div>
		  		<div class="row">
		  			<div class="col">
		  						<ul class="nav nav-pills flex-column" id="myTab" role="tablist">
		  							 
								  <li class="nav-item">
								    <a class="nav-link active" id="bookings-tab" data-toggle="tab" href="#bookings" role="tab" aria-controls="bookings" aria-selected="true">BOOKINGS</a>
								  </li>
								  <li class="nav-item">
								    <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">PROFILE SUMMARY</a>
								  </li>
					 			  <li class="nav-item">
								    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">REVIEWS</a>
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
								  				<h2>Welcome, </h2>
					  							<p>You can view all your past and upcoming bookings here</p>
					  				</div>
					  				<div class="col-md-4">
					  							<span style="color: #CA054D">Status:  </span><span><b>
					  					<?php 
										if ((isset($avail) && $avail == 'not available')||(!isset($avail))) : ?>
											Not Available
										<?php endif ?>
										<?php 
										if (isset($avail) && $avail == 'available') : ?>
											Available
										<?php endif ?>
					  							</b></span>
					  				</div>
					  			</div>
								<div class="row">
								  	<div class="col ">
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
	                               		 	@if(isset($requests) && $requests == false)
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
									  							<th></th>
									  							
									  						</tr>
									  					</thead>
									  					<tbody>
									  						<?php foreach($req as $key): 

															 	$bookdate= date("Y-m-d",strtotime($key->booking_date));
															 	$choredate= $key->chore_date;
															 	$hours=$key->num_hours;
															 	$status=$key->bookingstatus;
															 	$numchild=$key->num_child;
															 	$bookid=$key->idbookings;
																 $idparent=$key->idparent;
																 $idsitter=$key->idsitter;
	

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
														}

														if ($status == 'Awaiting Sitter Response') {
															$stat = 'Awaiting Your Response';									
														}?>
									  						<tr>
									  						<td>{{$bookdate}}</td>
									  						<td>{{$choredate}}</td>
									  						<td>{{$hours}}</td>
									  						<td>{{$price}}</td>
									  						<td>{{$stat}}</td>
									  						<td><button type='button' class='btn beginbtn btn-sm' data-toggle='modal' data-target='#exampleModalLong' id='detailsbtn'  data-user='{{$userid}}' data-book='{{$bookid}}'> VIEW MORE</button></td>
									  						<td><a href="<?php echo route('sitter.accept',['bookid'=>$key->idbookings, 'sitterid'=>$key->idsitter,'parentid'=>$key->idparent]) ?>" class="btn btn-sm beginbtn">ACCEPT</a>&nbsp;&nbsp;<a href="<?php echo route('sitter.reject',['bookid'=>$key->idbookings, 'sitterid'=>$key->idsitter,'parentid'=>$key->idparent]) ?>" class="btn  btn-sm beginbtn">REJECT</a></td>
									  						</tr>
									  					<?php endforeach ?>
									  					@endif
									  					</tbody>
									  				</table>
									  				<hr>
									  				@endif
								  	</div>
								</div>
								  		
								<div class="row">
								  	<div class="col">
								  				@if(isset($chkaccepts)&& $chkaccepts == 0)

								  				@else
								  				@if($acc != '')
								  				<p><b>ACCEPTED REQUESTS</b></p>
								  				
								  					<table class="table table-responsive-sm w-auto  table-striped" width="10%">
									  					
									  					<thead>
									  						<tr>
							
									  							<th>Sitting Date</th>
									  							<th>Duration</th>
									  							<th>Price</th>
									  							<th></th>
									  						</tr>
									  					</thead>
									  					<tbody>
									  					<?php foreach($acc as $key): 

															 	$sittingdate= $key->chore_date;
															 	$duration= $key->num_hours;
															 	$numchid= $key->num_child;
															 	$mybookid= $key->idbookings;

															 	if (($numchid == 1) && ($r1 != '')) {
																	$prie = "N".$r1."/hr";
																}
																elseif(($numchid == 2) && ($r2 != '')){
																	$prie = "N".$r2."/hr";
																}
																elseif(($numchid == '3+') && ($r3 != '')){
																	$prie = "N".$r3."/hr";
																}
																else{
																	$prie = '';
																}
																	 	
	

														?>
														<tr>
									  							<td>{{$sittingdate}}</td>
									  							<td>{{$duration}}</td>
									  							<td>{{$prie}}</td>
									  							<td><button type='button' class='btn beginbtn btn-sm' data-toggle='modal' data-target='#exampleModal' id='detailsbtn'  data-user='{{$userid}}' data-book='{{$mybookid}}' > VIEW MORE</button></td>
									  							
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
								  		@if(isset($chkrejects)&& $chkrejects == 0)

								  				@else
								  				@if($rej != '')
								  				<p><b>REJECTED REQUESTS</b></p>
								  				
								  					<table class="table table-responsive-sm w-auto table-striped" width="10%">
									  					
									  					<thead>
									  						<tr>
							
									  							<th>Booking ID</th>
									  							<th>Sitting Date</th>
									  							<th>Duration</th>
									  							<th>Price</th>
									  							
									  							
									  						</tr>
									  					</thead>
									  					<tbody>
									  						<?php foreach($rej as $key): 

															 	$sitdate= $key->chore_date;
															 	$dura= $key->num_hours;
															 	$numchd= $key->num_child;
															 	$bkid= $key->idbookings;

															 	if (($numchd == 1) && ($r1 != '')) {
																	$pri = "N".$r1."/hr";
																}
																elseif(($numchd == 2) && ($r2 != '')){
																	$pri = "N".$r2."/hr";
																}
																elseif(($numchd == '3+') && ($r3 != '')){
																	$pri = "N".$r3."/hr";
																}
																else{
																	$pri = '';
																}
																	 	
	

														?>
									  						<tr>
									  							<td>CARE0019{{$bkid}}</td>
									  							<td>{{$sitdate}}</td>
									  							<td>{{$dura}}</td>
									  							<td>{{$pri}}</td>
									  							
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
								  		@if(isset($chkcompleted)&& $chkcompleted == 0)

								  				@else
								  				@if($comp != '')
								  				<p><b>COMPLETED JOBS</b></p>
								  				
								  					<table class="table table-responsive-sm w-auto table-striped" width="10%">
									  					
									  					<thead>
									  						<tr>
							
									  							<th>Booking ID</th>
									  							<th>Parent</th>
									  							<th>Book Date</th>
									  							<th>Sitting Date</th>
									  							<th>Duration</th>
									  							<th>Total Amount</th>
									  							
									  							
									  						</tr>
									  					</thead>
									  					<tbody>
									  						<?php 
									  						foreach ($comp as $key):
									  							$bid=$key->idbookings;
									  							$parentname=$key->user_fname." ".$key->user_lname;
									  							$bkdate=date("Y-m-d",strtotime($key->booking_date));
									  							$stdate=$key->chore_date;
									  							$hrs=$key->num_hours;
									  							$child=$key->num_child;
									  							if (($child == 1) && ($r1 != '')) {
																	$cost = "N".$r1."/hr";
																	$tamt= $r1*$hrs;
																}
																elseif(($child == 2) && ($r2 != '')){
																	$cost = "N".$r2."/hr";
																	$tamt= $r2*$hrs;
																}
																elseif(($child == '3+') && ($r3 != '')){
																	$cost = "N".$r3."/hr";
																	$tamt= $r3*$hrs;
																}
																else{
																	$cost = '';
																	$tamt= '';
																}
									  						?>
									  					</tbody>
									  					<tr>
									  						<td>CARE0019{{$bid}}</td>
									  						<td>{{$parentname}}</td>
									  						<td>{{$bkdate}}</td>
									  						<td>{{$stdate}}</td>
									  						<td>{{$hrs}}</td>
									  						<td>N{{$tamt}}</td>
									  					</tr>
									  				<?php endforeach ?>
									  				</table>

								  					
											<hr>
											@endif
											@endif
								  	</div>
								</div>
					  		</div>
					  	</div>
					</div>
					  		<div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
							  	<div class="row">

							  		<div class="col pt-4">
									  			<p><b>ABOUT ME</b></p>
													<p><?php if (isset($abt)) {
		  					echo $abt;
		  				}
		  				else{
		  					echo "<i>Update your profile</i>";
		  				} ?></p>

								<p>EXPERIENCED WITH <span><b><?php
										  if (isset($childgrp)):
											  foreach ($childgrp as $grp): 
											  	 $chgrp = $grp->childgroup; ?>
												  {{$chgrp}}
											  <?php endforeach ?>
											  <?php endif ?></b></span> </p>
								<p>Available on <span><b><?php
										  if (isset($sit)):
											  foreach ($sit as $day): 
											  	 $sitday = $day->days; ?>
												  {{$sitday}}
											  <?php endforeach ?>
											  <?php endif ?></b></span></p>
					  				</div>
					  			</div>
					  	
					 		</div>
					 		
					  		<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					  			<div class="row">
					  				<div class="col">
					  					<div class="row my-3">
											<div class="col">
												<p>REVIEWS AND RATINGS</p>
											</div>
						
										</div>
										@if($chkrevs == 0)
										<p><i>No Reviews Yet</i></p>
										@else
										@if(isset($rev))

											<?php foreach ($rev as $key ): 
												$date=date("Y-m-d",strtotime($key->date_review));
														$reviewtitle=$key->review_title;
														$review=$key->review;
														$myrating=$key->ratings;
														$parent=$key->user_fname." ".$key->user_lname;
														
												?>
								
										<div class="row ">
											<div class="col-md-4">
												
												<span><b>{{$date}}</b></span>
												<p>@if($myrating == 5)<i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i>
												@elseif ($myrating == 4) <i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' ></i>
												@elseif ($myrating==3)<i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star'></i><i class='fa fa-star' ></i>
												@elseif ($myrating==2)<i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' ></i><i class='fa fa-star'></i><i class='fa fa-star' ></i>
												@else <i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' ></i><i class='fa fa-star' ></i><i class='fa fa-star'></i><i class='fa fa-star' ></i>
											@endif </p>
											</div>
											
										</div>
										<div class="row ">
											<div class="col">
												<p><b>{{$reviewtitle}}</b></p>
												<p><i>"{{$review}}"</i></p>
												<p><span>{{$parent}}, Abuja</span></p>
											</div>
											
										</div>
											
											
									
								<?php endforeach ?>
									@endif
									@endif
									</div>
								</div>
											
							</div>

							
						</div>
    				</div>
				</div>
			</div>
		</div>

		

	<!-- Button trigger modal -->

<!-- Modal -->
<div class='modal fade' id='exampleModalLong' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>
  <div class='modal-dialog modal-dialogue-centered modal-md' role='document'>
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
					url: '/sitdetails',
					type: 'GET',
					data: "id="+userid+ "&bookid="+bookid,
					success:function(data){
						// $('#bookdetails').html(data);
						 $(e.currentTarget).find('.modal-body').html(data);
						
					},
					error: function(err){
						console.log(err);
					}
				})
		});
			$('#exampleModal').on('show.bs.modal', function(e) {

		    //get data-id attribute of the clicked element
		    var userid = $(e.relatedTarget).data('user');
		    var bookid =$(e.relatedTarget).data('book');

		    //make an ajax call to receive an array based on userid
				$.ajax({
					url: '/sitcompletedetails',
					type: 'GET',
					data: "id="+userid+ "&bookid="+bookid,
					success:function(data){
						 $(e.currentTarget).find('.modal-body').html(data);
						
					},
					error: function(err){
						console.log(err);
					}
				})
		    

		   
		});
			
		})
	</script>
	<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>