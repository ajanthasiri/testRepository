<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;

class control extends Controller
{
    
    public function loginpage(){
        return view('login');
    }

    public function registerpage(){
        return view('register')->with('error' , '');
    }

    public function register(Request $request){
        $email=DB::table('users')->where('email',$request->email)->value('email');
        if($email==''){
            if($request->password==$request->rpassword){
                DB::table('users')->insert([
                    'email' => $request->email,
                    'name' => $request->name,
                    'password' => bcrypt($request->password),
                ]);
                if(\Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                    return redirect('home');
                }
                else{
                    return redirect()->back()->withErrors('Credentials invalid');
                }
            }
            else{
                return redirect()->back()->withErrors('Password confirmation incorrect');
            }
        }
        else{
            return redirect()->back()->with('error' , 'The email already exists');
        }
        
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        
        if(Auth::attempt($credentials)){
            return redirect('home');
        }
        else{
            return 'Credentials invalid';
        }
        
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return  redirect('loginpage');
    }
}
