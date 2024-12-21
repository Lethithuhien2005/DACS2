<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
session_start(); 
class OrderHandle extends Controller
{
    public function show_list_order() {
        $list_orders = Order::with(['getUser', 'getReservation', 'hasOrderItem'])->paginate(10);
        return view('admin.list_orders')->with('list_orders', $list_orders);
    }

    public function show_order_item($order_id, Request $request) {
        $order_items = OrderItem::where('order_id',$order_id)->get();
        //get Order to display total_payment
        $order = Order::find($order_id);
        // get type user to decide for button "Back"
        $user_id = $order->user_id;
        $user = User::find($user_id);
        $type_user = $user->type_id;
        $status = Session::get('message');
        return view('admin.order_user')->with('order_items', $order_items)->with('order',$order)->with('type_user', $type_user)->with('user', $user)->with('status', $status);
    }

    public function convert_to_paid($order_id) {
        $order = Order::find($order_id);
        $order->order_status = "paid";
        $order->save();
        return Redirect::to('/list-of-orders');
    }
    public function convert_to_unpaid($order_id) {
        $order = Order::find($order_id);
        $order->order_status = "unpaid";
        $order->save();
        return Redirect::to('/list-of-orders');
    }
}
