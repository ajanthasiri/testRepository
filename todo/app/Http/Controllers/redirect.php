<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class redirect extends Controller
{
    
    public function home(){
        if(\Auth::user()==''){
            return 'Please login!';
        }
        else{
            return view('home');
        }
        
    }
}
