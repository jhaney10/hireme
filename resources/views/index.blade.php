
@extends('layouts.app')

@section('content')
<?php 

if (isset($reviews)) {
	$revs=$reviews->toArray();
}
if (isset($avail)) {
	$sitters=$avail->toArray();
}
?> 
	<div class="row" id="landingpg">
			
			<div class="col" id="bg">
				<div id="parentintro">
					{{session('usertype')}}
					@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					<div class="row" id="childintro">
						<div class="col pb-5" id="intro">
							<p align="center" style="font-size: 2.5rem;" class="heading">TRUSTED ON-DEMAND CHILDCARE SERVICES</p>
							<p align="center" style="font-size: 23px;">iCare connects parents to reliable and trusted babysitters and housekeepers</p>
							<div class="btn-group mybuttons" style="margin-left: 36%">
								 <button type="button" class="btn beginbtn btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    GET STARTED
								 </button>
								 <div class="dropdown-menu">
								    <a class="dropdown-item" href="{{ route('pregister')}}">Find a Sitter</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item" href="{{ route('register') }}">Become a Sitter</a>
								 </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div  id="features" class="row my-5">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-3">
						<p align="center"><i class="fa fa-users" style="font-size: 70px;" ></i></p>
						<p align="center"><b>VARIETY OF CHOICE</b></p>
						<p align="center">Choose your ideal sitter from a network of over fifty verified sitters</p>
						
					</div>
					<div class="col-md-3">
						<p align="center"><i class="fas fa-calendar-alt" style="font-size: 70px"></i></p>
						<p align="center"><b>FLEXIBILITY</b></p>
						<p align="center">Book ahead of your desired date of engagement and have your </p>
					</div>
					<div class="col-md-3">
						
						<p align="center"><i class="fa fa-comment-dots" style="font-size: 70px"></i></p>
						<p align="center"><b>SITTERS YOU LIKE</b></p>
						<p align="center">Rate your Sitters to let us know what you desire of your sitters</p>
					</div>
					<div class="col-md-3">
						<p align="center"><i class="fa fa-grin-beam" style="font-size: 70px;"></i></p>
						<p align="center"><b>PEACE OF MIND</b></p>
						<p align="center">Spend your day knowing you home and kids are in good hands</p>
					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
		<div class="row" id="parentschoice">
			<div class="col">
				<div class="row my-3">
					 <div class="col">
					 	<h1 align="center">Feel at ease everyday...</h1>

					 </div>
				</div>
				<div class="row mb-3">
					<div class="col-md-1"></div>
					<div class="col-md-5 linkdivs">
						<h3>Stress no more about where to find a babysitter or housekeeper</h3><br>
					 	<p>More options on a convenient platform for parents to choose from a trusted pool of helpers</p>
					 	<button class="btn beginbtn btn-lg"><a href="parents_signup.php">PARENTS: SIGN UP</a></button><br><br>
					</div>
					<div class="col-md-5">
							<img src="image/6.jpg" class="img-fluid rounded-circle" alt="" style=" ">
					</div>
					<div class="col-md-1"></div>
				</div>	
			</div>
		</div>
		<div class="row" id="sitterschoice">
			<div class="col">
				<div class="row my-3">
					 <div class="col">
					 	<h1 align="center">Flexible Work Hours</h1>

					 </div>
				</div>
				<div class="row mb-3">
					<div class="col-md-1"></div>
					
					<div class="col-md-5">
							<img src="image/22.jpg" class="img-fluid rounded-circle" alt="parent" style=" ">
					</div>
					<div class="col-md-5 linkdivs">
						<h3>Babysitting and Nanny Jobs Within Your Available Time Schedule</h3><br>
					 	<p>Create a remarkable profile, set your work-hours and price, provide necessary information to get verified, accept jobs and be the best nanny ever!</p>
					 	<button type="button" class="btn beginbtn btn-lg"><a href="{{ route('register') }}">SITTERS: SIGN UP</a></button><br><br>
					</div>
					<div class="col-md-1"></div>
				</div>	
			</div>
		</div>
		@if($cntrev >= 3)
		<div class="row" id="reviews">
			<div class="col">
				<div class="row my-3">
					 <div class="col-12">
					 	<h1 align="center">TESTIMONIALS</h1>
					 	<h4 align="center">Your Best Option is Just A Click-Away</h3>

					 </div>
				</div>
				
				<div class="row mb-3 pb-5">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="row">
							<?php foreach ($revs as $key ): 
								$pix= $key->photo;
								$review=$key->review;
								$revi= substr($review,0, 150);
								$parent=$key->user_fname." ".$key->user_lname;
								$state=$key->state;

								
								if  ((isset($pix) && $pix != '')) {
									$profile = 'storage/uploads/'.$pix;
								} else {
									$profile = 'storage/female_avatar.png';
								}
								?>
						<div class="col-md-4 py-3" >
							<div class="card card-box" style="width: 18rem; height: 25rem">
  								<img src="{{asset($profile)}}" class="card-img-top" alt="...">
 								 <div class="card-body">
    								<p class="card-text"><i>"{{$revi}}"</i></p>
    								<p><b>{{$parent}}, {{$state}}</b></p>
  								</div>
							</div>
						</div>
						<?php endforeach ?>
					
						</div>
					</div>
					<div class="col-md-1"></div>
					
				</div>
				
				
			</div>
		</div>
		@endif
		@if($numav >= 3)
			<div id="availablesitters" class="row" style=" min-height: 100px;">
			<div class="col">
				<div class="row my-3">
					 <div class="col">
					 	<h1 align="center">Sitters in your area</h1>

					 </div>
				</div>
				<div class="row mb-3 pb-5">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="row">
							<?php 

							foreach ($sitters as $key) :
								$fname= $key->user_fname;
								$lname=$key->user_lname;
								$about1=$key->aboutme;
								$about =substr($about1,0, 70);
								$state=$key->state;
								$rate= $key->ratings;
								$pix=$key->photo;
								if  ((isset($pix) && $pix != '')) {
									$profilepix = 'storage/uploads/'.$pix;
								} else {
									$profilepix = 'storage/female_avatar.png';
								}
		  						
										?>
								<div class='col-md-4 py-3' style='background-color: #FDFFFC'>
									<div class='card card-box' style='width: 18rem; height: 30rem'>
  										<img src='{{asset($profilepix)}}' class='card-img-top' alt='...' width='18rem' height='200'>
 								 			<div class='card-body'>
			 								 	<b><p class='card-text'>{{$fname}} {{$lname}}, {{$state}}</p></b>
			    								<p class='card-text'><i>{{$about}}...Read More</i></p>
			    								<p class='card-text'>
													@if($rate >= 4.5)
		  						<i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i>
		  						@elseif($rate>=3.5)
		  						<i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' ></i>
		  						@elseif($rate>=2.5)
		  						<i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star'></i><i class='fa fa-star' ></i>
		  						@elseif($rate<1.5)
		  						<i class='fa fa-star' style='color: #FFA500; '></i><i class='fa fa-star' ></i><i class='fa fa-star' ></i><i class='fa fa-star'></i><i class='fa fa-star' ></i>
		  						@else
		  						<p></p>
		  						@endif
    											</p>
    											<a href='parents_signup.php'>Contact Me</a>
  											</div>
									</div>
								</div>
							<?php endforeach ?>
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
				<div class="row  mb-3">
					 <div class="col linkdivs" >
					 	<button class="btn beginbtn btn-lg mybuttons" type="button" style="margin-left:35%"><a href="parents_signup.php">VIEW MORE AVAILABLE SITTERS</a></button>
					 </div>
					</div>
			</div>
		</div>
		@endif
@endsection
<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
			
		})
	</script>
	<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
