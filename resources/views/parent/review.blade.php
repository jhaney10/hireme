@extends('layouts.app')
@section('content')
<?php 
if (isset($accept)) {
	$acc=$accept->toArray();
	foreach ($acc as $key) {
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
	}
	
	foreach ($useremail as $key) {
		$email= $key->email;
	}
	foreach ($userfname as $key) {
		$fname= $key->user_fname;
	}
	foreach ($userlname as $key) {
		$lname= $key->user_lname;
	}
	foreach ($phone as $key) {
		$ph= $key->phone;
	}

}
?>
	<div class="row" id="review-body">
		<div class="col">
			<div class="row justify-content-center">
				<div class="col mt-3 mx-3 ">
					<h3 align="center">Hope you had a Wonderful Sitting Experience</h3>
				</div>
			</div>
		<div class="row justify-content-center">
			<div class="col-md-6 my-4 mx-3">
				<div class="card">
					<div class="card-header">
						{{ __('Sitting Summary') }}
					</div>
					<div class="card-body">
						<table class="table table-responsive ">
							
							<tr>
								<th>Total Number of Children</th>
								<td>{{$mynumchild}}</td>
							</tr>
							<tr>
								<th>Total Sitting Hours</th>
								<td>{{$hr}}</td>
							</tr>
							<tr>
								<th>Price per Hour</th>
								<td>{{$myprice}}</td>
							</tr>
							<tr>
								<th>Your Total</th>
								<td>N{{$mytotal}}</td>
							</tr>
						</table>
						<p><b><i>*Extra Charges may be required if extra chores were carried out by the sitter</i></b></p>
						<form >
									@csrf
													  <script src="https://js.paystack.co/v1/inline.js"></script>
													  <button type="button" class="btn btn-md beginbtn" id="pay" onclick="payWithPaystack()" data-email="{{$email}}" data-amount={{$amt}} data-user="{{$fname}}" data-name="{{$lname}}" data-phone="{{$ph}}" data-book="{{$mybookid}}"> Pay Now</button> 
													</form>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
@endsection
<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
	<script type="text/javascript">
			function payWithPaystack(){
			var elem = document.getElementById('pay');
			var email = elem.getAttribute('data-email');
			var amount   = elem.getAttribute('data-amount');
			var fname = elem.getAttribute('data-user');
			var lname   = elem.getAttribute('data-name');
			var phone   = elem.getAttribute('data-phone');
			var bookid   = elem.getAttribute('data-book');


    var handler = PaystackPop.setup({

      key: 'pk_test_69519a95062eb43fc95692accdb2afd9b91e3422',
      email: email,
      amount: amount,
      currency: "NGN",
      // ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      firstname: fname,
      lastname: lname,
      // label: "Optional string that replaces customer email"
      metadata: {
         custom_fields: [
            {
                display_name:  bookid,
                variable_name: bookid,
                value: phone
            }
         ]
      },
      callback: function(response){
      	$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
					},
            	});
      	$.ajax({
		    url: '/verify',
		    data: {"_token":"{{ csrf_token() }}",response:response.reference},
		    method: 'post',
		    success: function (data) {
		      console.log(data);
		      window.location = "/jobdone/"+bookid;
		      // alert('success. transaction ref is ' + data);
		    }
		  });
      	// window.location = "http://www.yoururl.com/file.php?reference=" + response.reference;
       //    alert('success. transaction ref is ' + response.reference);
      },
      onClose: function(){
          alert('window closed');
      }
    });
    handler.openIframe();
  }
		$(document).ready(function(){
			
			
		})
	</script>
	<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>