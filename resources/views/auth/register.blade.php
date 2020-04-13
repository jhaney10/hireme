@extends('layouts.app')

@section('content')
            <div class="row " >
            <div class="col mysitterpage">
                <div  class="row"  >
                    <div class="col signinform py-3">
                        <div class="row pt-4">
                            <div class="col">
                                <h2 align="center">Join a growing network of Sitters</h2>
                               <!--  <div class="row"><div class="col">{{ isset($url) ? ucwords($url) : ""}}</div></div> -->
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
                        <div class="row pt-4">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-5 ">
                                <p style="font-size: 1.9rem; color:#131515">Are you an experienced sitter looking for jobs that fit into your schedule?</p>
                                            <p style="font-size: 1.5rem;">iCare connects parents to screened and vetted sitters</p>
                                            <p style="font-size: 1.5rem;">Safety of our sitters is also parmount so we ensure the workplace is safe for iCare Sitters</p>
                                             <p style="font-size: 1.8rem;">JOIN US TODAY</p>
                            </div>
                            <div class="col-sm-5">
                                @isset($url)
                                    <form method="POST" action='{{ url("/register/$url") }}' aria-label="{{ __('Register') }}">
                                    @else
                                    <form method="POST" action="{{ url('/register') }}" aria-label="{{ __('Register') }}">
                                    @endisset
                                
                                    @csrf
                                        
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="user_fname" class="form-control @error('user_fname') is-invalid @enderror" id="fname" value="{{ old('user_fname') }}" required autocomplete="user_fname" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="user_lname" class="form-control @error('user_lname') is-invalid @enderror" id="lname" value="{{ old('user_lname') }}" required autocomplete="user_lname" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="sitteremail"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            <span id="chkresponse"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input id="pass1" type="password" class="form-control @error('user_pwd') is-invalid @enderror" name="user_pwd" required autocomplete="new-password">
                                            <span id="chkpwd"></span>                    
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input id="pass2" type="password" class="form-control" name="user_pwd2" required autocomplete="new-password">
                                           
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ old('phone') }}">
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>State of Residence</label>
                                            <select class="form-control" name="state">
                                                <option value='FCT, Abuja'>FCT, Abuja</option>
                                                <option disabled>Others States Available Soon</option>
                                                
                                            </select>
                                         </div>
                                        <div class="form-group">
                                            <label>City</label>
                                            <select class="form-control" name="idcity">
                                                @foreach($city as $c)
                                                    <option value="{{$c->id}}">{{$c->city}}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea type="text" name="user_address" class="form-control @error('user_address') is-invalid @enderror" id="address"
                                            >{{ old('user_address') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            
                                            <input type="hidden" name="usertype" class="form-control" value="sitter">
                                            
                                        </div>
                                        <div class="form-group">
                                            <br><br><button type="submit" class="btn beginbtn btn-block" id="regbtn" >REGISTER</button>
                                        </div>
                                    </form>
                                    
                                        <p align='center'>Already have an account? <a href="{{ route('login') }}">Log In</a></p>
                                    
                                    <hr>
                                    
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection