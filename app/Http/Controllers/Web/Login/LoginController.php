<?php

namespace App\Http\Controllers\Web\Login;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request) {

        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return redirect()->route('login')
            ->with('status', false)
            ->with('message', 'Login Failed!');
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login')
            ->with('status', true)
            ->with('message', 'Logout');
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(),[
            'name'             => ['required'],
            'email'            => ['required', 'email'],
            'password'         => ['required'],
            'confirm-password' => ['required'],
        ]);

        $error = "";
        $status = false;

        if($validator->fails()){
            $validationErrors = $validator->errors();
        }else{
            $requestAll = $request->all();
            if($requestAll['password'] != $requestAll['confirm-password']){
                $error = "  -  Please check Passwords!!";
            }else{
                $user = new User;
                $user->email = $requestAll['email'];
                $user->name = $requestAll['name'];
                $user->password = bcrypt($requestAll['password']);
                $user->saveQuietly();

                $status = true;
            }
        }

        if($status){
            return redirect()->route('login')
                ->with('status', true)
                ->with('message', 'Reqister Successfully');
        }else{
            return redirect()->route('register')
                ->withErrors($validationErrors ?? [])
                ->with('status', false)
                ->with('message', 'Reqister Failed'.$error);
        }
    }
}
