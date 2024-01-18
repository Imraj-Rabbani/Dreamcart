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
            'category_name' => 'required|unique:categories'
        ]);

        DB::table('categories')->insert([
            'name' => $request->category_name,
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

    public function deleteCategory(Request $request){
        DB::table('categories')->where('id',$request->id)->delete();

        return redirect()->route('all.category')->with('message', 'Category Deleted successfully');

    }
}