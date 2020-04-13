@extends('layouts.app')
@section('content')

<?php 
	if (isset($sitter)) {
		$sit=$sitter->toArray();
		foreach ($sit as $key ) {
			$med_status = $key->med_status;
			$ref_status =$key->ref_status;
			$sit_status=$key->appr_status;
			$sitfname=$key->user_fname;
			$sitlname=$key->user_lname;
			$sitavail=$key->availability;
			$sitpix= $key->photo;
			$state=$key->state;
			$abt=$key->aboutme;
			$city=$key->city;
			$id=$key->iduser;
			$dob=$key->dob;
			$exper=$key->sit_exper;
			$r1=$key->rate1;
			$r2=$key->rate2;
			$r3=$key->rate3;
		}
		
	}
	if (isset($sitdays)) {
	 	$sit= $sitdays->toArray();
	}
	if (isset($cgrp)) {
		 $child= $cgrp->toArray();

	}
	if (isset($dob)) {
	$myage=$age->toArray();
	foreach ($myage as $key) {
		$sitage= $key->age;
	}
	if (isset($revs)) {
	$rev=$revs->toArray();
}
}
	
?>
	<div class="row">
			<div class="col">
				<div class="row" >
    				<div class="col-md-3 px-3 py-5" id="sidebar">
    					<div class="row">
		  					<div class="col-md-4">
		  						<?php 
								if  ((isset($sitpix) && $sitpix != '')) {
									$profile = 'storage/uploads/'.$sitpix;
								} else {
									$profile = 'storage/female_avatar.png';
								}
								?>
		  						
		  						<img src="{{asset($profile)}}" alt="profile picture" class="img-fluid rounded-circle">

		  					</div>
		  					<div class="col-md-8">
		  						<?php 
								
								if (($sit_status == 'not approved')||($sit_status == '')) {
									$idstat='';
								}
								else{
									$idstat="<i class='fas fa-user-check' style='font-size: 1rem; '></i>&nbsp;";
								}
								if (($med_status == 'not approved')||($med_status == '')) {
									$medstat='';
								}
								else{
									$medstat="<i class='fas fa-user-nurse' style='font-size: 1rem;'></i>&nbsp;";
								}
								if (($ref_status == 'not approved')||($ref_status == '')) {
									$refstat='';
								}
								else{
									$refstat="<i class='fas fa-id-card-alt' style='font-size: 1rem;'></i>&nbsp;";
								}
								if (($sit_status == 'approved') && ($med_status == 'approved') && ($ref_status == 'approved')){
										echo "<span style='color: green'><b>Verification Complete</b></span><br>".$idstat.$medstat.$refstat;
									}
									elseif ($med_status == 'approved') {
										echo "<span style='color: green'><b>Medically Verified</b></span><br>".$medstat;
									}
									elseif (($sit_status == 'approved') &&($ref_status == 'approved')) {
										echo "<span style='color: green'><b>Identity Verified</b></span><br>".$idstat.$refstat;
									}
									else{
										echo "<span style= 'color:red'>Awaiting Verification</span>";
									}
								?>
								@if(isset($chkrevs) && $chkrevs == 0)
		  					<p>No reviews yet</p>
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
					  			<span><b><?php
                    echo $sitfname." ".$sitlname;
                    ?></b></span>
		  						<br><span> <b><?php if (isset($dob)) {
		  					echo $sitage." yrs old";
		  				} ?> </b></span><p><?php if (isset($exper)) {
													            echo $exper."yrs Experience in Childcare";
													            
													          }
													          ?></p>
					  		</div>
					  	</div>
		  				<div class="row">
		  					<div class="col">
		  						<ul class="nav nav-pills flex-column" id="myTab" role="tablist">
								  <li class="nav-item">
								    <a class="nav-link active" id="bookings-tab" data-toggle="tab" href="#bookings" role="tab" aria-controls="bookings" aria-selected="true">SUMMARY</a>
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
					  				
								  		<div class="row">
											<div class="col pt-2 linkdivs">
												
												@if(isset($abt))<p><b>ABOUT ME</b></p>
											<p>{{$abt}} </p>@endif

											<?php
										  if (isset($child)):?>
										  	<span><b>EXPERIENCED WITH </b></span>
											<?php  foreach ($child as $grp): 
											  	 $chgrp = $grp->childgroup; ?>
											  	 
												  <span>{{$chgrp}}</span> 
											  <?php endforeach ?>
											  <?php endif ?>
											<br>
											<?php
										  if (isset($sit)):?>
										  	<span><b>AVAILABLE ON </b></span>
											  <?php foreach ($sit as $day): 
											  	 $sitday = $day->days; ?>
											  	 
												  <span>{{$sitday}}
												  </span>
											  <?php endforeach ?>
											  <?php endif ?>
											  <p></p>
											  <p><b>PRICE RATES</b></p>
											  <span>One Child: </span>@if(isset($r1) && $r1 != '')<span> N{{$r1}}/Hour</span>@else <span>Not Available</span>@endif<br>
											  <span>Two Children: </span>@if(isset($r2) && $r2 != '')<span> N{{$r2}}/Hour</span>@else <span>Not Available</span>@endif<br>
											  <span>Three Children & above: </span>@if(isset($r3) && $r3 != '')<span> N{{$r3}}/Hour</span>@else <span>Not Available</span>@endif<br><br><br>

												<a href="<?php echo route('parent.book',['sitterid'=>$id])?>" class='btn beginbtn'>BOOK {{$sitfname}}</a>
												
											</div>
										</div>
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
@endsection
<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
			
		})
	</script>
	<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>