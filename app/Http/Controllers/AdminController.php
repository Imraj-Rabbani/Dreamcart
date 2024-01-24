<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show()
    {
        $users = DB::table('users')->count();
        $products = DB::table('users')->count();
        $orders = DB::table('users')->count();
        $categories = DB::table('users')->count();

        return view('admin.dashboard',['users'=>$users,'products'=>$products,'orders'=>$orders, 'categories'=>$categories ]);
    }

    //=== Category related Function ===/
    public function category()
    {
        $categories = DB::table('categories')->get();

        return view('admin.allcategory', ['categories' => $categories]);
    }

    public function addCategory()
    {
        return view('admin.addcategory');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name'
        ]);

        DB::table('categories')->insert([
            'name' => $request->name,
        ]);

        return redirect()->route('all.category')->with('message', 'Category Added successfully');
    }


    public function editCategory($id)
    {
        $category = DB::table('categories')->find($id);

        return view('admin.editcategory', ['category' => $category]);
    }

    public function updateCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        DB::table('categories')
            ->where('id', $request->category_id)
            ->update([
                'name' => $request->name,
            ]);

        return redirect()->route('all.category')->with('message', 'Category Updated successfully');
    }

    public function deleteCategory(Request $request)
    {
        DB::table('categories')->where('id', $request->id)->delete();

        return redirect()->route('all.category')->with('message', 'Category Deleted successfully');

    }


    //=== Product related functions ===//

    public function product()
    {
        $products = DB::table('products')->get();

        return view('admin.allproducts', ['products' => $products]);
    }

    public function addProduct()
    {
        $categories = DB::table('categories')->get();
        return view('admin.addproduct', ['categories' => $categories]);
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'product_img' => 'required|image|mimes:jpeg,jpg,gif,png,svg|max:2048',
        ]);

        //=== Code Snippet for storing picture as a file from the form ===//

        // $image = $request->file('product_img');
        // $img_name = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
        // $request->product_img->move(public_path('upload'), $img_name);
        // $img_url = 'upload/' . $img_name;


        DB::table('products')->insert([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'desc' => $request->description,
            'category_id' => $request->category_id,
            'img_url' => $request->product_img,
        ]);

        return redirect()->route('all.product')->with('message', 'Product Added successfully');
    }


    public function editProduct($id)
    {
        $product = DB::table('products')->find($id);
        $category = DB::table('categories')->find($product->category_id);
        $categories = DB::table('categories')->get();

        return view('admin.editproduct', ['product' => $product, "category" => $category, "categories" => $categories]);
    }

    public function updateProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
        ]);

        DB::table('products')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'category_id' => $request->category_id,
                'desc' => $request->description,
            ]);

        return redirect()->route('all.product')->with('message', 'Product Updated successfully');
    }

    public function deleteProduct(Request $request)
    {
        DB::table('products')->where('id', $request->id)->delete();

        return redirect()->route('all.product')->with('message', 'Product Deleted successfully');

    }


    public function pendingOrder()
    {
        $users = DB::table('orders')
            ->join('users', 'orders.user_id', 'users.id')
            ->join('addresses', 'users.id', 'addresses.user_id')
            ->select('users.*', 'addresses.address', 'addresses.postal_code', 'addresses.phone_number')
            ->where('orders.status', 'pending')
            ->distinct()
            ->get();



        $products = DB::table('orders')
            ->join('products', 'orders.product_id', 'products.id')
            ->get();


        return view('admin.pendingorders', ['users' => $users, 'products' => $products]);
    }

    public function changeStatus(Request $request)
    {
        DB::table('orders')
            ->where('user_id', $request->id)
            ->update(['status' => 'delivered']);

        return redirect()->route('home')->with('message', 'Order Delivered Successfully');

    }

    public function deliveredOrder()
    {
        $users = DB::table('orders')
            ->join('users', 'orders.user_id', 'users.id')
            ->join('addresses', 'users.id', 'addresses.user_id')
            ->select('users.*', 'addresses.address', 'addresses.postal_code', 'addresses.phone_number')
            ->where('orders.status', 'delivered')
            ->distinct()
            ->get();



        $products = DB::table('orders')
            ->join('products', 'orders.product_id', 'products.id')
            ->get();


        return view('admin.deliveredorders', ['users' => $users, 'products' => $products]);
    }

    public function deleteOrder(Request $request)
    {
        DB::table('orders')
            ->where('user_id', $request->id)
            ->delete();

        return redirect()->route('home')->with('message', 'Order Deleted Successfully');

    }

}