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

}
}

if (isset($sitid)) {
	foreach ($sitid->toArray() as $id) {
	$idmeans =$id->means;
	$idnum=$id->idnum;
	$idexp=$id->idexpire;
}
}
if (isset($refid)) {
	foreach ($refid->toArray() as $idref) {
	$idrefmeans =$idref->means;
	$idrefnum=$idref->idnum;
	$idrefexp=$idref->idexpire;
}
}

if (isset($sitday)) {
	 $sit= $sitday->toArray();
}
if (isset($cgrp)) {
	 $child= $cgrp->toArray();

}
?>



		<div class="row my-5">
				
			<div class="col" >
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
				<form class="form-group row" action="{{route('sitter.store')}}" method="POST" enctype="multipart/form-data">
					@csrf
					
				
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-3">
						
						<?php 
						if  ((isset($pix) && $pix != '')) {
							$profile = 'storage/uploads/'.$pix;
						} else {
							$profile = 'storage/female_avatar.png';
						}
						?>
						<img src="{{asset($profile)}}"  width="150" height="150" class="rounded-circle">
						<br><br>&nbsp;
						<div class="file btn btn-md beginbtn filediv" >
							Upload Image
							<input type="file" name="picture" class="fileinput" />
						</div>
					</div>
					<div class="col-md-5">
						<span>Set Availability</span>
						
							<div class="form-check form-check-inline">
								<label class="form-check-label" for="inlineCheckbox1"><b>Available</b></label>&nbsp; &nbsp;
							    <input class="form-check-input" type="radio" id="inlineCheckbox1" value="available" name='avail' 
							    <?php 
										
										if (isset($avail) && $avail == 'available'): ?>
											checked='checked'
										<?php endif ?>
							    > &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
								<label class="form-check-label" for="inlineCheckbox2"><b>Available Later</b></label>&nbsp; &nbsp;
								<input class="form-check-input" type="radio" id="inlineCheckbox2" value="not available" name="avail" 
										<?php 
										if ((isset($avail) && $avail == 'not available')||(!isset($avail))) : ?>
											checked='checked'
										<?php endif ?>>
							</div>
						
						
					</div>
					
					<div class="col-md-4">
						<button class="btn beginbtn" type="submit">Save Changes</button>
					</div>
					<!-- <div class="col-md-2">
						<button class="btn beginbtn" type="button">Edit Profile</button>
					</div> -->
					
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<!-- <form> -->
							<div class="form-group row">
								<div class="col-md-4">
									<label>First Name</label>
									<input type="text" name="fname" class="form-control" readonly="readonly" value= "{{ $fname }}">
								</div>
								<div class="col-md-4">
									<label>Last Name</label>
									<input type="text" name="lname" class="form-control" readonly="readonly" value= "{{ $lname }}">
								</div>
								<div class="col-md-4">
									<label>Gender</label>
									<select class="form-control" name="gender">
										<option value="male" 
										<?php 
										if (isset($gend) && $gend == 'male'): ?>
											selected='selected'
										<?php endif ?>
										>Male</option>
										<option value="female"
										<?php 
										if (isset($gend) && $gend == 'female'): ?>
											selected='selected'
										<?php endif ?>
										>Female</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								
								<div class="col-md-4">
									<label>Date of Birth</label>
									<input type="date" name="dob" value="<?php if (isset($dob)): 
										echo($dob);
									 endif ?>" placeholder="" class="form-control">
								</div>
								<div class="col-md-4">
									<label>Marital Status</label>
									<select class="form-control" name="marstatus">
												<option value="Single" 
												<?php 
										
										if (isset($mar) && $mar == 'single'): ?>
											selected='selected'
										<?php endif ?>>Single</option>
												<option value="Married" <?php 
										
										if (isset($mar) && $mar == 'married'): ?>
											selected='selected'
										<?php endif ?>>Married</option>
											</select>
								</div>
								<div class="col-md-4">
									<label>Highest Educational Qualification</label>
									<select class="form-control" name="edu">
										
										<option value="Primary" 
										<?php 
										
										if (isset($edu) && $edu == 'Primary'): ?>
											selected='selected'
										<?php endif ?>>Primary School Certificate</option>
										<option value="SSCE" <?php 
										
										if (isset($edu) && $edu == 'SSCE'): ?>
											selected='selected'
										<?php endif ?>>Secondary School Certificate</option>
										<option value="Tertiary" <?php 
										
										if (isset($edu) && $edu == 'Tertiary'): ?>
											selected='selected'
										<?php endif ?>>Post-Secondary School Certificate</option>
										<option value="Others" <?php 
										
										if (isset($edu) && $edu == 'Others'): ?>
											selected='selected'
										<?php endif ?>>Others</option>
										
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-4">
									<label>Means of Identification <span class="badge badge-danger badge-pill">?</span></label>
									<select class="form-control" name="identify">
												<option value="voters" <?php 
										
										if (isset($idmeans) && $idmeans == 'voters'): ?>
											selected='selected'
										<?php endif ?>>Voters' Card</option>
												<option value="natidcard" <?php 
										
										if (isset($idmeans) && $idmeans == 'natidcard'): ?>
											selected='selected'
										<?php endif ?>>National ID Card</option>
												<option value="driverlic" <?php 
										
										if (isset($idmeans) && $idmeans == 'driverlic'): ?>
											selected='selected'
										<?php endif ?>>Drivers' License</option>
												<option value="intlpass" <?php 
										
										if (isset($idmeans) && $idmeans == 'intlpass'): ?>
											selected='selected'
										<?php endif ?>>International Passport</option>
											</select>
								</div>
								<div class="col-md-4">
									<label>ID Number </label>
									<input type="text" class="form-control" name="idnumber" value="<?php if (isset($idnum)): 
										echo($idnum);
									 endif ?>">
								</div>
								<div class="col-md-4">
									<label>ID Expiration Date</label>
									<input type="date" name="expdate" value="<?php if (isset($idexp)): 
										echo($idexp);
									 endif ?>" placeholder="" class="form-control">
								</div>
							</div>
							<div class="form-group row">
								
								<div class="col-md-2">
									<p> Set Days Available</p>
								</div>
								<div class="col-md-7">
										<div class="form-check form-check-inline">
											  <input class="form-check-input" type="checkbox" id="inlinebox1" value="Sundays" name="days[]" <?php
											 if (isset($sit)):
											  foreach ($sit as $day): ?>
											  	<?php $sitday = $day->days;
												  if (isset($sitday) && $sitday == 'Sundays'): ?>
												  	checked 
												  <?php endif ?>
											  <?php endforeach ?>
											  <?php endif ?>>
											  <label class="form-check-label" for="inlinebox1">Sun</label>
										</div>
										<div class="form-check form-check-inline">
											  <input class="form-check-input" type="checkbox" id="inlinebox2" value="Mondays" name="days[]" <?php if (isset($sit)):
											  foreach ($sit as $day): ?>
											  	<?php $sitday = $day->days;
												  if (isset($sitday) && $sitday == 'Mondays'): ?>
												  	checked 
												  <?php endif ?>
											  <?php endforeach ?>
											   <?php endif ?>>
											  <label class="form-check-label" for="inlinebox2">Mon</label>
										</div>
										<div class="form-check form-check-inline">
											  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="Tuesdays" name="days[]" <?php if (isset($sit)):
											  foreach ($sit as $day): ?>
											  	<?php $sitday = $day->days;
												  if (isset($sitday) && $sitday == 'Tuesdays'): ?>
												  	checked="checked" 
												  <?php endif ?>
											  <?php endforeach ?>
											  <?php endif ?>>
											  <label class="form-check-label" for="inlineCheckbox3" 
											  >Tue</label>
										</div>
										<div class="form-check form-check-inline">
											  <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="Wednesdays" name="days[]" <?php if (isset($sit)):
											  foreach ($sit as $day): ?>
											  	<?php $sitday = $day->days;
												  if (isset($sitday) && $sitday == 'Wednesdays'): ?>
												  	checked 
												  <?php endif ?>
											  <?php endforeach ?>
											  <?php endif ?>>
											  <label class="form-check-label" for="inlineCheckbox4">Wed</label>
										</div>
										<div class="form-check form-check-inline">
											  <input class="form-check-input" type="checkbox" id="inlineCheckbox5" value="Thursdays" name="days[]" <?php if (isset($sit)):
											  foreach ($sit as $day): ?>
											  	<?php $sitday = $day->days;
												  if (isset($sitday) && $sitday == 'Thursdays'): ?>
												  	checked 
												  <?php endif ?>
											  <?php endforeach ?>
											  <?php endif ?>>
											  <label class="form-check-label" for="inlineCheckbox5">Thur</label>
										</div>
										<div class="form-check form-check-inline">
											  <input class="form-check-input" type="checkbox" id="inlineCheckbox6" value="Fridays" name="days[]" <?php if (isset($sit)):
											  foreach ($sit as $day): ?>
											  	<?php $sitday = $day->days;
												  if (isset($sitday) && $sitday == 'Fridays'): ?>
												  	checked 
												  <?php endif ?>
											  <?php endforeach ?>
											  <?php endif ?>>
											  <label class="form-check-label" for="inlineCheckbox6">Fri</label>
										</div>
										<div class="form-check form-check-inline">
											  <input class="form-check-input" type="checkbox" id="inlineCheckbox7" value="Saturdays" name="days[]" <?php if (isset($sit)):
											  foreach ($sit as $day): ?>
											  	<?php $sitday = $day->days;
												  if (isset($sitday) && $sitday == 'Saturdays'): ?>
												  	checked 
												  <?php endif ?>
											  <?php endforeach ?>
											  <?php endif ?>>
											  <label class="form-check-label" for="inlineCheckbox7">Sat</label>
										</div>
								</div>
							</div>
							<hr>
							<div class="form-group row">
								<div class="col-md-3">
									<label>Years of Experience with children</label>
									<select class="form-control" name="experience">
												<option value="0" 
												<?php 
										
										if (isset($exp) && $exp == '0'): ?>
											selected='selected'
										<?php endif ?>>0</option>
												<option value="1" 
												<?php 
										if (isset($exp) && $exp == '1'): ?>
											selected='selected'
										<?php endif ?>>1</option>
												<option value="2" 
												<?php 
										if (isset($exp) && $exp == '2'): ?>
											selected='selected'
										<?php endif ?>>2</option>
												<option value="3" 
												<?php 
										if (isset($exp) && $exp == '3'): ?>
											selected='selected'
										<?php endif ?>>3</option>
												<option value="4" 
												<?php 
										if (isset($exp) && $exp == '4'): ?>
											selected='selected'
										<?php endif ?>>4</option>
												<option value="5+" 
												<?php 
										if (isset($exp) && $exp == '5+'): ?>
											selected='selected'
										<?php endif ?>>5+</option>
											</select>
								</div>
								<div class="col-md-2">
									<p> Select Age Group of Children You Are Interested In</p>
								</div>
								<div class="col-md-7">
								    <div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="inlineCheckbox8" value="Infants" name="childgrp[]" 
										  <?php
										  if (isset($child)):
											  foreach ($child as $grp): ?>
											  	<?php $chgrp = $grp->childgroup;
												  if (isset($chgrp) && $chgrp == 'Infants'): ?>
												  	checked 
												  <?php endif ?>
											  <?php endforeach ?>
											  <?php endif ?>>
										  <label class="form-check-label" for="inlineCheckbox8">Infant(1mth - 11mths)</label>
									</div>
									<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="inlineCheckbox9" value="Toddlers" name="childgrp[]"
										   <?php
										   if (isset($child)):
											  foreach ($child as $grp): ?>
											  	<?php $chgrp = $grp->childgroup;
												  if (isset($chgrp) && $chgrp == 'Toddlers'): ?>
												  	checked 
												  <?php endif ?>
											  <?php endforeach ?>
											  <?php endif ?>>
										  <label class="form-check-label" for="inlineCheckbox9">Toddler(1yr - 2yrs)</label>
									</div>
									<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="inlineCheckbox10" value="Preschoolers" name="childgrp[]"
										   <?php
										   	if (isset($child)):
											  foreach ($child as $grp): ?>
											  	<?php $chgrp = $grp->childgroup;
												  if (isset($chgrp) && $chgrp == 'Preschoolers'): ?>
												  	checked 
												  <?php endif ?>
											  <?php endforeach ?>
											  <?php endif ?>>
										  <label class="form-check-label" for="inlineCheckbox10">Preschool(3yrs - 5yrs)</label>
									</div>
									<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="inlineCheckbox11" value="Grade-Schoolers" name="childgrp[]"
										  <?php
										  	if (isset($child)):
											  foreach ($child as $grp): ?>
											  	<?php $chgrp = $grp->childgroup;
												  if (isset($chgrp) && $chgrp == 'Grade-Schoolers'): ?>
												  	checked 
												  <?php endif ?>
											  <?php endforeach ?>
											  <?php endif ?> >
										  <label class="form-check-label" for="inlineCheckbox11">School-Aged(6yrs - 12yrs)</label>
									</div>
									<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="inlineCheckbox13" value="Adolescents" name="childgrp[]" 
										   <?php
										   if (isset($child)):
											  foreach ($child as $grp): ?>
											  	<?php $chgrp = $grp->childgroup;
												  if (isset($chgrp) && $chgrp == 'Adolescents'): ?>
												  	checked 
												  <?php endif ?>
											  <?php endforeach ?>
											  <?php endif ?> >
										  <label class="form-check-label" for="inlineCheckbox13">Adolescent(13yrs - 17yrs)</label>
									</div>
 								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<p>SET YOUR RATES</p>
									<span><i>*Kindly adhere to max rates rules</i></span>
								</div>
								<div class="col-md-3">
									<i class="fas fa-child"></i>&nbsp;<span><b>Max Rate: N500/hr</b></span>
									<input type="number" class="form-control" name="rate1" id="rate1" value="<?php if (isset($r1)): 
										echo($r1);
									 endif ?>"><span id="note1"></span>
								</div>
								<div class="col-md-3">
									<i class="fas fa-child"></i><i class="fas fa-child"></i>&nbsp;<span><b>Max Rate: N700/hr</b></span>
									<input type="number" class="form-control" name="rate2" id='rate2' value="<?php if (isset($r2)): 
										echo($r2);
									 endif ?>"><span id="note2"></span>
								</div>
								<div class="col-md-3">
									<i class="fas fa-child"></i><i class="fas fa-child"></i><i class="fas fa-child"></i><span>+</span>&nbsp;<span><b>Max Rate: N900/hr</b></span>
									<input type="number" class="form-control" name="rate3+" id="rate3" value="<?php if (isset($r3)): 
										echo($r3);
									 endif ?>"><span id="note3"></span>
								</div>
							</div>
							<hr>
							<div class="form-group row">
								<div class="col-md-2">
									<p>ABOUT YOURSELF</p>
								</div>
								<div class="col-md-5">
									<textarea name="aboutme" class="form-control"
													          ?><?php if (isset($abt)): 
										echo($abt);
									 endif ?></textarea>
								</div>
								<div class="col-md-5">
									<span style="font-size: 0.8rem"><i>*Describe yourself stating your availability options for babysitting and other duties such as house chores. Provide information on your years of experience with kids and the age group you preferably like to cater to.</i></span>
								</div>
							</div><hr>
							<div class="form-group row">
										<div class="col-md-7">
											
												<p>Are you willing to undergo medical check-up to attain the Medically Checked Status?</p>
										</div>
										<div class="col-md-4">
											<div class="form-check form-check-inline">
												<label class="form-check-label" for="Checkbox100"><b>Yes</b></label>&nbsp; &nbsp;

											    <input class="form-check-input" type="radio" id="Checkbox100" value="available" name="medic"  <?php 
										
										if (isset($availa) && $availa == 'available'): ?>
											checked='checked'
										<?php endif ?>> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
												<label class="form-check-label" for="Checkbox200"><b>No</b></label>&nbsp; &nbsp;
												<input class="form-check-input" type="radio" id="Checkbox200" value="not available" name="medic"  <?php 
										if ((isset($availa) && $availa == 'not available')||(!isset($availa))) : ?>
											checked='checked'
										<?php endif ?>>
											</div>
											
										</div>
											
							</div>
							<hr>
							<div class="form-group">
								<div class="row">
									<div class="col">
										<label>REFERENCE DETAILS <span class="badge badge-danger badge-pill">?</span></label>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										
										<input type="text" name="reffname" class="form-control" placeholder="First Name" value="<?php if (isset($reffname)): 
										echo($reffname);
										 endif ?>">
									</div>
									<div class="col-md-4">
										
										<input type="text" name="reflname" class="form-control" placeholder="Last Name" value="<?php if (isset($reflname)): 
										echo($reflname);
									 endif ?>">
									</div>
									<div class="col-md-4">
										
										<input type="text" name="refphone" class="form-control" placeholder="Phone Number" value="<?php if (isset($refphone)): 
										echo($refphone);
									 endif ?>">
									</div>
								</div>
								
							</div>
							<div class="form-group row">
										<div class="col-md-4">
											<label>Address</label>
											<textarea name="refaddy" class="form-control"  placeholder="Street Address" ><?php if (isset($refad)): 
										echo($refad);
									 endif ?></textarea>
										</div>
										
										<div class="col-md-4">
											
											<label>City</label>
											<select class="form-control" name="idcity">
												@foreach($city as $town)
												<option value="{{$town->id}}" 
													<?php 
										$cit =$town->id;
										if (isset($city1) && $city1 == $cit): ?>
											selected='selected'
										<?php endif ?>>{{ $town->city }}</option>
												@endforeach
											</select>
										</div>
										<div class="col-md-4">
											<label>State</label>
											<select class="form-control" name="state">
												<option value="State">State</option>
												<option value="FCT" <?php 
										
										if (isset($refstate) && $refstate == 'FCT'): ?>
											selected='selected'
										<?php endif ?>>Federal Capital, Territory, FCT</option>
											</select>
										</div>

							</div>
							<div class="form-group row">
								<div class="col-md-4">
									<label>Means of Identification <span class="badge badge-danger badge-pill">?</span></label>
									<select class="form-control" name="refmeans">
												<option value="voters" 
												<?php 
										if (isset($idrefmeans) && $idrefmeans == 'voters'): ?>
											selected='selected'
										<?php endif ?>>Voters' Card</option>
												<option value="natidcard"
												<?php 
										
										if (isset($idrefmeans) && $idrefmeans == 'natidcard'): ?>
											selected='selected'
										<?php endif ?>>National ID Card</option>
												<option value="driverlic"
												<?php 
										
										if (isset($idrefmeans) && $idrefmeans == 'driverlic'): ?>
											selected='selected'
										<?php endif ?>>Drivers' License</option>
												<option value="intlpass" 
												<?php 
										
										if (isset($idrefmeans) && $idrefmeans == 'intlpass'): ?>
											selected='selected'
										<?php endif ?>>International Passport</option>
											</select>
								</div>
								<div class="col-md-4">
									<label>ID Number </label>
									<input type="text" name="refidnum" class="form-control" value="<?php if (isset($idrefnum)): 
										echo($idrefnum);
									 endif ?>">
								</div>
								<div class="col-md-4">
									<label>ID Expiration Date</label>
									<input type="date" name="refidexp" value="<?php if (isset($idrefexp)): 
										echo($idrefexp);
									 endif ?>" placeholder="" class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<div class="col">
									<input type="hidden" name="userid" value="{{ $userid }}">
								</div>
							</div>
							
							
						<!-- </form> -->
					</div>
				</div>
				
			</div>
			
			<div class="col-md-1"></div>
			</form>
		</div>	
	</div>
	
	
	<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
			
		})
	</script>
	<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>


@endsection

