@extends('layouts.app')

@section('content')
	<div class="row" >
			<div class="col" id="par-page">
					<div class="row">
						<div class="col  signinform">
							<div class="row">
								<div class="col pt-4">
									<h2 align="center">iCare helps parents meet reliable and trustworthy Sitters</h2>
									@if ($errors->any())
	                                <div class="alert alert-danger">
	                                        @foreach ($errors->all() as $error)
	                                            {{ $error }}<br>
	                                        @endforeach
	                                </div>
	                                @endif
	                                               
	                                @if (session('status'))
	                                    <div class="alert alert-success" role="alert">
	                                        {{ session('status') }}
	                                    </div>
	                                @endif
									</div>
							</div>
							<div class="row mt-5">
								<div class="col-md-1"></div>
								<div class="col-md-5 ">
									<div class="row ml-5 mt-5">
										<div class="col-md-4">
											<i class="fas fa-user myicons" style="font-size: 50px;"></i>
										</div>
										<div class="col-md-5">
											<p><b>Register</b></p>
											<p>Provide basic information</p>
										</div>
									
									</div>
									<div class="row ml-5 mt-5">
										<div class="col-md-4">
											<i class="fas fa-list myicons" style="font-size: 50px;"></i>
										</div>
										<div class="col-md-5">
											<p><b>Tell us your needs</b></p>
											<p>Provide basic information</p>
										</div>
									
									</div>
									<div class="row ml-5 mt-5">
										<div class="col-md-4">
											<i class="fas fa-users myicons" style="font-size: 50px;"></i>
										</div>
										<div class="col-md-5">
											<p><b>See available sitters</b></p>
											<p>Build your network of trusted sitters</p>
										</div>
									
									</div>
								</div>
								<div class="col-md-4">
									@isset($url)
                                    <form method="POST" action='{{ url("/register/$url") }}' aria-label="{{ __('Register') }}">
                                    @else
                                    <form method="POST" action="{{ url('/register') }}" aria-label="{{ __('Register') }}">
                                    @endisset
										@csrf

										<div class="form-group">
											<label>First Name</label>
											<input type="text" name="user_fname" class="form-control @error('user_fname') is-invalid @enderror" id="fname" value="{{ old('user_fname') }}">
										</div>
										<div class="form-group">
											<label>Last Name</label>
											<input type="text" name="user_lname" class="form-control @error('user_lname') is-invalid @enderror" id="lname" value="{{ old('user_lname') }}">
										</div>
										<div class="form-group">
											<label>Phone Number</label>
											<input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"  id="phone" value="{{ old('phone') }}">
										</div>
										<div class="form-group">
											<label>State of Residence</label>
											<select class="form-control" name="state">
												<option value="FCT">FCT, Abuja</option>
												<option disabled>Others States Available Soon</option>
												
											</select>
										</div>
										
										<div class="form-group">
											<label>Email</label>
											<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="parentemail" value="{{ old('email') }}">
											<span id="chkresponse"></span>
										</div>
										<div class="form-group">
											<label>Password</label>
											<input type="password" name="user_pwd" class="form-control @error('user_pwd') is-invalid @enderror" id="pass1">
							
										</div>
										<div class="form-group">
											<label>Confirm Password</label>
											<input type="password" name="user_pwd1" class="form-control @error('user_pwd1') is-invalid @enderror" id="pass2">
											
										</div>
										<div class="form-group">
											
											<input type="hidden" name="usertype" class="form-control" value="parent">
											
										</div>
										
										<div class="form-group" >
											<br><br><button type="submit" class="btn beginbtn btn-block" id="regbtn">CONTINUE</button>
										</div>
									</form>
									<p align='center'>Already have an account? <a href="{{ route('login') }}">Log In</a></p>
									<hr>
								</div>
								<div class="col-md-2"></div>
							</div>
									
						</div>
					</div>
			</div>
		</div>

@endsection