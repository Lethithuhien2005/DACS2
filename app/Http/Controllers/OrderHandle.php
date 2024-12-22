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
    public function show_list_order($type_user) {
        $list_orders = Order::with(['getUser', 'getReservation', 'hasOrderItem'])->paginate(10);
        return view('admin.list_orders')->with('list_orders', $list_orders)->with('type_user', $type_user);
    }

    public function show_order_item($order_id, Request $request) {
        $order_items = OrderItem::where('order_id',$order_id)->get();
        //get Order to display total_payment
        $order = Order::find($order_id);
        $user_id = $order->user_id;
        $user = User::find($user_id);
        // get type user to decide for button "Back"
        $type_user = $request->type_name;
        $status = Session::get('message');
        return view('admin.order_user')->with('order_items', $order_items)->with('order',$order)->with('type_user', $type_user)->with('user', $user)->with('status', $status);
    }

    public function convert_to_paid($order_id) {
        $order = Order::find($order_id);
        $order->order_status = "paid";
        $order->save();
        $type_user = $order->getUser->get_type->type_name;
        return Redirect::to('/list-of-orders/'.$type_user);
    }
    public function convert_to_unpaid($order_id) {
        $order = Order::find($order_id);
        $order->order_status = "unpaid";
        $order->save();
        $type_user = $order->getUser->get_type->type_name;
        return Redirect::to('/list-of-orders/'.$type_user);
    }
}
