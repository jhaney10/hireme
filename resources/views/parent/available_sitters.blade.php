@extends('layouts.app')
@section('content')
<?php 
	if (isset($avail)) {
		$av=$avail->toArray();
	}
	
?>
	<div id="page-body" class="row">
			<div class="col">
		<div class="row">
			<div class="col mt-3">
				<p align="center" style="font-size: 1.8rem" id="mylist">
				@if(isset($numav))
				{{$numav}} iCare Sitters
				@else
				No Available Sitter
				@endif</p>
			</div>
		</div>
		<div class="row my-5">
			<div class="col-md-1"></div>
			<div class="col-md-4 mr-4 sitters-list" id="search-form">
				<div class="row">
					<div class="col ">
						<p align="center" style="font-size: 1.5rem"><b>Search For Sitters</b></p>
					</div>
				</div>

				<div class="row">
					<div class="col mt-2">
						<form id="myform">
							@csrf
							<div class="form-group row justify-content-center">
								<!-- <div class="col"> -->
									<button class="btn beginbtn btn-md" type="submit" id="searchsitters">SEARCH</button>
								<!-- </div> -->
							</div>
							<div class="form-group row">
								<div class="col">
									<label>STATE</label>
									<select class="form-control" id="states" name="state">
												<option value="FCT">Federal Capital Territory, FCT</option>
												<option disabled>Lagos</option>
												<option disabled>Port Harcourt</option>
												<option disabled>Kano</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col">
									<label>LOCATION</label>
									<select class="form-control" name="location" id="location">
												@foreach($city as $town)
												<option value="{{$town->id}}" >{{ $town->city }}</option>
												@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col">
									<p>AGE GROUP</p>
									<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="infant" value="Infants" name="childgrp">
										  <label class="form-check-label" for="infant">Infant(1mth - 11mths)</label>
									</div>
									<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="toddler" value="Toddlers" name="childgrp">
										  <label class="form-check-label" for="toddler">Toddler(1yr - 2yrs)</label>
									</div>
									<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="preschool" value="Preschoolers" name="childgrp">
										  <label class="form-check-label" for="preschool">Preschool(3yrs - 5yrs)</label>
									</div>
									<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="school" value="Grade Schoolers" name="childgrp">
										  <label class="form-check-label" for="school">School-Aged(6yrs - 12yrs)</label>
									</div>
									<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="adole" value="Adolescents" name="childgrp">
										  <label class="form-check-label" for="adole">Adolescent(13yrs - 17yrs)</label>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>

			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12" id="header">
						
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" id="results">
						
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" id="avail">
						@if(isset($av))
							<?php 
								foreach ($av as $key ):
									$med_status = $key->med_status;
									$ref_status =$key->ref_status;
									$sit_status=$key->appr_status;
									$sitfname=$key->user_fname;
									$sitlname=$key->user_lname;
									$sitavail=$key->availability;
									$sitpix= $key->photo;
									$state=$key->state;
									$abt=$key->aboutme;
									$abtme=substr($abt,0, 150);
									$city=$key->city;
									$id=$key->iduser;

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
								
							?>
								<a href="<?php echo route('parent.sitsummary',['sitterid'=>$id]);?>" style='text-decoration: none;color: #131515;' title='Click to View More Details' >
						<div class='row sitters-list py-3 px-3'>
							
							<div class='col-md-2'>
								<div class='row'>
									<div class='col'>
										<?php 
											if  ((isset($sitpix) && $sitpix != '')) {
									$profile = 'storage/uploads/'.$sitpix;
								} else {
									$profile = 'storage/female_avatar.png';
								}
										?>
						<img src="{{asset($profile)}}" class='img-fluid rounded-circle' width= '100' height='150'>
								</div>
								</div>
								<div class='row mt-3'>
									<div class='col'>
										<i class="@if(isset($idstat)) {{ $idstat ?? '' }}  @endif" style='font-size: 1rem;'></i>&nbsp;
										<i class="@if(isset($medstat)) {{ $medstat ?? '' }}  @endif" style='font-size: 1rem;'></i>&nbsp;
										<i class="@if(isset($refstat)) {{ $refstat ?? '' }}  @endif" style='font-size: 1rem;'></i>&nbsp;
										
									</div>
								</div>
							</div>
							<div class='col-md-10'>
								<div class='row'>
									<div class='col-md-8'>
										<span class='sitter-name'>@if(isset($sitfname)) {{$sitfname}} {{$sitlname}} @endif</span><p><span>@if(isset($city)) {{$city}}, @endif</span><span>{{$state}}</span></p>
											
										
										
									</div>
									<div class='col-md-4'>
										<p class='avail'>@if(isset($sitavail)) @if($sitavail == 'available') AVAILABLE @else AVAILABLE LATER @endif @endif</p>
										<span style= 'color:{{$color}}'><i>@if(isset($status)) {{$status}}  @endif</i></span>
										<i class="@if(isset($icon)) {{ $icon ?? '' }}  @endif"></i>
									</div>
								</div>
								<div class='row mt-2' >
									<div class='col'>
										<p>{{$abtme}}<i><b>... Click to View More</b></i></p>
									</div>
								</div>
								
							</div>
							
						</div>
						</a>
						<hr>
						<?php endforeach ?>
						@endif
							
					</div>
				
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
		</div>
		</div>
@endsection
<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#searchsitters').click(function(){
				event.preventDefault();
				

				var state = $('#states').val();
				var city  = $('#location').val();
				var agegrp = []; 
            	$("input[name=childgrp]:checked").each(function() { 
                agegrp.push($(this).val()) 
            }); 
           
            	$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
					},
            	});
        		
        		$.ajax({
        			url: '/availablesitters',
        			type: 'post',
        			data: {"_token":"{{ csrf_token() }}",state:state,childgrp:agegrp,location:city},
        			success:function(msg){
        				var sit= $('#avail').html();
        				var heading=$('#mylist').html();
        				$('#mylist').html('Your Search Results');
        				$('#avail').hide(sit);

						$('#results').append(msg);
						console.log(msg);
						
						
        			},
        			error:function(err){
        				console.log(err);
        			}

        		})


			})
			
		})
	</script>
	<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>