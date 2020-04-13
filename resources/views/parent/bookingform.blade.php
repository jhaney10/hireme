@extends('layouts.app')
@section('content')
	<div class="row" id="parentlanding">
			<div class="col">
				<div id="bigpar">
					<div class="row" id="childpar">
						<div class="col" id="parintro">
							<p >TELL US YOUR NEEDS... <span><i>Because we care</i></span></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row my-5" id="bookbg">
			<div class="col-md-2"></div>
			<div class="col-md-8 px-5 py-3" id="bookingform">
				<div class="row">
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
						<p style="font-size:1.5rem" align="center">FIND A SITTER</p>
					</div>
				</div>  
				<div class="row">
					<div class="col">
						<a href="{{route('parent.avsitters')}}" style="font-size: 0.8rem">Go Back To View Available Sitters</a>
					</div>
				</div>  
					<hr>
				<div class="row">
					<div class="col">
						<form action="{{route('parent.store')}}" method="POST" id="myform">
							@csrf

							<div class="form-group">
								<p for="sittingtype">LOCATION</p>
								<div class="form-group row">
									<div class="col-md-4">
										<label>State</label>
									</div>
									<div class="col-md-6">
										<select class="form-control" name='state'>
											<option value='FCT'>Federal Capital, Territory, FCT</option>
											<option disabled="disabled">More Locations Coming Soon</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-4">
										<label>City</label>
									</div>
									<div class="col-md-6">
										<select class="form-control" name="city">
												@foreach($city as $town)
												<option value="{{$town->id}}" >{{ $town->city }}</option>
												@endforeach
										</select>
									</div>
								</div>		
								<div class="form-group row">
									<div class="col-md-4">
										<label>Address</label>
									</div>
									<div class="col-md-6">
										<textarea name="address" class="form-control" >{{old('address')}}</textarea>
											
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-4">
										<label>Closest Landmark</label>
									</div>
									<div class="col-md-6">
										<textarea name="landmark" class="form-control" >{{old('landmark')}}</textarea>
											
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-4">
										<label>Phone Number</label>
									</div>
									<div class="col-md-6">
										<input type="text" name="phone" class="form-control" value="{{old('phone')}}">
											
									</div>
								</div>
									<!-- <div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Remember Location" name="location">
										  <label class="form-check-label" for="inlineCheckbox1">Remember my location details</label>
									</div> -->
									<hr>				
							</div>
							<div class="form-group row">
								<div class="col">
									<p for="sittingtype">SCHEDULE BOOKING</p>
								    <p>How Soon Do You Need A Sitter?</p>
								    <select class="form-control" name="sittingtype">
									    <option value="urgent">Now</option>
									    <option value="later">Schedule for a particular date</option>
									    <option value="repeat">Repeat Cycle</option>
    								</select>
								</div>
 							</div>
 								<div class="form-group">
								    <div class="form-group row" hidden="hidden">
										<!-- <div class="col-md-3">
											<p>Days</p>
										</div> -->
										<!-- <div class="col-md-7">
											<div class="form-check form-check-inline">
											  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Sunday" name="days">
											  <label class="form-check-label" for="inlineCheckbox1">Sun</label>
										</div>
										<div class="form-check form-check-inline">
											  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Monday">
											  <label class="form-check-label" for="inlineCheckbox2">Mon</label>
										</div>
										<div class="form-check form-check-inline">
											  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="Tuesday">
											  <label class="form-check-label" for="inlineCheckbox3">Tue</label>
										</div>
										<div class="form-check form-check-inline">
											  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Wednesday">
											  <label class="form-check-label" for="inlineCheckbox2">Wed</label>
										</div>
										<div class="form-check form-check-inline">
											  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="Thursday">
											  <label class="form-check-label" for="inlineCheckbox3">Thur</label>
										</div>
										<div class="form-check form-check-inline">
											  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="Friday">
											  <label class="form-check-label" for="inlineCheckbox3">Fri</label>
										</div>
										<div class="form-check form-check-inline">
											  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Saturday">
											  <label class="form-check-label" for="inlineCheckbox2">Sat</label>
										</div>
										</div> -->
										  
									</div>
								   
								<div class="form-group row">
										<div class="col-md-4">
											<p>Start Date</p>
										</div>
										<div class="col-md-6">
											<input class="form-control" type="date"  name="startdate" value="{{old('startdate')}}">
										</div>
										  
								</div>
								<div class="form-group row">
										<div class="col-md-4">
											<p>Start Time</p>
										</div>
										<div class="col-md-6">
											<input type="time" name="starttime" placeholder="" class="form-control" value="{{old('starttime')}}">
											
										</div>
										  
								</div>
    								<div class="form-group row">
										<div class="col-md-4">
											<p>Number of Hours</p>
										</div>
										<div class="col-md-6">
											<select class="form-control" id="sittingtype" name="hours">
											    <option value="1">1</option>
											    <option value="2">2</option>
											    <option value="3">3</option>
											    <option value="4">4</option>
											    <option value="5">5</option>
											    <option value="6">6</option>
											    <option value="7">7</option>
											    <option value="8">8</option>
											    <option value="9">9</option>
											    <option value="10">10</option>
											    <option value="11">11</option>
											    <option value="12">12</option>
		    								</select>
									  	</div>
									</div>
									<hr>
 								</div>
 								<div class="form-group">
								    <p for="sittingtype">TELL US ABOUT YOUR KIDS AND THEIR NEEDS</p>
								    <div class="form-group row">
										<div class="col-md-4">
											<p>Number of Children</p>
										</div>
										<div class="col-md-6">
											<select class="form-control" name="numchildren">
											   
											    <option value="1">1</option>
											    <option value="2">2</option>
											    <option value="3+">3+</option>
		    								</select>	
										</div> 
									</div>
								    
								    
 								</div>
 								<div class="form-group">
								    <p for="sittingtype">YOUR CHILDREN'S AGE GROUP</p>
								    <p>Information on the age of your kids would help your sitter </p>
								    <div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="inlineCheckbox10" value="Infant" name="childgrp[]">
										  <label class="form-check-label" for="inlineCheckbox10">Infant(1mth - 11mths)</label>
									</div>
									<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="inlineCheckbox20" value="Toddler" name="childgrp[]">
										  <label class="form-check-label" for="inlineCheckbox20">Toddler(1yr - 2yrs)</label>
									</div>
									<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="inlineCheckbox30" value="Preschooler" name="childgrp[]">
										  <label class="form-check-label" for="inlineCheckbox30">Preschool(3yrs - 5yrs)</label>
									</div>
									<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="inlineCheckbox29" value="Gradeschooler" name="childgrp[]">
										  <label class="form-check-label" for="inlineCheckbox29">School-Aged(6yrs - 12yrs)</label>
									</div>
									<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="inlineCheckbox39" value="Teen" name="childgrp[]">
										  <label class="form-check-label" for="inlineCheckbox39">Adolescent(13yrs - 17yrs)</label>
									</div>
								    
    								<hr>
 								</div>
 								 
								<div class="form-group">
								    <p for="sittingtype">ADDITIONAL DUTIES</p>
								    <p>Would you be needing your sitter to assist you with other chores? If Yes, Please Specify</p>
								    <div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="inlinebox1" value="Cooking" name="adduties[]">
										  <label class="form-check-label" for="inlinebox1">Cooking</label>
									</div>
									<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="inlinebox2" value="Homework Help" name="adduties[]">
										  <label class="form-check-label" for="inlinebox2">Homework-Help</label>
									</div>
									<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="inlinebox3" value="Laundry" name="adduties[]">
										  <label class="form-check-label" for="inlinebox3">Laundry</label>
									</div>
									<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="inlinebox4" value="Shopping" name="adduties[]">
										  <label class="form-check-label" for="inlinebox4">Shopping</label>
									</div>
									<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" id="inlinebox5" value="Housekeeping" name="adduties[]">
										  <label class="form-check-label" for="inlinebox5">House Cleaning</label>
									</div>
								    
    								
 								</div>
 								<div class="form-group row">
										<div class="col-md-4">
											<p>SPECIAL INSTRUCTIONS</p>
										</div>
										<div class="col-md-8">
											<textarea class="form-control" name="otherinstruct">{{old('otherinstruct')}}</textarea>
										</div> 
										
								</div>
								<div class="form-group row">
										<div class="col-md-4">
										</div>
										<div class="col-md-8">
											<span style="font-size: 0.8rem"><i>*Describe specific requirements for your sitter like 'Years of experience with kids, educational qualification, etc' or other necessary info. </i></span>
											<p style="font-size: 0.8rem"><i>Provide more details about your kids like'nicknames, special needs, nap time, etc.</i></p>
										</div> 
									<hr>	
								</div>
								<div class="form-group row">
									<div class="col-md-10">
										<p>By clicking the button below you are agreeing to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a> </p>
									</div>
									<hr>
										
										
								</div>

								<div class="form-group row">
									<div class="col-md-5">
										<input type="hidden" name="sitterid" value="{{$id}}">
									</div>
									<div class="col-md-5">
										<button class=" btn beginbtn btn-lg" type="submit" id="booknow">BOOK NOW</button>
									</div>	
										
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-2"></div>
		</div>

@endsection
<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
			
		})
	</script>
	<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>