<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
    //function to show registeration form
    public function register()
    {
        return view('auth.register');
    }
    //function to store information that required to register
    public function handleRegister(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:100',
            'email'=>'required|email|max:255',
            'pass'=>'required|string|max:50|min:5'
        ]);
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'pass'=>Hash::make($request->pass),
        ]);
        Auth::login($user);
        return redirect(route('get.index'));
    }
    //function to show login form
    public function login()
    {
        return view('auth.login');
    }
    //function used to check if user in DB or Not to make login
    public function handleLogin(Request $request)
    {
        $request->validate([        
            'email'=>'required|email|max:255',
            'pass'=>'required|string|max:50|min:5'
        ]);
        //attempt() used to check if email and password are exist or not if exist return true 
        //if not exist return false
        $is_login=Auth::attempt(['email'=>$request->email,'password'=>$request->pass]);
        if(! $is_login)
        {
            return back();
        }
        return redirect(route('get.index'));
    }
    //function used to make login with github account
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }
    //function used to make login with github account
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
        $email=$user->email;
        $db_user=User::where('email','=',$email)->first();
if ($db_user == null) {
    $registerd_user=User::create([
        'name'=>$user->name,
        'email'=>$user->email,
        'pass'=>Hash::make('123456'),
        'oauth_token'=>$user->token,
    ]);
    Auth::login($registerd_user);
}       else{
                Auth::login($db_user);
            }
            return redirect(route('get.index'));
        }
 
        // $user->token;
    }
    //

