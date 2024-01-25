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

    public function deleteProduct(Request $request)
    {
        DB::table('products')->where('id', $request->id)->delete();

        return redirect()->route('showcart')->with('message', 'Product removed Successfully');
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
        $cart_items = DB::table('products')
            ->join('carts', function (JoinClause $join) {
                $join->on('products.id', 'carts.product_id')
                    ->where('carts.user_id', Auth::id());
            })
            ->select('products.*', 'carts.quantity')
            ->get();
        return view('user.cartitems', ['cart_items' => $cart_items]);
    }

    public function address()
    {
        return view('user.shippinginfo');
    }

    public function createAddress(Request $request)
    {

        DB::table('addresses')->insert([
            'phone_number' => $request->phone,
            'postal_code' => $request->postal,
            'address' => $request->area,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('home')->with('messsage', "Shipping Address have been saved successfully");
    }

    public function checkout()
    {
        $shipping_info = DB::table('addresses')->where('user_id', Auth::id())->first();

        $cart_items = DB::table('products')
            ->join('carts', function (JoinClause $join) {
                $join->on('products.id', 'carts.product_id')
                    ->where('carts.user_id', Auth::id());
            })
            ->select('products.*', 'carts.quantity')
            ->get();

        return view('user.checkout', ['shipping_info' => $shipping_info, 'cart_items' => $cart_items]);
    }

    public function placeOrder(Request $request)
    {

        $products = DB::table('carts')->where('user_id', Auth::id())->get();

        // dd($products);

        foreach ($products as $product) {
            DB::table('orders')->insert([
                'user_id' => Auth::id(),
                'product_id' => $product->product_id,
                'quantity' => $product->quantity,
            ]);

            DB::table('carts')->where('id', $product->id)->delete();
        }

        return redirect()->route('home')->with('message', 'Order placed Successfully');

    }

    public function userDashboard()
    {
        $address = DB::table('addresses')->where('user_id', Auth::id())->first();

        $pending_orders = DB::table('orders')
            ->join('products', 'orders.product_id', 'products.id')
            ->select('products.*')
            ->where('orders.user_id', Auth::id())
            ->where('orders.status', 'pending')
            ->get();

        $delivered_products = DB::table('orders')
            ->join('products', 'orders.product_id', 'products.id')
            ->select('products.*')
            ->where('orders.user_id', Auth::id())
            ->where('orders.status', '=','delivered')
            ->get();
        ;


        return view(
            'user.dashboard',
            [
                'address' => $address,
                'pending_orders' => $pending_orders,
                'delivered_products' => $delivered_products
            ]
        );

    }
}