<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $primaryKey = 'fb_id';
    protected $fillable = [
        'user_id',
        'order_item_id',
        'rating', 
        'comment',
        'fb_date',
        'fb_time',
    ];
    public $timestamps = false;
    public function getUser() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getOrderItem() {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }
}
