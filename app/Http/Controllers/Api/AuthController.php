<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password'=> 'required'
        ]);
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()-> json(['message'=>'Invalid'], 401);
        }

        $remember= $request-> remember_me?? false;

        $token = $user-> createToken('auth_token');

        if(!$remember){
            $token-> accessToken-> expires_at= carbon::now()->addDay();
        }else{
            $token-> $token->expires_at= null;
        }
        $token-> accessToken-> save();

        return response()-> json([
            'token'=> $token->plainTextToken,
            'user'=> $user
        ]);
    }

    public function logout(Request $request){
        $request-> user()-> currentAccessToken()-> delete();
        
        return response()-> json([
            'message'=> 'Logged out'
        ]);
    }

    public function forgetpassword(Request $request){
        $request-> validate([
            'email'=> 'required|email'
        ]);

        $status= Password::sendResetLink(
            $request-> only('email')
        );

        return response()-> json([
            'status'=> __($status)
        ]);
    }

}


