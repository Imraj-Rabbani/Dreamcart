<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function homepage(){
        return view('user.layouts.template');
    }

    public function category($id){
    
    }
}
