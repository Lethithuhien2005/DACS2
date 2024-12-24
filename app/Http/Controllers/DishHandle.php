<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Dish;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\User;
session_start(); 

class DishHandle extends Controller
{
    public function add_dish() {
        $category_dish = Category::orderby('category_id', 'desc')->get();
        return view('admin.add_dish')->with('category_dish', $category_dish);
    }
    public function save_dish(Request $request) {
        // dd($request->all());
            $data = array();
            $data['dish_name'] = $request->dish_name;
            $data['dish_price'] = $request->dish_price;
            $data['dish_desc'] = $request->dish_describe;
            $data['dish_status'] = $request->dish_status;
            $data['dish_dateAdded'] = $request->dish_dateAdded;
            $data['category_id'] = $request->category_dish;
            $get_img = $request->File('dish_img'); 
            if ($get_img) {
                $get_name_img = $get_img->getClientOriginalName();
                $name_img = current(explode(".", $get_name_img));
                $new_img = $name_img.rand(0,99).".".$get_img->getClientOriginalExtension();
                $get_img->move('public/upload/dishes', $new_img);
                $data['dish_img'] = $new_img;
                Dish::create($data);
                Session::put('message', 'Add dish successfully!');
                return Redirect::to('/list-of-dishes');
            } else {
                $data['dish_img'] = "";
                Dish::create($data);
                Session::put('message', 'Add dish successfully!');
                return Redirect::to('/list-of-dishes');
            }
        }
    public function display_dishes() {
        // $category_dish = Category::orderby('category_id', 'desc')->get();
        $list_dishes = Dish::with('get_category')->paginate(10);
        // $manager_dish = view('admin.list_dishes')->with('list_dishes', $list_dishes);
        // return view('admin.admin_layout')->with('admin.list_dishes', $manager_dish);
        return view('admin.list_dishes')->with('list_dishes', $list_dishes);
    }
    public function hidden($dish_id) {
        $data = Dish::find($dish_id);
        $data->dish_status = "sold out";
        $data->save();
        Session::put('message', 'Hidden the dish successfully!');
        return Redirect::to('/list-of-dishes');
    }
    public function display($dish_id) {
        $data = Dish::find($dish_id);
        $data->dish_status = "still available";
        $data->save();
        Session::put('message', 'Hidden the dish successfully!');
        return Redirect::to('/list-of-dishes');
    }
    public function edit_dish($dish_id) {
        $category_dish = Category::orderby('category_id', 'desc')->get();
        $edit_dish = Dish::find($dish_id);
        return view('admin.edit_dish')->with('edit_dish', $edit_dish)->with('category_dish', $category_dish);
    }
    public function update_dish(Request $request, $dish_id) {
        $dish = Dish::find($dish_id);
        $dish->dish_name = $request->dish_name;
        $dish->dish_price = $request->dish_price;
        $dish->dish_desc = $request->dish_desc;
        $dish->category_id = $request->category_pr;
        $dish->dish_status = $request->dish_status;
        $get_img = $request->File('dish_img'); 
        if($get_img) {
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode(".", $get_name_img));
            $new_img = $name_img.rand(0,99).".".$get_img->getClientOriginalExtension();
            $get_img->move('public/upload/dishes', $new_img);
            $dish->dish_img = $new_img;
        }
        $dish->save();
        Session::put('message', 'Add dish successfully!');
        return Redirect::to('/list-of-dishes');
    }
    public function delete_dish($dish_id) {
        $dish = Dish::find($dish_id);
        $dish->delete();
        Session::put('message', 'Deleted a category successfully!');
        return view('/list-of-category');
    }
    public function show_detail_dish($dish_id, Request $request) {
        $order_item_id = $request->order_item_id;
        $order_item = OrderItem::find($order_item_id);
        $type_user = $request->type_name;
        //get order_items to display feedbacks of that dish
        $list_order_item = OrderItem::where('dish_id', $dish_id)->get();
        //get catogory to display relative dishes
        $category_dish = Category::orderby('category_id', 'asc')->get();
        $detail_dish = Dish::with('get_category')->find($dish_id);
        $category_dish = $detail_dish->category_id;
        $related_dish = Dish::with('get_category')->where('category_id', $category_dish)->where('dish_id', '!=', $dish_id)->get();
        return view('detail_dish')->with('category_dish', $category_dish)->with('detail_dish', $detail_dish)->with('list_orderItem', $list_order_item)->with('related_dish',$related_dish)->with('order_item', $order_item)->with('type_user', $type_user);
   }
   public function show_detail_dish_cart_id($dish_id, Request $request) {
        $cart_id = $request->query('cart_id');
        Session::put('cart_id', $cart_id);
        $category_dish = Category::orderby('category_id', 'asc')->get();
        //$detail_dish = DB::table('dishes')->join('categories', 'categories.category_id, '=', dishes.category_id')->where('dishes.category_id', $dish_id)->get();
        $detail_dish = Dish::with('get_category')->find($dish_id);
        $category_dish = $detail_dish->category_id;
        $related_dish = Dish::with('get_category')->where('category_id', $category_dish)->where('dish_id', '!=', $dish_id)->get();
        return view('detail_dish')->with('category_dish', $category_dish)->with('detail_dish', $detail_dish)->with('related_dish',$related_dish);
    }
    public function search(Request $request) {
        $key_word = $request->search_dish;
        $find_dishes = Dish::join('categories', 'dishes.category_id', '=', 'categories.category_id')
                        ->select('dishes.*', 'categories.category_name')
                        ->where('dish_name', 'like', '%'.$key_word.'%')
                        ->orWhere('dish_price', 'like', '%'.$key_word.'%')
                        ->orWhere('category_name', 'like', '%'.$key_word.'%')
                        ->orWhere('dish_status', 'like', '%'.$key_word.'%')->get();
        return view('admin.list_dishes')->with('find_dishes', $find_dishes);
    }
}