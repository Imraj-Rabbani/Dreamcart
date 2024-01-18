<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show()
    {
        return view('admin.dashboard');
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

        return view('admin.editproduct', ['product' => $product]);
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
                'desc' => $request->description,
            ]);

        return redirect()->route('all.product')->with('message', 'Product Updated successfully');
    }

    public function deleteProduct(Request $request)
    {
        DB::table('products')->where('id', $request->id)->delete();

        return redirect()->route('all.product')->with('message', 'Product Deleted successfully');

    }
}