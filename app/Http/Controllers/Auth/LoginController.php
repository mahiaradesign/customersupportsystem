<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TicketsController;
use DB;
use Cache;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\executive;
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
    public function login(Request $request)
    {
        $this->validate($request, 
        [
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only(['email', 'password']);
        if (Auth::guard()->attempt($credentials)) {
            
            if (Auth::user()->role == 'admin'){
                return redirect::to('/admin');
            } else{
                $exec = executive::where('executive_id','=', Auth::user()->id)->first();
                if($exec->active == 1){
                    // When user logins it looks for unassignd tasks by assign_waiting_task() this function in Ticket controller
                    TicketsController::assign_waiting_task();
                    return Redirect::to('/home');
                }
                else{
                    Auth::logout();
                    return redirect('/')->with('inactive','Sorry your account is blocked');
                }
            }
            
        }
        else
        {
            Auth::logout();
            return view('auth.login')->with('error','Sorry Credentials Not known to us or your Account Not yet Verified');
        }
    }

     use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        session()->put('previousUrl', url()->previous());
        return view('auth.login');
    }
    public function redirectTo()
    {
        if (Auth::user()->role == 'admin'){
            return url('admin');
        } else{
            return str_replace(url('/'),'', session()->get('previousUrl', '/'));
        }
    }

    public function logout(){
        Cache::forget('user-is-online-' . Auth::user()->id);
        if(Auth::user()->role=="executive"){
            $exec=DB::table('executive')->where('executive_id','=',Auth::user()->id)->update(['status'=>'offline']);
        }
        Auth::logout();
        return redirect('/login');
    }
}
