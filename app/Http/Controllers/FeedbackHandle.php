<?php

namespace App\Http\Controllers;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Dish;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Feedback;

use Illuminate\Http\Request;

class FeedbackHandle extends Controller
{
    public function show_list_feedback() {
        $list_feedbacks = Feedback::paginate(10);
        return view('admin.list_feedbacks')->with('list_feedbacks', $list_feedbacks);
    }
    public function send_feedback($order_item_id, Request $request) {
        $order_item = OrderItem::find($order_item_id);
        $order_id = $order_item->order_id;
        $type_user = $request->type_name;
        $order = Order::find($order_id);
        $user_id = $order->user_id;
        $data = Feedback::create([
            'user_id' => $user_id,
            'order_item_id' => $order_item_id,
            'rating' => $request->rate,
            'comment' => $request->comment,
        ]);
        $order_items = OrderItem::where('order_id', $order_id)->with('getFeedback')->get();
        return view('admin.order_user')->with('order', $order)->with('order_items', $order_items)->with('type_user', $type_user);
    }
}
