<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $primaryKey = 'contact_id';
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'message',
    ];
    public $timestamps = false;
    public function getUser() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
