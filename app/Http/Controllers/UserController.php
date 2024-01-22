<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function homepage()
    {
        $products = DB::table('products')->paginate(9);

        return view('user.landingpage', ['products' => $products]);
    }

    public function category($id)
    {
        $category = DB::table('categories')->find($id);

        $products = DB::table('products')->where('category_id', $id)->paginate(9);

        return view('user.category', ['category' => $category, 'products' => $products]);
    }

    public function product($id)
    {
        $product = DB::table('products')->find($id);
        $related_products = DB::table('products')->where('category_id', $product->category_id)->get();
        return view('user.product', ['product' => $product, 'related_products' => $related_products]);
    }

    public function addToCart(Request $request)
    {

        DB::table('carts')->insert([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('home')->with('message', 'Product added to cart successfully');
    }

    public function showCart(Request $request)
    {

        // DB::table('products')
        //     ->join('carts','products.id','carts.product_id')
        //     ->get();

        $cart_items = DB::table('products')
                        ->join('carts', function (JoinClause $join) {
                            $join->on('products.id', 'carts.product_id')
                            ->where('carts.user_id', Auth::id());
                            })
                            ->get();
        return view('user.cartitems', ['cart_items'=>$cart_items]);
    }
}