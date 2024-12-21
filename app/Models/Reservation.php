<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'res_id';
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'res_date',
        'res_time',
        'number_of_people',
        'note',
        'res_status'
    ];
    public $timestamps = false;

    public function getUser() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function hasCart() {
        return $this->hasOne(Cart::class, 'res_id');
    }
    public function hasOrder() {
        return $this->hasOne(Order::class, 'res_id');
    }
}
