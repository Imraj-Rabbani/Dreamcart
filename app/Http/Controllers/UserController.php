<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function homepage(){
        $products = DB::table('products')->paginate(9);

        return view('user.landingpage',['products' => $products]);
    }

    public function category($id){
        $category = DB::table('categories')->find($id);

        $products = DB::table('products')->where('category_id', $id)->paginate(9);

        return view('user.category',['category' => $category, 'products' => $products]);
    }

    public function product($id){
        $product = DB::table('products')->find($id);
        $related_products = DB::table('products')->where('category_id',$product->category_id)->get();
        return view('user.product',['product' => $product, 'related_products' => $related_products]);



    }
}
