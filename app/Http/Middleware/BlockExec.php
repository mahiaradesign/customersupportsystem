<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\models\executive;

class BlockExec
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if (Auth::user()->role == "executive" ){
                $exec = executive::where('executive_id','=', Auth::user()->id)->first();
                if ($exec->active == 0){
                    Auth::logout();
                    return redirect('/')->with('inactive','Sorry your account is blocked! Please contact Administrator');
                }
            }
        }
        return $next($request);
    }
}
