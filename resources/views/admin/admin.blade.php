@extends('layouts.app')
@section('content')
<?php 
if (isset($sitter)) {
	$s=$sitter->toArray();
}
if (isset($parents)) {
	$u=$parents->toArray();
}
if (isset($bookings)) {
	$t=$bookings->toArray();
}
if (isset($reviews)) {
	$review=$reviews->toArray();
}
if (isset($references)) {
	$ref=$references->toArray();
}

?>

	<div class="row" >
		
		  <div class="col-2 px-3 py-3" id="sidebar">
		  	<div class="row">
		  		<div class="col-md-4">
		  			<i class="fas fa-user" style="font-size: 3rem"></i>
		  		</div>
		  		<div class="col-md-8">
		  			
		  		</div>
		  	</div>
		  	<div class="row">
		  		<div class="col">
		  			<p style="font-size: 1.5rem">Admin</p>
					
		  		</div>
		  	</div>
		  	<div class="row">
		  		<div class="col">
		  			<div class="nav flex-column " id="v-pills-tab" role="tablist" aria-orientation="vertical" >
		  		<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">DASHBOARD</a>
		      <a class="nav-link " id="v-pills-sitters-tab" data-toggle="pill" href="#v-pills-sitters" role="tab" aria-controls="v-pills-sitters" aria-selected="true">REGISTERED SITTERS</a>
		      <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">REGISTERED PARENTS</a>
		      <a class="nav-link" id="v-pills-bookings-tab" data-toggle="pill" href="#v-pills-bookings" role="tab" aria-controls="v-pills-bookings" aria-selected="false">BOOKINGS</a>
		      <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">MESSAGES</a>
		      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">REVIEWS</a>
		      <a class="nav-link" id="v-pills-reference-tab" data-toggle="pill" href="#v-pills-reference" role="tab" aria-controls="v-pills-reference" aria-selected="false">REFERENCES</a>
		    </div>
		  </div>
		  </div>
		  </div>
		  <div class="col-10">
		    <div class="tab-content" id="v-pills-tabContent">
		      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
		      	<div class="row">
					  			<div class="col " id='msg'>
					  				@if(session()->has('message'))
										<div class="alert alert-danger" role="alert">
									        {{ session('message') }}
									    </div>
									@endif
								</div>
		      </div>
		      <div class="row">
		      	<div class="col-md-3 my-4 mx-4" id="dashboard-tabs" >
		      		<h5>Total Registered Sitters</h5>
		      		<span style="color: red; font-size: 1.5rem;"><b>{{$chksit}}</b></span>
		      	</div>
		      	<div class="col-md-3 my-4 mx-4" id="dashboard-tabs" >
		      		<h5>Total Registered Parents</h5>
		      		<span style="color: blue; font-size: 1.5rem;"><b>{{$chkpar}}</b></span>
		      	</div>
		      	<div class="col-md-3 my-4 mx-4" id="dashboard-tabs" >
		      		<h5>Total Bookings</h5>
		      		<span style="color: green; font-size: 1.5rem;"><b>{{$chkbk}}</b></span>
		      	</div>
		      </div>
		      <div class="row">
		      	<div class="col-md-3 my-4 mx-4" id="dashboard-tabs" >
		      		<h5>Total Ongoing Jobs</h5>
		      		<span style="color: #CA054D; font-size: 1.5rem;"><b>{{$chkon}}</b></span>
		      	</div>
		      	<div class="col-md-3 my-4 mx-4" id="dashboard-tabs" >
		      		<h5>Total Completed Jobs</h5>
		      		<span style="color: blue; font-size: 1.5rem;"><b>{{$chkcomp}}</b></span>
		      	</div>
		      	<div class="col-md-3 my-4 mx-4" id="dashboard-tabs" >
		      		<h5>Total Rejected Jobs</h5>
		      		<span style="color: green; font-size: 1.5rem;"><b>{{$chkrej}}</b></span>
		      	</div>
		      </div>

		  </div>
		      <div class="tab-pane fade " id="v-pills-sitters" role="tabpanel" aria-labelledby="v-pills-sitters-tab">
		      	<table class="table table-responsive stripe" style="font-size: 12px;">
					<thead class="thead-dark">
						<tr>
							<th>S/NO</th>
							<th>Sitter ID</th>
							<th>Sitter Name</th>
							<th>Phone</th>
							<th>Address</th>
							<th>Email</th>
							<th>Availability</th>
							<th>Date Registered</th>
							<th>Approval Status</th>
							<th>Medical Status</th>
							<th>Ref Status</th>
							<th>UPDATE</th>
							<th>MESSAGE</th>
						</tr>
					</thead>
					<?php
						
						$sno=0;
						foreach ($s as $value):
							$sno++;

							$fullname=$value->user_fname." ".$value->user_lname;
							$phone=$value->phone;
							$datereg=date("d-m-Y",strtotime($value->created_at)) ;
							$addy=$value->address;
							$email=$value->email;
							$avail=$value->availability;
							$sitid=$value->id;
							$sitstat=$value->appr_status;
							$medstat=$value->med_status;
							$refstat=$value->ref_status;
							
							?>
							<tr>
							<td>{{$sno}}</td>
							<td>{{$sitid}}</td>
							<td><b>{{$fullname}}</b></td>
							<td>{{$phone}}</td>
							<td>{{$addy}}</td>
							<td>{{$email}}</td>
							<td>{{$avail}}</td>
							<td>{{$datereg}}</td>
							<td>{{$sitstat}}</td>
							<td>{{$medstat}}</td>
							<td>{{$refstat}}</td>
							<td><button type='button' class='btn beginbtn btn-sm' data-toggle='modal' data-target='#exampleModalLong1' id='detailsbtn'  data-user='{{$sitid}}' data-book='' data-name='{{$fullname}}'> UPDATE DETAILS</button></td>
							<td><button type='button' class='btn beginbtn btn-sm' data-toggle='modal' data-target='#exampleModalLong2' id='details'  data-user='{{$sitid}}' data-book='' data-name='{{$fullname}}'> SEND MESSAGE</button></td>
						</tr>


					<?php endforeach ?>
				</table>
		      </div>
		      <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
		      	<table class="table table-responsive stripe">
		      		<thead class="thead-dark">
		      			<tr>
		      				<th>S/NO</th>
		      				<th>Parent ID</th>
							<th>Parent Name</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Date Registered</th>
							<th>Update Message</th>
		      			</tr>
		      		</thead>
		      		<?php
						
						$sno=0;
						foreach ($u as $value):
							$sno++;

							$fullname=$value->user_fname." ".$value->user_lname;
							$phone=$value->phone;
							$datereg=date("d-m-Y",strtotime($value->created_at)) ;
							$addy=$value->address;
							$email=$value->email;
							$parid=$value->id;

							?>
							<tr>
							<td>{{$sno}}</td>
							<td>{{$parid}}</td>
							<td>{{$fullname}}</td>
							<td>{{$phone}}</td>
							<td>{{$email}}</td>
							<td>{{$datereg}}</td>
							<td><button type='button' class='btn beginbtn btn-sm' data-toggle='modal' data-target='#exampleModalLong2' id='details'  data-user='{{$parid}}' data-book='' data-name='{{$fullname}}'> SEND MESSAGE</button></td>
						</tr>
						<?php endforeach ?>
		      	</table>
		      </div>
		      <div class="tab-pane fade" id="v-pills-bookings" role="tabpanel" aria-labelledby="v-pills-bookings-tab"><table class="table table-responsive stripe">
		      		<thead class="thead-dark">
		      			<tr>
		      				<th>S/NO</th>
							<th>Booking Date</th>
							<th>SitterID</th>
							<th>Sitting Date</th>
							<th>ParentID</th>
							<th>Parent Phone</th>
							<th>Parent Address</th>
							<th>Number of Children</th>
							<th>Start Time</th>
							<th>Number of Hours</th>
							<th>Status</th>
							<th>Price</th>
		      			</tr>
		      		</thead>
		      		<tbody>
		      			<?php 
		      			$sno=0;
		      			foreach ($t as $key):
		      				$sno++;
		      				$bookdate=date('d-m-Y',strtotime($key->booking_date));
		      				$sitid=$key->idsitter;
		      				$sitdate=$key->chore_date;
		      				$parid=$key->idparent;
		      				$parph=$key->phone;
		      				$paradd=$key->chore_address;
		      				$numch=$key->num_child;
		      				$startime=$key->timestart;
		      				$numhrs=$key->num_hours;
		      				$stat=$key->bookingstatus;


		      			?>
		      			<tr>
		      				<td>{{$sno}}</td>
		      				<td>{{$bookdate}}</td>
		      				<td>{{$sitid}}</td>
		      				<td>{{$sitdate}}</td>
		      				<td>{{$parid}}</td>
		      				<td>{{$parph}}</td>
		      				<td>{{$paradd}}</td>
		      				<td>{{$numch}}</td>
		      				<td>{{$startime}}</td>
		      				<td>{{$numhrs}}</td>
		      				<td>{{$stat}}</td>
		      				<td></td>
		      				
		      			</tr>
		      		<?php endforeach ?>
		      		</tbody>
		      		
		      	</table></div>
		      <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
		      	
		      	<table class="table table-responsive stripe">
					<thead class="thead-dark">
						<tr>
							<th>S/NO</th>
							<th>Sender</th>
							<th>Receiver</th>
							<th>Receiver Type</th>
							<th>Date</th>
							<th>Message Sub</th>
							<th>Message</th>
							<th>Status</th>
							
						</tr>
					</thead>
					
				</table>

		      </div>
		      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
		      		<table class="table table-responsive stripe">
					<thead class="thead-dark">
						<tr>
							<th>S/NO</th>
							<th>Booking ID</th>
							<th>Sitter ID</th>
							<th>Parent ID</th>
							<th>Rating</th>
							<th>Review Title</th>
							<th>Review</th>
							<th>Date of Review</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sno=0; 
						foreach ($review as $key):
							$sno++;
							$bid=$key->idbookings;
							$sitid=$key->idsitter;
							$parid=$key->idparent;
							$rate=$key->ratings;
							$revt=$key->review_title;
							$rev=$key->review;
							$date=date('d-m-Y',strtotime($key->date_review));

						
						?>
						<tr>
							<td>{{$sno}}</td>
							<td>{{$bid}}</td>
							<td>{{$sitid}}</td>
							<td>{{$parid}}</td>
							<td>{{$rate}}</td>
							<td>{{$revt}}</td>
							<td>{{$rev}}</td>
							<td>{{$date}}</td>
							
						</tr>
					<?php endforeach ?>
					</tbody>
					
				</table>

		      </div>
		      <div class="tab-pane fade" id="v-pills-reference" role="tabpanel" aria-labelledby="v-pills-reference-tab">
		      		<table class="table table-responsive stripe">
					<thead class="thead-dark">
						<tr>
							<th>S/NO</th>
							<th>Sitter ID</th>
							<th>Name</th>
							<th>Address</th>
							<th>Phone</th>
							<th>Means of ID</th>
							<th>ID Num</th>
							<th>ID Expiry Date</th>
							<th>Status</th>
							
						</tr>
					</thead>
					<tbody>
						<?php 
						$sno=0;
						foreach ($ref as $key):
							$sno++;
							$sitid=$key->iduser;
							$name=$key->ref_fname." ".$key->ref_lname;
							$addy=$key->ref_address.", ".$key->city;
							$phone=$key->ref_phone;
							$means=$key->means;
							$idnum=$key->idnum;
							$idexp=$key->idexpire;
							$stat=$key->ref_status;
						 ?>
						 <tr>
						 <td>{{$sno}}</td>
						 <td>{{$sitid}}</td>
						 <td>{{$name}}</td>
						 <td>{{$addy}}</td>
						 <td>{{$phone}}</td>
						 <td>{{$means}}</td>
						 <td>{{$idnum}}</td>
						 <td>{{$idexp}}</td>
						 <td>{{$stat}}</td>
						 </tr>
						 <?php endforeach ?>
					</tbody>
					
				</table>

		      </div>
		    </div>
		  </div>
		</div>
