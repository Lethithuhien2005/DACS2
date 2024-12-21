<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';
    protected $primaryKey = 'cart_item_id';
    protected $fillable = [
        'cart_item_name',
        'cart_item_category',
        'cart_item_img',
        'price',
        'quantity',
        'cart_id',
        'dish_id',
    ];
    public $timestamps = false;

    public function getCart() {
        return $this->belongsTo(Cart::class, ['cart_id']);
    }
    public function getDish() {
        return $this->belongsTo(Dish::class, ['dish_id']);
    }
}
