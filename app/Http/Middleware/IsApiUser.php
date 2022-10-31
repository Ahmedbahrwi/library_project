<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class IsApiUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->has('access_token')){
            if($request->access_token !==null){
                $user=User::where('access_token',$request->access_token)->first();
                if($user !==null)
                {
                 return $next($request);
                }

        }else{
            return response()->json('access token is empty');
        }
        }else{
            return response()->json('there is no access token');

        }
       
    }
}
