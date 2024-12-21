<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'cart_id';
    protected $fillable = ['res_id',];
    public $timestamps = false;

    public function get_Reservation() {
        return $this->belongsTo(Reservation::class,'res_id');
    }
    public function hasCartItems(){
        return $this->hasMany(CartItem::class, 'cart_id');
    }
    //Using Accessor to calculate subtotal for each cart
    public function getTotalPriceAttribute() {
        return $this->hasCartItems->sum(function($item){
            return $item->price * $item->quantity;
        });
    }
    public function getSubTotalAttribute() {
        $total_cart = $this->total_price;
        $service_charge = $total_cart * 0.05;
        $tax = $total_cart * 0.1;
        return $total_cart + $service_charge + $tax;
    }

}
