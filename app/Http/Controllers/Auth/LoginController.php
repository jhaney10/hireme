<?php

namespace App\Http\Controllers\Auth;


use DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    

    protected function redirectTo() {
    if (Auth::check() && Auth::user()->usertype == 'parent') {
        return ('/sitters');
    }
    elseif (Auth::check() && Auth::user()->usertype == 'sitter') {
        return ('/sitter/dashboard');
    }
    elseif (Auth::check() && Auth::user()->usertype == 'admin') {
       return ('/admin');
    }
    else {
        return ('/');
    }
}

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
       
    }
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        // $user= Auth::attempt($credentials);

       
        if (Auth::attempt($credentials)) {
           if (Auth::user()->usertype == 'parent') {
               return redirect(url('/sitters'));
           }
           elseif (Auth::user()->usertype == 'sitter') {
               return redirect(url('/sitter/dashboard'));
           }
           else{
                return redirect(url('/admin'));
           }
           
        }
        else{
            return redirect(url('/login'))->with('status','Invalid Login Details');
        }


      

        
    }
    
    public function logout(){
        Auth::logout();
        session()->flush();
        return redirect('/');
    }
    

}
