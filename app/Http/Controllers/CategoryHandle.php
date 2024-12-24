<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;
session_start(); 

class CategoryHandle extends Controller
{
    public function add_category() {
        return view('admin.add_category');
    }
    public function save_category(Request $request) {
        // dd($request->all());
        $data = Category::create([
            'category_name' => $request->category_name,
            'category_desc' => $request->category_describe,
        ]);
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['category_desc'] = $request->category_describe;
        // DB::table('categories')->insert($data);
        Session::put('message', 'Added a new category successfully!');
        return Redirect::to('/add-category');
    }
    public function display_list() {
    //    $list_category = DB::table('categories')->get();
        $list_category = Category::all();
        $manager_category = view('admin.list_category')->with('list_category', $list_category);
        return view('admin.admin_layout')->with('admin.list_category', $manager_category);
    }
    public function edit_category($category_id) {
        // $category = DB::table('categories')->where('category_id', $category_id)->get();
        $category = Category::find($category_id);
        $manager_category = view('admin.edit_category')->with('category', $category);
        return view('admin.admin_layout')->with('admin.edit_category', $manager_category);
    }

    public function update_category(Request $request, $category_id) {
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['category_desc'] = $request->category_describe;
        // $category = DB::table('categories')->where('category_id', $category_id)->update($data);
        $category = Category::find($category_id);
        $category->category_name = $request->category_name;
        $category->category_desc = $request->category_describe;
        $category->save();
        Session::put('message', 'Updated successfully!');
        return Redirect::to('/list-of-category');
    }
    public function delete_category($category_id) {
        $category = Category::find($category_id);
        $category->delete();
        Session::put('message', 'Deleted a category successfully!');
        return Redirect::to('/list-of-category');
    }
    public function search(Request $request){
        $key_word = $request->search_category;
        $find_categories = Category::where('category_name', 'like', '%' . $key_word . '%')
                            ->orWhere('category_desc', 'like', '%' .$key_word . '%')->get();
        return view('admin.list_category')->with('find_categories', $find_categories);
    }
}
