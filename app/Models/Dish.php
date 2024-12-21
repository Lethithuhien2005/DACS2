<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{   
    protected $table = 'dishes';
    protected $primaryKey = 'dish_id';
    protected $fillable = [
        'dish_name', 
        'dish_desc',
        'dish_price',
        'dish_img',
        'dish_status',
        'dish_dateAdded',
        'category_id',
    ];
    public $timestamps = false;
    public function get_category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function hasCartItems(){
        return $this->hasMany(CartItem::class, 'dish_id');
    }
    public function hasOrderItem() {
        return $this->hasMany(OrderItem::class, 'dish_id');
    }
}
