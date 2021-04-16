<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login()
    {

      return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        $remember_me  = ( !empty( $request->remember_me ) )? TRUE : FALSE;

        if (Auth::attempt($credentials)) {
          $user = User::where(["email" => $credentials['email']])->first();
            
          Auth::login($user, $remember_me);

          return redirect()->intended('home');
        }

        return redirect('login')->with('error', 'Oops! You have entered invalid credentials');
    }

    public function logout() {
      Auth::logout();
      return redirect('login');
    }

}

