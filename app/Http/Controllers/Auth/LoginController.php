<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

    use AuthenticatesUsers , ResturantAuth;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo =  '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:resturant')->except('logout');
    }

    public  function showAdminLoginFrom(){
    return view('admin.auth.login');
}
    public function adminLogin(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password'=>'required'
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email,'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
}
