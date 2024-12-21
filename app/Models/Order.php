<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'user_id',
        'res_id',
        'order_status',
    ];
    public $timestamps = false;
    public function getReservation() {
        return $this->belongsTo(Reservation::class, 'res_id');
    }
    public function getUser() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function hasOrderItem() {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    //Using Accessor to calculate subtotal for each order 
    public function getSubTotalAttribute() {
        return $this->hasOrderItem->sum(function($item) {
            return $item->price * $item->quantity;
        });
    }
    //Using Accessor to calculate total payment for each order
    public function getTotalPaymentAttribute() {
        $subtotal = $this->hasOrderItem->sum(function($item) {
            return $item->price * $item->quantity;
        });
        $tax = $subtotal * 0.05;
        $service = $subtotal * 0.1;
        return $subtotal + $tax + $service;
    }
}
