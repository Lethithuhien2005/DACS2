<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Dish;
use App\Models\Category;
use Surfsidemedia\Shoppingcart\Facades\Cart;
session_start(); 


class CartHandle extends Controller
{
    public function add_to_cart(Request $request) {
        $dish_id = $request->dishid_hidden;
        $quantity =  $request->quantity;
        $dish = Dish::with('get_category')->find($dish_id);
        $data = array();
        $data['id'] = $dish->dish_id;
        $data['qty'] = $quantity;
        $data['name'] = $dish->dish_name;
        $data['price'] = $dish->dish_price;
        $data['options']['image'] = $dish->dish_img;
        $data['options']['category'] = $dish->get_category->category_name;
        Cart::add($data);
        return Redirect::to('/show-cart');
    }
    public function show_cart() {
        return view('shopcart');
    }
    public function update_shoppingcart(Request $request) {
            $rowId = $request->rowId;
            $quantity = $request->qty;
            if (!$rowId || !is_numeric($quantity) || $quantity < 1) {
                return response()->json(['error' => 'Invalid input.'], 400);
            }
            Cart::update($rowId, $quantity);
            $updatedItem = Cart::get($rowId);
            $subtotal = Cart::subtotal();
            $total = (float)str_replace(',', '', $subtotal);
            $service_charge = $total * 0.05;
            $tax = $total * 0.1;
            $total_payment = $total + $service_charge + $tax;
            return response() ->json([
                'totalPrice' => number_format($updatedItem->price * $updatedItem->qty, 0, ',', '.'),
                'subtotal' => number_format($total, 0, ',', '.'),
                'serviceCharge' => number_format($service_charge, 0, ',', '.'),
                'tax' => number_format($tax, 0, ',', '.'),
                'totalPayment' => number_format($total_payment, 0, ',', '.'),
            ]);
    }
    public function update_cartmodel(Request $request) {
        dd($request->all());
        $cart_item_id = $request->cart_item_id;
        $quantity = $request->quantity;
        $cart_item = CartItem::find($cart_item_id);
        if($cart_item) {
            $cart_item->quantity = $quantity;
            $cart_item->save();
            //Calculate total price for each cart-item
            $total_price = $cart_item->price * $cart_item->quantity;
            //Calculate total price for cart (all)
            $subtotal = CartItem::all()->sum(function($item){
                return $item->price * $item->quantity;
            });
            $service_charge = $subtotal * 0.05;
            $tax = $subtotal * 0.1;
            //Calculate total payment for the meal
            $total_payment = $subtotal + $service_charge + $tax;

            return response()->json([
                'totalPrice' => number_format($total_price, 0, ',', '.'),
                'subtotal' => number_format($subtotal, 0, ',', '.'),
                'serviceCharge' => number_format($service_charge, 0, ',', '.'),
                'tax' => number_format($tax, 0, ',', '.'),
                'totalPayment' => number_format($total_payment, 0, ',', '.'),
            ]);
        } else {
            return response()->json(['error' => 'Updating failure']);
        }
    }
    public function delete_item_shoppingcart(Request $request) {
        $rowId = $request->rowId;
        if(!$rowId) {
            return response()->json(['error' => 'Empty item.'], 400);
        }
        Cart::remove($rowId);
        $subtotal = Cart::subtotal();
        $dishCount = Cart::count();
        return response()->json([
            'subtotal' => $subtotal,
            'dishCount' => $dishCount
        ]);
    }
    // public function delete_item_cartmodel(Request $request) {
    //     $cart_item_id = $request->cart_item_id;
    //     $cart_item = CartItem::find($cart_item_id);
    //     $cart_item->delete();
    //     return
    // }
}
