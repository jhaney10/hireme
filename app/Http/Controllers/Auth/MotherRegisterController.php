<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class MotherRegisterController extends Controller
{
    public function signup(){
    	$city = DB::table('city')->get();

        return view('parentsignup', ['city' => $city, 'url' => 'parent']);
    }

   
    public function register(Request $request)
    {

       //Validates data
        $this->validator($request->all())->validate();

       //Create parent
        $parent = $this->create($request->all());

         Auth::login($parent,true);
         session(['usertype'=>'parent']);
        return redirect()->intended('/sitters');
    }

    protected function validator(array $data)
    {   
        $messages= [
            'phone.min' => 'Please enter a valid phone number of 11-digits',
            'phone.max' => 'Please enter a valid phone number of 11-digits',
            'user_pwd.required'  => 'Please enter a strong password',
            'user_pwd1.same'=>'Passwords do not match',
            'user_pwd1.required'=> 'Please confirm your password',
            'user_pwd.min'=>'Password must contain a minimum of 8 characters',
            'user_pwd.different'=> 'Password must not be same with email address',
        ];
        return Validator::make($data, [
           'user_fname' => ['required','string','max:255'],
            'user_lname' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users'],
            'user_pwd' => ['required','string','min:8', 'different:email'],
            'user_pwd1'=> ['required','same:user_pwd'],
            'phone' => ['required','string','min:11', 'max:11'],
        ], $messages);
    }

    protected function create(array $data)
    {
        return User::create([
            'user_fname' => $data['user_fname'],
            'user_lname' => $data['user_lname'],
             'phone' => $data['phone'],
             'state' => $data['state'],
            'email' => $data['email'],
            'usertype'=>$data['usertype'],
            'password' => Hash::make($data['user_pwd']),
        ]);
    }
    protected function guard()
   {
       return Auth::guard('web');
   }
}