@endsection

<div class='modal fade' id='exampleModalLong1' tabindex='-1' role='dialog' aria-labelledby='exampleModalLong1Title' aria-hidden='true'>
  <div class='modal-dialog modal-dialogue-centered modal-md' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLong1Title'>UPDATE DETAILS</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body' id="updatedetails">
      		<div class="row">
      			<div class="col">
					<form id="update">
						@csrf
						<div class="form-group">
							<label>Sitter Status</label>
							<select name="sitstatus" class="form-control">
								<option value="approved">Approved</option>
								<option value="not approved">Not Approved</option>
							</select>
							<label>Medical Status</label>
							<select name="medstatus" class="form-control">
								<option value="approved">Approved</option>
								<option value="not approved">Not Approved</option>
							</select>
							<label>Reference Status</label>
							<select name="refstatus" class="form-control">
								<option value="approved">Approved</option>
								<option value="not approved">Not Approved</option>
							</select>
							<label>Sitter ID</label>
							<input type="text" name="sitterid" value="" class="form-control">

						</div>
						<div class="form-group">
							<button type='submit' class='btn btn-outline-secondary'>Update Records</button>
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


<div class='modal fade' id='exampleModalLong2' tabindex='-1' role='dialog' aria-labelledby='exampleModalLong2Title' aria-hidden='true'>
  <div class='modal-dialog modal-dialogue-centered modal-md' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLong2Title'>YOUR BOOKING DETAILS</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body' id="bookdetails">
      		<div class="row">
      			<div class="col">
					<form id="sendmsg">
						@csrf
						<div class="form-group">
							<label>Message Title</label>
							<input type="text" name="msgtitle" class="form-control">
							<label>Message</label>
							<textarea name="msgbody" class="form-control"></textarea>
							<label>User ID</label>
							<input type="text" name="sitterid" value=" " class="form-control">
							<input type="hidden" name="adminid" value="{{$userid}}" class="form-control">

						</div>
						<div class="form-group">
							<button type='submit' class='btn btn-outline-secondary'>SEND MESSAGE</button>
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
<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#exampleModalLong1').on('show.bs.modal', function(e) {

		    var user=$(e.relatedTarget).data('name');
		    var id=$(e.relatedTarget).data('user');

		    				$.ajax({
		    					
					success:function(data){
						
		    			 $(e.currentTarget).find('.modal-title').html("UPDATE DETAILS FOR ID "+ id);
		    			  // $(e.currentTarget).find('.modal-body').html(data);
						
					},
					error: function(err){
						console.log(err);
					}
				})
		});
			$('#update').on("submit", function(e) {

		    //get data-id attribute of the clicked element
		    e.preventDefault();
		    var userid = $('#detailsbtn').data('user');
			var updatedetails =$(this).serialize();
		    

		    //make an ajax call to receive an array based on userid

            	$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
					},
            	});
				$.ajax({
					url: '/admin/update',
					type: 'POST',
					data: $(this).serialize(),
					success:function(data){
						location.href='/admin';
						console.log(data);
					},
					error: function(err){
						console.log(err);
					}
				})
		    

		   
		});
			$('#exampleModalLong2').on('show.bs.modal', function(e) {

		    var user=$(e.relatedTarget).data('name');
		    var id=$(e.relatedTarget).data('user');

		    				$.ajax({
		    					
					success:function(data){
						
		    			 $(e.currentTarget).find('.modal-title').html("MESSAGE ID "+ id);
		    			  // $(e.currentTarget).find('.modal-body').html(data);
						
					},
					error: function(err){
						console.log(err);
					}
				})
		});

			$('#sendmsg').on("submit", function(e) {

		    //get data-id attribute of the clicked element
		    e.preventDefault();
		   
		    //make an ajax call to receive an array based on userid
				$.ajax({
					url: 'sendmsg.php',
					type: 'POST',
					data: $(this).serialize(),
					success:function(data){
						location.href='admin-dashboard.php';
						// console.log(data);
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