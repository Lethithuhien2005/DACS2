<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'order_item_id';
    protected $fillable = [
        'order_item_name',
        'order_item_img',
        'price',
        'quantity',
        'order_id',
        'dish_id',
    ];
    public $timestamps = false;

    public function getOrder() {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function getDish() {
        return $this->belongsTo(Dish::class, 'dish_id');
    }
    public function getFeedback() {
        return $this->hasOne(Feedback::class, 'order_item_id');
    }
}
