<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\OrderItem;
session_start();

class HomeHandle extends Controller
{
    public function index() {
        $best_sellers = OrderItem::select('dish_id', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('dish_id')->orderBy('total_quantity', 'desc')->take(7)->get();
        return view('homepage')->with('best_sellers', $best_sellers);
    }

    public function showAboutus() {
        return view('aboutus');
    }

    public function showContact() {
        return view('contact');
    }
}
