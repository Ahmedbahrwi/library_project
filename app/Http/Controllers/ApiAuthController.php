<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{
    //function to store information that required to register
    public function handleRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string|max:100',
            'email'=>'required|email|max:255',
            'pass'=>'required|string|max:50|min:5',
            
        ]);
        if ($validator->fails()) {
           $errore=$validator->errors();
           return response()->json($errore);
        }
        
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'pass'=>Hash::make($request->pass),
            'access_token'=>Str::random(64),
        ]);
        //Auth::login($user);
        return response()->json($user->access_token);
    }
    //function used to check if user in DB or Not to make login
    public function handelLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required|email|max:255',
            'pass'=>'required|string|max:50|min:5',
            
        ]);
        if ($validator->fails()) {
           $errore=$validator->errors();
           return response()->json($errore);
        }
        
        $is_login=Auth::attempt(['email'=>$request->email,'password'=>$request->pass]);
        if(! $is_login)
        {
            $error="credentials are not correct";
            return response()->json($error);
        }
        $user=User::where('email','=',$request->email)->first();
        $new_access_token=Str::random(64);
        $user->update([
            'access_token'=>$new_access_token,
        ]);
        return response()->json($new_access_token);
    }
    //function used to make logout
    public function logout(Request $request){
       $access_token=$request->access_token;
       $user=User::where('access_token',$access_token)->first();
       if($user==null)
       {
        $errore="token not correct";
           return response()->json($errore);
       }
       $user->update([
        'access_token'=>null,
       ]);
       $success='Logged out Successfully';
       return response()->json($success);


    }
    //
}
