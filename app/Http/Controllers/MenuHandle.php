<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\Models\Category;
use App\Models\Dish;

class MenuHandle extends Controller
{
    public function showMenu() {
        Session::put('cart_id', null);
        $list_categories = Category::orderby('category_id', 'asc')->get();
        $list_dishes = Dish::orderby('dish_id', 'asc')->get();
        return view('menu')->with('list_categories', $list_categories)->with('list_dishes', $list_dishes);
    }
    public function showMenuPage($cart_id) {
        $list_categories = Category::orderby('category_id', 'asc')->get();
        $list_dishes = Dish::orderby('dish_id', 'asc')->get();
        return view('menu')->with('list_categories', $list_categories)->with('list_dishes', $list_dishes)->with('cart_id', $cart_id);
    }
}