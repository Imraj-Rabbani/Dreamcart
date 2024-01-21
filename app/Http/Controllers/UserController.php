<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function homepage(){
        $products = DB::table('products')->paginate(9);

        return view('user.landingpage',['products'=>$products]);
    }

    public function category($id){
        
    }
}
