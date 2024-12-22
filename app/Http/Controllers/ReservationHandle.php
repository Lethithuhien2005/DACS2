<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Reservation;
use Surfsidemedia\Shoppingcart\Facades\Cart as ShoppingCart;
use App\Models\Cart as CartModel;
use App\Models\CartItem;
use App\Models\Dish;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Http\Controllers\MailHandler;
session_start();

class ReservationHandle extends Controller
{
    public function showReservation(){
        return view('reservation');
    }
    public function __construct(MailHandler $mailHandler) {
        $this->mailHandler = $mailHandler;
    }
    public function save_reservation(Request $request) {
        // Check login: 
        $user_id = $request->user_id;
        if(!session::has('user_id')) {
            //save inputed content before redirecting to login page
            session(['reservation_data' => $request->only(['name', 'email', 'phone', 'book_date', 'book_time', 'number_of_people', 'note'])]);
            // save current url
            session(['url.intended' => url()->previous()]);
            return Redirect::to('/login');
        } else {
            $reservation = Reservation::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'res_date' => $request->book_date,
                'res_time' => $request->book_time,
                'number_of_people' => $request->number_of_people,
                'note' => $request->note,
                'res_status' => $request->reservation_status,
                'user_id' => $request->user_id,
            ]);
            // Session::put('reservation_id', $reservation->res_id);
            // $res_id =  Session::get('reservation_id');
            $res_id = $reservation->res_id;
            $user = User::find($reservation->user_id);
            //Create a cart in database
            $cart = CartModel::create([
                'res_id' => $res_id,
            ]);
            Session::put('cart_id', $cart->cart_id);
            // Check items added by user in Shoppingcart
            $shoppingcart = ShoppingCart::content();
            if($shoppingcart) {
                 //Convert items of ShoppinCart(laravel) into CartModel(database)
                 foreach($shoppingcart as $item) {
                    CartItem::create([
                        'cart_item_name' => $item->name,
                        'cart_item_category' => $item->options->category,
                        'cart_item_img' => $item->options->image,
                        'price' => $item->price,
                        'quantity' => $item->qty,
                        'cart_id' => $cart->cart_id,
                        'dish_id' => $item->id,
                    ]);
                }
            }
            ShoppingCart::destroy();
            Session::put('message_reservation', 'Your reservation was successful!');
            // return Redirect::to('/reservation');
            $this->mailHandler->sendReservation($reservation, $user);
            return redirect()->intended('/reservation');  
        }
    }
    public function show_list_reservations($type_user) {
        $list_reservations = Reservation::with(['getUser', 'hasCart'])->paginate(10);
        return view('admin.list_reservations')->with('list_reservations', $list_reservations)->with('type_user', $type_user);
    }
    public function show_status_eating($res_id, Request $request) {
        $reservation = Reservation::find($res_id);
        $type_user = $request->type_name;
        $reservation->res_status = "currently eating";
        $reservation->save();
        Session::put('message', 'The customer has arrived and is currently eating');
        return Redirect::to('/list-of-reservations/' . $type_user);
    }
    public function show_status_completed($res_id, Request $request) {
        $reservation = Reservation::find($res_id);
        $type_user = $request->type_name;
        $reservation->res_status = "meal completed";
        $reservation->save();
        // Create an order
            $user_id = $reservation->user_id;
            //get cart's information base on res_id
            $cart = CartModel::where('res_id', $res_id)->first();
            $cart_id = $cart->cart_id;
            $order = Order::create([
                'user_id' => $user_id,
                'res_id' => $res_id,
                'order_status' => "unpaid",
            ]);
        //Convert cart-items to order_items:
        $cart_items = CartItem::where('cart_id', $cart_id)->get();
        foreach($cart_items as $cart_item) {
            $order_item = OrderItem::create([
                'order_item_name' => $cart_item->cart_item_name,
                'order_item_img'=>$cart_item->cart_item_img,
                'price' => $cart_item->price,
                'quantity' => $cart_item->quantity,
                'order_id' => $order->order_id,
                'dish_id' => $cart_item->dish_id,
            ]);
        }
        Session::put('message', 'The customer has completed the meal');
        return Redirect::to('/list-of-reservations/'. $type_user);
    }
    public function edit_reservation($res_id) {
        $reservation_editing = Reservation::find($res_id);
        return view('admin.edit_reservation')->with('reservation_editing', $reservation_editing);
    }
    public function update_reservation($res_id, Request $request) {
        $reservation = Reservation::find($res_id);
        $reservation->name = $request->name;
        $reservation->email = $request->email;
        $reservation->phone = $request->phone;
        $reservation->res_date = $request->reservation_date;
        $reservation->res_time = $request->time;
        $reservation->number_of_people = $request->number_of_people;       
        $reservation->note = $request->note;
        $reservation->save();
        $user = User::find($reservation->user_id);
        $type_user = ["administrator", "manager", "staff"];
        Session::put('message', 'Updated reservation successfully!');
        $this->mailHandler->sendUpdatingReservation($reservation, $user);
        return view('admin.list_reservation')->with('type_user', $type_user);

    }
    public function show_status_cancel($res_id, Request $request) {
        $type_user = $request->query('type_name');
        $reservation = Reservation::find($res_id);
        $reservation->res_status = "canceled";
        $reservation->save();
        Session::put('message', "Canceled this reservation successfully!");
        if($type_user == 'administrator' || $type_user == 'manager') {
            return Redirect::to('/list-of-reservations/'.$type_user);
        }
        else {
            $user_id = $reservation->user_id;
            return Redirect::to("/my-reservation/$user_id");
        }
    }
    public function show_cart_user($cart_id, Request $request) {
        $type_user = $request->query('type_name');
        $cart = CartModel::find($cart_id);
        $cart_items = CartItem::where('cart_id',$cart_id)->get();
        //get status if revservating is canceled
        $reservation_status = $cart->get_reservation->res_status;
        //Send cart_id if customer has no items in their cart
        Session::put('cart_id', $cart->cart_id);
        return view('user.shopcart_user')->with('cart_items', $cart_items)->with('type_user', $type_user)->with('cart', $cart)->with('reservation_status', $reservation_status);
    }
    public function add_to_cart_res_id(Request $request, $cart_id) {
        $dish_id = $request->dishid_hidden;
        $quantity =  $request->quantity;
        $dish = Dish::with('get_category')->find($dish_id);
        CartItem::create([
            'cart_item_name' => $dish->dish_name,
            'cart_item_category' => $dish->get_category->category_name,
            'cart_item_img' => $dish->dish_img,
            'price' => $dish->dish_price,
            'quantity' => $quantity,
            'cart_id' => $cart_id,
            'dish_id' => $dish->dish_id,  
        ]);
        $type_user = $request->type_name;
        return Redirect::to("/cart-items/$cart_id?type_user=".$type_user)->with('type_user', $type_user);
    }
    public function delete_cart_item(Request $request, $cart_id) {
        dd($request->cart_item_id);
        $cart_item_id = $request->cart_item_id;
        if(!$rowId) {
            return response()->json(['error' => 'Empty item.'], 400);
        } else {
            $item = CartItem::find($cart_item_id);
            $item->delete();
            $subtotal = ShoppingCart::subtotal();
            $dishCount = ShoppingCart::count();
            return response()->json([
                'subtotal' => $subtotal,
                'dishCount' => $dishCount
            ]);
        }
    }
    public function show_my_reservation($user_id) {
        $user = User::find($user_id);
        $list_reservations = Reservation::where('user_id', $user_id)->get();
        return view('user.my_reservation')->with('list_reservations', $list_reservations)->with('account_name', $user->account_name);
    }
}
