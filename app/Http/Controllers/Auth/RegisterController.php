<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '';

    // protected function redirectTo()
    //     {
    //         return '/sitter/profile';
    //     }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages= [
            'phone.min' => 'Please enter a valid phone number of 11-digits',
            'phone.max' => 'Please enter a valid phone number of 11-digits',
            'user_pwd.required'  => 'Please enter a strong password',
             'user_address.required'  => 'Please enter your address',
              'user_fname.required'  => 'Please enter your firstname',
              'user_lname.required'  => 'Please enter your lastname',
              'email.required'  => 'Please enter a valid email address',
            'user_pwd2.same'=>'Passwords do not match',
            'user_pwd2.required'=> 'Please confirm your password',
            'user_pwd.min'=>'Password must contain a minimum of 8 characters',
            'user_pwd.different'=> 'Password must not be same with email address',
        ];
        return Validator::make($data, [
           'user_fname' => ['required','string','max:255'],
            'user_lname' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users'],
            'user_pwd' => ['required','string','min:8', 'different:email'],
            'user_pwd2'=> ['required','same:user_pwd'],
            'phone' => ['required','string','min:11', 'max:11'],
            'user_address' => ['required','string','max:255'],
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
             'address' => $data['user_address'],
            'user_fname' => $data['user_fname'],
            'user_lname' => $data['user_lname'],
             'phone' => $data['phone'],
             'idcity' => $data['idcity'],
             'state' => $data['state'],
            'email' => $data['email'],
            'usertype'=>$data['usertype'],
            'password' => Hash::make($data['user_pwd']),
        ]);
    }

    public function showRegistrationForm(){
        $city = DB::table('city')->get();

        return view('auth.register', ['city' => $city, 'url' => 'sitter']);
    }

    protected function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));

       Auth::login($user,true);
       session(['usertype'=>'sitter']);
        return redirect()->intended('/sitter/create');
    }



   

}
